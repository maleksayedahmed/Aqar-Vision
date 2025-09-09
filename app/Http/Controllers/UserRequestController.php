<?php

namespace App\Http\Controllers;

use App\Models\UpgradeRequest;
use App\Models\User;
use App\Models\Agent;
use App\Models\Agency;
use App\Models\AgentType;
use App\Models\AgencyType;
use App\Models\License;
use App\Models\LicenseType;
use App\Notifications\UserUpgradeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\AgencyUpgradeRequest;

class UserRequestController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        // Validate required data and role type
        $request->validate([
            'requested_role' => 'required|in:agent,agency',
            'fal_license' => 'nullable|string|max:255',
            'license_issue_date' => 'nullable|date',
            'license_expiry_date' => 'nullable|date|after:license_issue_date',
            // allow optional name/phone to be provided with the upgrade request and used to fill missing profile data
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'agency_name' => 'required_if:requested_role,agency|string|max:255',
            'agency_type_id' => 'required_if:requested_role,agency|exists:agency_types,id',
            'commercial_register_number' => 'nullable|string|max:255',
            'commercial_issue_date' => 'nullable|date',
            'commercial_expiry_date' => 'nullable|date|after:commercial_issue_date',
            'tax_id' => 'nullable|string|max:255',
            'tax_issue_date' => 'nullable|date',
            'tax_expiry_date' => 'nullable|date|after:tax_issue_date',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $user = Auth::user();

        // Check if user has required data for upgrade request, using either form input or existing user data
        $userName = $request->filled('name') ? $request->input('name') : $user->name;
        $userPhone = $request->filled('phone') ? $request->input('phone') : $user->phone;
        
        if (empty($userName) || empty($userPhone)) {
            return response()->json([
                'message' => 'يجب إكمال جميع البيانات الشخصية (الاسم ورقم الهاتف) قبل إرسال طلب الترقية.',
                'error' => true
            ], 422);
        }
        
        // Update user profile with the provided or existing values
        $user->update([
            'name' => $userName,
            'phone' => $userPhone
        ]);

        // Prevent agents/agencies from submitting another request
        if ($user->agent || $user->agency) {
            return response()->json([
                'message' => 'حسابك بالفعل حساب عقاري.',
                'error' => true
            ], 403);
        }

        // Check for existing requests
        $existingRequest = $user->latestUpgradeRequest;
        if ($existingRequest) {
            if ($existingRequest->status === 'pending') {
                return response()->json([
                    'message' => 'لديك طلب ترقية قيد المراجعة بالفعل.',
                    'error' => true
                ], 409);
            }

            if ($existingRequest->status === 'approved') {
                return response()->json([
                    'message' => 'تم الموافقة على طلب الترقية الخاص بك بالفعل.',
                    'error' => true
                ], 409);
            }
        }

        // Find default type to assign based on requested role
        if ($request->requested_role === 'agent') {
            $defaultAgentType = AgentType::where('is_active', true)->orderBy('id')->first();
            if (!$defaultAgentType) {
                return response()->json([
                    'message' => 'لا يمكن معالجة الطلب لأنه لم يتم تكوين أنواع العقاريين من قبل الإدارة.',
                    'error' => true
                ], 500);
            }
        } else {
            $defaultAgencyType = AgencyType::where('is_active', true)->orderBy('id')->first();
            if (!$defaultAgencyType) {
                return response()->json([
                    'message' => 'لا يمكن معالجة الطلب لأنه لم يتم تكوين أنواع الشركات العقارية من قبل الإدارة.',
                    'error' => true
                ], 500);
            }
        }

        // 1. Create license record if license data is provided
        $licenseId = null;
        if ($request->filled('fal_license') && $request->requested_role === 'agent') {
            // Find or create FAL license type
            $falLicenseType = LicenseType::where('name->en', 'FAL License')->first();
            if (!$falLicenseType) {
                $falLicenseType = LicenseType::create([
                    'name' => ['en' => 'FAL License', 'ar' => 'رخصة فال'],
                    'description' => ['en' => 'FAL License for Real Estate Agents', 'ar' => 'رخصة فال للوسطاء العقاريين'],
                    'is_active' => true,
                ]);
            }

            $license = License::create([
                'license_type_id' => $falLicenseType->id,
                'license_number' => $request->fal_license,
                'issue_date' => $request->license_issue_date,
                'expiry_date' => $request->license_expiry_date,
                'issuer' => 'FAL', // Default issuer for FAL licenses
            ]);

            $licenseId = $license->id;
        }

        // 2. Create the UpgradeRequest record
        $newRequest = UpgradeRequest::create([
            'user_id' => $user->id,
            'requested_role' => $request->requested_role,
            'license_id' => $licenseId,
        ]);

        if ($request->requested_role === 'agency') {
            AgencyUpgradeRequest::create([
                'upgrade_request_id' => $newRequest->id,
                'agency_name' => $request->agency_name,
                'agency_type_id' => $request->agency_type_id,
                'commercial_register_number' => $request->commercial_register_number,
                'commercial_issue_date' => $request->commercial_issue_date,
                'commercial_expiry_date' => $request->commercial_expiry_date,
                'tax_id' => $request->tax_id,
                'tax_issue_date' => $request->tax_issue_date,
                'tax_expiry_date' => $request->tax_expiry_date,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
            ]);
        }

        // 3. Create the corresponding Agent/Agency record immediately for requests
        if ($request->requested_role === 'agent') {
            $agent = Agent::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone,
                'agent_type_id' => $defaultAgentType->id,
            ]);

            // Link license to agent if created
            if ($licenseId) {
                License::find($licenseId)->update(['agent_id' => $agent->id]);
            }
        } elseif ($request->requested_role === 'agency') {
            Agency::create([
                'user_id' => $user->id,
                'agency_name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone,
                'agency_type_id' => $defaultAgencyType->id,
            ]);
        }

        // 4. Notify admins
        $admins = User::role('admin')->get();
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new UserUpgradeRequest($newRequest));
        }

        return response()->json([
            'message' => 'تم إرسال طلب الترقية بنجاح! ستتم مراجعة طلبك من قبل الإدارة.',
            'success' => true
        ]);
    }
}
