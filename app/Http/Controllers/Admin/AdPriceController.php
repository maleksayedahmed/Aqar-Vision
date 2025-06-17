<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdPriceController extends Controller
{
    public function index()
    {
        $prices = AdPrice::all();
        return view('admin.ad-prices.index', compact('prices'));
    }

    public function create()
    {
        return view('admin.ad-prices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'name.ar' => 'required|string',
            'name.en' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'type' => 'required|in:regular,featured,premium',
            'description' => 'nullable|array',
            'description.ar' => 'nullable|string',
            'description.en' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

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
            'name.ar' => 'required|string',
            'name.en' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'type' => 'required|in:regular,featured,premium',
            'description' => 'nullable|array',
            'description.ar' => 'nullable|string',
            'description.en' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['updated_by'] = Auth::id();

        $adPrice->update($validated);

        return redirect()->route('admin.ad-prices.index')
            ->with('success', 'Ad price updated successfully.');
    }

    public function destroy(AdPrice $adPrice)
    {
        $adPrice->delete();

        return redirect()->route('admin.ad-prices.index')
            ->with('success', 'Ad price deleted successfully.');
    }
} 