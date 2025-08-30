<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdPrice;
use App\Models\City;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class UserAdController extends Controller
{
    /**
     * Show the page to select an ad package.
     */
    public function create()
    {
        $adPrices = AdPrice::where('is_active', true)->get();

        if ($adPrices->isEmpty()) {
            return redirect()->route('user.my-ads')->with('error', 'No ad packages are available at the moment.');
        }
        return view('user.ads.create', ['adPrices' => $adPrices]);
    }

    /**
     * Show Step 1 of the ad creation form (Property Details).
     */
    public function createStepOne(AdPrice $adPrice)
    {
        $allAdPrices = AdPrice::where('is_active', true)->get();
        $cities = City::where('is_active', true)->orderBy('name')->get();
        $propertyTypes = PropertyType::where('is_active', true)->whereNull('parent_id')->orderBy('name')->get();
        $features = PropertyAttribute::where('type', 'boolean')->orderBy('name->en')->get();
        $attributes = PropertyAttribute::where('type', '!=', 'boolean')->orderBy('name->en')->get();

        return view('user.ads.create-step-one', [
            'selectedAdPrice' => $adPrice,
            'allAdPrices' => $allAdPrices,
            'cities' => $cities,
            'propertyTypes' => $propertyTypes,
            'features' => $features,
            'attributes' => $attributes,
        ]);
    }

    /**
     * Validate and store the data from Step 1 in the session.
     */
    public function storeStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'ad_price_id' => 'required|exists:ad_prices,id',
            'title' => 'required|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
            'listing_purpose' => 'required|in:sale,rent',
            'total_price' => 'required|numeric|min:0',
            'area_sq_meters' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:5000',
            'district_id' => 'required|exists:districts,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'province' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'is_mortgaged' => 'required|boolean',
            'age_years' => 'nullable|integer|min:0',
            'rooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'attributes' => 'nullable|array',
        ]);

        $request->session()->put('ad_step_one_data', $validatedData);

        return redirect()->route('user.ads.create.step2');
    }

    /**
     * Show Step 2 of the ad creation form (Media Uploads).
     */
    public function createStepTwo(Request $request)
    {
        $stepOneData = $request->session()->get('ad_step_one_data');
        if (!$stepOneData) {
            return redirect()->route('user.ads.create');
        }
        $selectedAdPrice = AdPrice::find($stepOneData['ad_price_id']);

        return view('user.ads.create-step-two', [
            'selectedAdPrice' => $selectedAdPrice,
        ]);
    }

    /**
     * Handle AJAX video uploads from the Uppy library.
     */
    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => ['required', 'file', 'mimes:mp4,mov,webm', 'max:51200'], // 50MB
        ]);

        // Store the file and return its path in a JSON response.
        $path = $request->file('video')->store('ads/videos', 'public');

        return response()->json(['path' => $path]);
    }

    /**
     * Combines data from both steps and creates the final Ad record.
     */
    public function storeAd(Request $request)
    {
        $stepOneData = Session::pull('ad_step_one_data');
        if (!$stepOneData) {
            return redirect()->route('user.ads.create')->with('error', 'انتهت صلاحية الجلسة. الرجاء البدء من جديد.');
        }
        // The 'video' field is now a string (the path), not a file.
        $request->validate([
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'video'    => ['nullable', 'string'],
            'terms'    => ['accepted'],
        ]);

        $adData = $stepOneData;
        $adData['user_id'] = Auth::id();
        $adData['status'] = 'pending';
        $adData['features'] = $adData['attributes'] ?? [];
        unset($adData['attributes']);

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('ads/images', 'public');
                $imagePaths[] = $path;
            }
            $adData['images'] = $imagePaths;
        }

        if ($request->filled('video')) {
            $adData['video_path'] = $request->video;
        }

        $ad = Ad::create($adData);

        Session::forget('ad_step_one_data');

        return redirect()->route('user.my-ads')->with([
            'success' => 'تم رفع اعلان عقارك بنجاح وهو الآن قيد المراجعة.',
            'new_ad_id' => $ad->id
        ]);
    }
}
