<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdController extends Controller
{
    /**
     * Display a listing of the agent's ads.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $tab = $request->query('tab', 'active');

        $baseQuery = Ad::where('user_id', $userId);

        $activeCount = (clone $baseQuery)->where('status', 'active')->count();
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $deletedCount = (clone $baseQuery)->onlyTrashed()->count();
        $expiredCount = (clone $baseQuery)->where('status', 'expired')->count();

        $query = Ad::where('user_id', $userId)->latest();

        switch ($tab) {
            case 'pending':
                $query->where('status', 'pending');
                break;
            case 'deleted':
                $query->onlyTrashed();
                break;
            case 'expired':
                $query->where('status', 'expired');
                break;
            case 'active':
            default:
                $query->where('status', 'active');
                break;
        }

        $ads = $query->paginate(10);

        return view('agent.my-ads', [
            'ads' => $ads,
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
            'deletedCount' => $deletedCount,
            'expiredCount' => $expiredCount,
            'currentTab' => $tab,
        ]);
    }

    /**
     * Show the first step for creating a new ad (selecting the license type).
     */
    public function create()
    {
        $adPrices = AdPrice::where('is_active', true)->get();
        return view('agent.ads.create', [
            'adPrices' => $adPrices
        ]);
    }

    /**
     * Show Step 1 of the ad creation form (Property Details).
     */
    public function createStepOne(AdPrice $adPrice)
    {
        $allAdPrices = AdPrice::where('is_active', true)->get();
        return view('agent.ads.create-step-one', [
            'selectedAdPrice' => $adPrice,
            'allAdPrices' => $allAdPrices,
        ]);
    }

    /**
     * Store the data from Step 1 and proceed to the next step.
     */
    public function storeStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'ad_price_id' => ['required', 'exists:ad_prices,id'],
            'title' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'string', 'max:100'],
            'transaction_type' => ['required', Rule::in(['sell', 'rent'])],
            'floor_number' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'finishing_status' => ['required', 'string'],
            'property_type' => ['required', 'string'],
            'direction' => ['nullable', 'string'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'rooms' => ['required', 'integer', 'min:0'],
            'area' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:5000'],
            'city' => ['required', 'string'],
            'neighborhood' => ['required', 'string'],
            'province' => ['required', 'string'],
            'street' => ['required', 'string'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'features' => ['nullable', 'array'],
            'usage' => ['nullable', 'string'],
            'plan_number' => ['nullable', 'string'],
            'mortgaged' => ['nullable', 'string'],
            'furniture' => ['nullable', 'string'],
            'build_status' => ['nullable', 'string'],
            'building_number' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string'],
        ]);

        $request->session()->put('ad_step_one_data', $validatedData);

        return redirect()->route('agent.ads.create.step2');
    }

    /**
     * Show Step 2 of the ad creation form (Media Uploads).
     */
    public function createStepTwo(Request $request)
    {
        $stepOneData = $request->session()->get('ad_step_one_data');
        if (!$stepOneData) {
            return redirect()->route('agent.ads.create');
        }
        $selectedAdPrice = AdPrice::find($stepOneData['ad_price_id']);
        
        return view('agent.ads.create-step-two', [
            'selectedAdPrice' => $selectedAdPrice,
            'currentTab' => 'my-ads',
        ]);
    }

    /**
     * Store the ad with its media and complete the process.
     */
    public function storeAd(Request $request)
    {
        $stepOneData = Session::pull('ad_step_one_data');
        if (!$stepOneData) {
            return redirect()->route('agent.ads.create')->with('error', 'Session expired. Please start over.');
        }

        $request->validate([
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'video' => ['nullable', 'file', 'mimes:mp4,mov,webm', 'max:51200'],
            'terms' => ['accepted'],
        ]);

        $adData = $stepOneData;
        $adData['user_id'] = Auth::id();
        $adData['status'] = 'pending';

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('ads/images', 'public');
                $imagePaths[] = $path;
            }
            $adData['images'] = $imagePaths;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('ads/videos', 'public');
            $adData['video_path'] = $videoPath;
        }
        
        $ad = Ad::create($adData);
        
        Session::forget('ad_step_one_data');

        return redirect()->route('agent.my-ads')->with([
            'success' => 'تم رفع اعلان عقارك بنجاح',
            'new_ad_id' => $ad->id
        ]);
    }
}