<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->paginate(15);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
            'code' => 'nullable|string|max:3',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active');

        Country::create($data);

        return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
            'code' => 'nullable|string|max:3',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active');

        $country->update($data);

        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }
}