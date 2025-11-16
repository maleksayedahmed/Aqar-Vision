<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\City;
use App\Models\District;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Notifications\AdStatusUpdated;
use Illuminate\Http\JsonResponse;

class AdController extends Controller
{
    /**
     * Display a listing of all ads with filtering capability.
     */
    public function index(Request $request): View
    {
        $query = Ad::with(['user', 'district.city', 'propertyType']);

        // Apply text search and location filters first
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('city_id')) {
            $query->whereHas('district', fn($q) => $q->where('city_id', $request->city_id));
        }

        // ** THIS IS THE MODIFIED LOGIC **
        if ($request->filled('status')) {
            // If a specific status is filtered, use it.
            $query->where('status', $request->status);
        } else {
            // If no status is specified, we create a custom order.
            // This will show all 'pending' ads first, then all other statuses.
            $query->orderByRaw("FIELD(status, 'pending') DESC");
        }
        
        // Always sort the results by the newest first as a secondary criteria.
        $query->latest();
        // ** END OF MODIFICATION **

        $ads = $query->paginate(15)->withQueryString();
        $cities = City::where('is_active', true)->orderBy('name')->get();

        return view('admin.ads.index', compact('ads', 'cities'));
    }

    /**
     * Show the form for creating a new ad.
     */
    public function create(): View
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $users = User::where('is_active', true)->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();
        $attributes = PropertyAttribute::where('type', '!=', 'boolean')->orderBy('name->en')->get();

        return view('admin.ads.create', [
            'ad' => new Ad(),
            'cities' => $cities,
            'propertyTypes' => $propertyTypes,
            'users' => $users,
            'features' => $features,
            'attributes' => $attributes,
            'districts' => [],
        ]);
    }

    /**
     * Store a newly created ad in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->validateAd($request);
        $validatedData['created_by'] = auth()->id();
        
        $this->handleMediaAndFeatures($validatedData, new Ad(), $request);

        Ad::create($validatedData);

        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully.');
    }

    /**
     * Show the form for editing the specified ad.
     */
    public function edit(Ad $ad): View
    {
        $ad->load(['district.city', 'user']);
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $users = User::where('is_active', true)->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();
        $attributes = PropertyAttribute::where('type', '!=', 'boolean')->orderBy('name->en')->get();
        $districts = $ad->district ? District::where('city_id', $ad->district->city_id)->orderBy('name')->get() : [];

        return view('admin.ads.edit', compact('ad', 'cities', 'propertyTypes', 'users', 'features', 'attributes', 'districts'));
    }

    /**
     * Update the specified ad in storage.
     */
    public function update(Request $request, Ad $ad): RedirectResponse
    {
        $validatedData = $this->validateAd($request, $ad);
        $validatedData['updated_by'] = auth()->id();
        
        $originalStatus = $ad->status;
        
        $this->handleMediaAndFeatures($validatedData, $ad, $request);
        
        $ad->update($validatedData);

        if ($validatedData['status'] !== $originalStatus && in_array($validatedData['status'], ['active', 'rejected'])) {
            $ad->user->notify(new AdStatusUpdated($ad));
        }

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully.');
    }

    /**
     * Remove the specified ad from storage.
     */
    public function destroy(Ad $ad): RedirectResponse
    {
        if ($ad->images) {
            foreach ($ad->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        if ($ad->video_path) {
            Storage::disk('public')->delete($ad->video_path);
        }

        $ad->delete();
        return redirect()->route('admin.ads.index')->with('success', 'Ad deleted successfully.');
    }

    /**
     * A private helper method to handle validation for both store and update.
     */
    private function validateAd(Request $request, Ad $ad = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,active,rejected,expired',
            'district_id' => 'required|exists:districts,id',
            'property_type_id' => 'required|exists:property_types,id',
            'listing_purpose' => 'required|in:sale,rent',
            'total_price' => 'required|numeric|min:0',
            'area_sq_meters' => 'required|numeric|min:0',
            'age_years' => 'nullable|integer|min:0',
            'is_mortgaged' => 'required|boolean',
            'features' => 'nullable|array',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'video' => 'nullable|file|mimes:mp4,mov,webm|max:51200',
            'delete_images' => 'nullable|array',
        ]);
    }
    
    /**
     * A private helper method to process media and attributes for store/update actions.
     */
    private function handleMediaAndFeatures(array &$validatedData, Ad $ad, Request $request)
    {
        $currentImages = $ad->images ?? [];
        if ($request->filled('delete_images')) {
            $imagesToDelete = $request->input('delete_images');
            foreach ($imagesToDelete as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $currentImages = array_diff($currentImages, $imagesToDelete);
        }

        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $newImagePaths[] = $imageFile->store('ads/images', 'public');
            }
        }
        $validatedData['images'] = array_values(array_merge($currentImages, $newImagePaths));

        if ($request->hasFile('video')) {
            if ($ad->video_path) {
                Storage::disk('public')->delete($ad->video_path);
            }
            $validatedData['video_path'] = $request->file('video')->store('ads/videos', 'public');
        }
        
        if (isset($validatedData['features'])) {
             $validatedData['features'] = array_filter($validatedData['features'], fn($value) => $value !== null && $value !== '');
        }
    }

    public function approve(Ad $ad): RedirectResponse
    {
        if ($ad->status === 'pending') {
            $ad->update(['status' => 'active']);
            $ad->user->notify(new AdStatusUpdated($ad));
            return back()->with('success', 'Ad approved successfully.');
        }
        return back()->with('error', 'This ad is not pending approval.');
    }
    /**
     * Reject a pending ad with a reason.
     */
    public function reject(Request $request, Ad $ad): RedirectResponse|JsonResponse
    {
        if ($ad->status === 'pending') {
            $request->validate(['rejection_reason' => 'nullable|string|max:1000']);
            
            $ad->status = 'rejected';
            // Optional: Save the rejection reason if you have a column for it
            // $ad->rejection_reason = $request->rejection_reason;
            $ad->save();
            
            $ad->user->notify(new AdStatusUpdated($ad, $request->rejection_reason));

            // This is still correct for AJAX requests
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Ad rejected successfully.']);
            }

            return back()->with('success', 'Ad rejected successfully.');
        }

        // This is still correct for AJAX requests
        if ($request->wantsJson()) {
            return response()->json(['message' => 'This ad is not pending approval.'], 422);
        }
        
        return back()->with('error', 'This ad is not pending approval.');
    }

}