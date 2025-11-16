<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        // Load the city relationship to avoid extra database queries
        $districts = District::with('city')->latest()->paginate(10);
        return view('admin.districts.index', compact('districts'));
    }

    public function create()
    {
        // Get all cities to populate the dropdown
        $cities = City::orderBy('name')->get();
        return view('admin.districts.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);
        District::create($request->only('name', 'city_id'));
        return redirect()->route('admin.districts.index')->with('success', 'District created successfully.');
    }

    public function edit(District $district)
    {
        $cities = City::orderBy('name')->get();
        return view('admin.districts.edit', compact('district', 'cities'));
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
        ]);
        $district->update($request->only('name', 'city_id'));
        return redirect()->route('admin.districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('admin.districts.index')->with('success', 'District deleted successfully.');
    }
}