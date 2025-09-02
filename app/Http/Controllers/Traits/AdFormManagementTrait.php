<?php

namespace App\Http\Controllers\Traits;

use App\Models\Ad;
use App\Models\AdPrice;
use App\Models\City;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

trait AdFormManagementTrait
{
    /**
     * Determine if the current user is an agent.
     */
    protected function isAgent(): bool
    {
        return Auth::check() && Auth::user()->agent;
    }

    /**
     * Get the correct route name based on user type.
     */
    protected function getRoute(string $name, $params = []): string
    {
        $prefix = $this->isAgent() ? 'agent.ads.' : 'user.ads.';
        return route($prefix . $name, $params);
    }

    /**
     * Get the correct view path. Per your request, this always uses the 'user.ads.*' views.
     */
    protected function getView(string $name): string
    {
        // This is configured to always use the user views, which are role-aware.
        return 'user.ads.' . $name;
    }

    /**
     * Show the page to select an ad package.
     */
    public function create(): View|RedirectResponse
    {
        $adPrices = AdPrice::where('is_active', true)->get();
        if ($adPrices->isEmpty()) {
            return redirect($this->getRoute('index'))->with('error', 'No ad packages are available at the moment.');
        }
        return view($this->getView('create'), ['adPrices' => $adPrices]);
    }

    /**
     * Show Step 1 of the ad creation form.
     */
    public function createStepOne(AdPrice $adPrice): View
    {
        $user = Auth::user();
        $allAdPrices = AdPrice::where('is_active', true)->get();
        
        // You can add back the "remaining ads" logic here if needed
        $remainingAds = [];
        
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();
        $attributes = PropertyAttribute::where('type', '!=', 'boolean')->orderBy('name->en')->get();

        return view($this->getView('create-step-one'), [
            'selectedAdPrice' => $adPrice, 'allAdPrices' => $allAdPrices, 'remainingAds' => $remainingAds,
            'cities' => $cities, 'propertyTypes' => $propertyTypes, 'features' => $features, 'attributes' => $attributes,
        ]);
    }

    /**
     * Validate and store Step 1 data in the session.
     */
    public function storeStepOne(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'ad_price_id' => 'required|exists:ad_prices,id', 'title' => 'required|string|max:255',
            'property_type_id' => 'required|exists:property_types,id', 'listing_purpose' => 'required|in:sale,rent',
            'total_price' => 'required|numeric|min:0', 'area_sq_meters' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:5000', 'district_id' => 'required|exists:districts,id',
            'latitude' => 'required|numeric|between:-90,90', 'longitude' => 'required|numeric|between:-180,180',
            'province' => 'required|string|max:255', 'street_name' => 'required|string|max:255',
            'age_years' => 'nullable|integer|min:0', 'attributes' => 'nullable|array',
        ]);
        Session::put('ad_create_step_one_data', $validatedData);
        return redirect($this->getRoute('create.step2'));
    }

    /**
     * Show Step 2 of the ad creation form.
     */
    public function createStepTwo(Request $request): View|RedirectResponse
    {
        $stepOneData = Session::get('ad_create_step_one_data');
        if (!$stepOneData) return redirect($this->getRoute('create'));
        
        $selectedAdPrice = AdPrice::find($stepOneData['ad_price_id']);
        return view($this->getView('create-step-two'), compact('selectedAdPrice'));
    }
    
    /**
     * Store a new ad.
     */
    public function storeAd(Request $request): RedirectResponse
    {
        $stepOneData = Session::pull('ad_create_step_one_data');
        if (!$stepOneData) {
            return redirect($this->getRoute('create'))->with('error', 'Session expired. Please start over.');
        }
        $request->validate([ 'images.*' => ['nullable', 'image', 'max:5120'], 'video' => ['nullable', 'string'], 'terms' => ['accepted'] ]);
        $adData = $stepOneData;
        $adData['user_id'] = Auth::id();
        $adData['status'] = 'pending';
        $adData['features'] = $adData['attributes'] ?? [];
        unset($adData['attributes']);
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) { $imagePaths[] = $image->store('ads/images', 'public'); }
            $adData['images'] = $imagePaths;
        }
        if ($request->filled('video')) { $adData['video_path'] = $request->video; }
        Ad::create($adData);
        return redirect($this->getRoute('index'))->with('success', 'Ad submitted for review.');
    }
    
    /**
     * Show the form for editing Step 1 of an existing ad.
     */
    public function editStepOne(Ad $ad): View
    {
        if (auth()->id() !== $ad->user_id) abort(403);
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();
        $attributes = PropertyAttribute::where('type', '!=', 'boolean')->orderBy('name->en')->get();
        return view($this->getView('edit-step-one'), compact('ad', 'cities', 'propertyTypes', 'features', 'attributes'));
    }

    /**
     * Update Step 1 data and store it in the session.
     */
    public function updateStepOne(Request $request, Ad $ad): RedirectResponse
    {
        if (auth()->id() !== $ad->user_id) abort(403);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 'property_type_id' => 'required|exists:property_types,id',
            'listing_purpose' => 'required|in:sale,rent', 'total_price' => 'required|numeric|min:0',
            'area_sq_meters' => 'required|numeric|min:0', 'description' => 'nullable|string|max:5000',
            'district_id' => 'required|exists:districts,id', 'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180', 'province' => 'required|string|max:255',
            'street_name' => 'required|string|max:255', 'age_years' => 'nullable|integer|min:0',
            'attributes' => 'nullable|array',
        ]);
        Session::put('ad_edit_step_one_data', $validatedData);
        return redirect($this->getRoute('edit.step2', $ad));
    }
    
    /**
     * Show the form for editing Step 2 of an existing ad.
     */
    public function editStepTwo(Ad $ad): View|RedirectResponse
    {
        if (auth()->id() !== $ad->user_id) abort(403);
        if (!Session::has('ad_edit_step_one_data')) {
            return redirect($this->getRoute('edit.step1', $ad));
        }
        return view($this->getView('edit-step-two'), compact('ad'));
    }

    /**
     * Update an existing ad.
     */
    public function updateAd(Request $request, Ad $ad): RedirectResponse
    {
        if (auth()->id() !== $ad->user_id) abort(403);
        $stepOneData = Session::pull('ad_edit_step_one_data');
        if (!$stepOneData) { return redirect($this->getRoute('edit.step1', $ad))->with('error', 'Session expired.'); }
        $validated = $request->validate([
            'images.*' => ['nullable', 'image', 'max:5120'], 'video' => ['nullable', 'string'],
            'delete_images' => ['nullable', 'array'], 'delete_video' => ['nullable', 'boolean'], 'terms' => ['accepted'],
        ]);
        $updateData = $stepOneData;
        $updateData['features'] = $stepOneData['attributes'] ?? $ad->features;
        unset($updateData['attributes']);
        $currentImages = $ad->images ?? [];
        if (!empty($validated['delete_images'])) {
            foreach ($validated['delete_images'] as $path) { Storage::disk('public')->delete($path); }
            $currentImages = array_diff($currentImages, $validated['delete_images']);
        }
        $newImagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) { $newImagePaths[] = $image->store('ads/images', 'public'); }
        }
        $updateData['images'] = array_values(array_merge($currentImages, $newImagePaths));
        if ($request->boolean('delete_video') && $ad->video_path) {
            Storage::disk('public')->delete($ad->video_path);
            $updateData['video_path'] = null;
        } elseif ($request->filled('video')) {
            if ($ad->video_path) Storage::disk('public')->delete($ad->video_path);
            $updateData['video_path'] = $request->video;
        }
        $updateData['status'] = 'pending';
        $updateData['user_status'] = 'available';
        $ad->update($updateData);
        return redirect($this->getRoute('index'))->with('success', 'Ad updated and sent for re-approval.');
    }
    
    /**
     * Handle AJAX video uploads.
     */
    public function uploadVideo(Request $request): JsonResponse
    {
        $request->validate(['video' => ['required', 'file', 'mimes:mp4,mov,webm', 'max:51200']]);
        return response()->json(['path' => $request->file('video')->store('ads/videos', 'public')]);
    }
    
    /**
     * Update the user-controlled status of an ad.
     */
    public function updateStatus(Request $request, Ad $ad): RedirectResponse
    {
        if (auth()->id() !== $ad->user_id) abort(403);
        if ($ad->status !== 'active') { return back()->with('error', 'You cannot change the status of an ad that is not approved.'); }
        $validated = $request->validate(['user_status' => ['required', Rule::in(['available', 'sold', 'unavailable'])]]);
        $ad->update(['user_status' => $validated['user_status']]);
        return back()->with('success', 'Ad status has been updated successfully!');
    }

    /**
     * Delete an ad.
     */
    public function destroy(Ad $ad): RedirectResponse
    {
        if (auth()->id() !== $ad->user_id) abort(403);
        $ad->delete();
        return redirect($this->getRoute('index'))->with('success', 'Ad has been deleted successfully.');
    }
}