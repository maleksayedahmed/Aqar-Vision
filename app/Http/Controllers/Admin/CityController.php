<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('country')->latest()->paginate(15);
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::where('is_active', true)->orderBy('name')->get();
        return view('admin.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active');

        City::create($data);

        return redirect()->route('admin.cities.index')->with('success', 'City created successfully.');
    }

    public function edit(City $city)
    {
        $countries = Country::where('is_active', true)->orderBy('name')->get();
        return view('admin.cities.edit', compact('city', 'countries'));
    }

    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active');
        
        $city->update($data);

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
    }
}