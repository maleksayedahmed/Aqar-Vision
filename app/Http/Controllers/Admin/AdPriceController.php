<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <-- IMPORT the Storage facade

class AdPriceController extends Controller
{
    public function index()
    {
        $prices = AdPrice::latest()->paginate(10);
        return view('admin.ad-prices.index', compact('prices'));
    }

    public function create()
    {
        return view('admin.ad-prices.create', ['adPrice' => new AdPrice()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'type' => 'required|string|max:50|unique:ad_prices,type',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'icon_path' => 'nullable|image|mimes:svg,png,jpg,jpeg|max:1024', // <-- UPDATED VALIDATION
        ]);

        // Handle the file upload
        if ($request->hasFile('icon_path')) {
            $path = $request->file('icon_path')->store('ad-price-icons', 'public');
            $validated['icon_path'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['created_by'] = Auth::id();

        AdPrice::create($validated);

        return redirect()->route('admin.ad-prices.index')
            ->with('success', 'Ad price created successfully.');
    }

    public function edit(AdPrice $adPrice)
    {
        return view('admin.ad-prices.edit', compact('adPrice'));
    }

    public function update(Request $request, AdPrice $adPrice)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'type' => 'required|string|max:50|unique:ad_prices,type,' . $adPrice->id,
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'icon_path' => 'nullable|image|mimes:svg,png,jpg,jpeg|max:1024', // <-- UPDATED VALIDATION
        ]);

        // Handle the file upload for update
        if ($request->hasFile('icon_path')) {
            // Delete the old icon if it exists
            if ($adPrice->icon_path) {
                Storage::disk('public')->delete($adPrice->icon_path);
            }
            // Store the new icon
            $path = $request->file('icon_path')->store('ad-price-icons', 'public');
            $validated['icon_path'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['updated_by'] = Auth::id();

        $adPrice->update($validated);

        return redirect()->route('admin.ad-prices.index')
            ->with('success', 'Ad price updated successfully.');
    }

    public function destroy(AdPrice $adPrice)
    {
        // Delete the icon file from storage before deleting the record
        if ($adPrice->icon_path) {
            Storage::disk('public')->delete($adPrice->icon_path);
        }

        $adPrice->delete();

        return redirect()->route('admin.ad-prices.index')
            ->with('success', 'Ad price deleted successfully.');
    }
}