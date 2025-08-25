<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Fetch all cities, ordered by the latest created, and paginate the results
        $cities = City::latest()->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // We only need to return the view, as there's no data to pass
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:cities',
            'is_active' => 'sometimes|boolean'
        ]);

        // Create the new city in the database
        City::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('admin.cities.index')->with('success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     * (Not typically used in a simple CRUD, but included for completeness)
     */
    public function show(City $city): View
    {
        // You can create a 'show' view if you need to display a single city's details
        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city): View
    {
        // Pass the specific city model to the edit view
        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city): RedirectResponse
    {
        // Validate the incoming request data, ensuring the name is unique except for the current city
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
            'is_active' => 'sometimes|boolean'
        ]);

        // Update the city's details
        $city->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city): RedirectResponse
    {
        // Delete the city
        $city->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
    }
}