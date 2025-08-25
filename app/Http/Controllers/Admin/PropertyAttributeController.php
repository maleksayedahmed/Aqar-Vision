<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyAttributeRequest;
use App\Models\PropertyAttribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PropertyAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $attributes = PropertyAttribute::latest()->paginate(15);
        return view('admin.property-attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Pass a null propertyAttribute to the form partial so it doesn't error on create
        return view('admin.property-attributes.create', ['propertyAttribute' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\PropertyAttributeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PropertyAttributeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Check if an icon file was uploaded in the request
        if ($request->hasFile('icon')) {
            // Store the file in 'public/storage/attribute_icons' and get its path
            $path = $request->file('icon')->store('attribute_icons', 'public');
            $data['icon_path'] = $path;
        }

        // If the type is 'dropdown', clean up any empty choice rows before saving.
        if (isset($data['choices'])) {
            $cleanedChoices = array_filter($data['choices'], function ($choice) {
                return !empty($choice['en']) && !empty($choice['ar']);
            });
            // Re-index the array to prevent JSON from creating an object instead of an array
            $data['choices'] = array_values($cleanedChoices);
        }

        PropertyAttribute::create($data);

        return redirect()->route('admin.property-attributes.index')
            ->with('success', __('messages.created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PropertyAttribute $propertyAttribute
     * @return \Illuminate\View\View
     */
    public function edit(PropertyAttribute $propertyAttribute): View
    {
        return view('admin.property-attributes.edit', compact('propertyAttribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\PropertyAttributeRequest $request
     * @param \App\Models\PropertyAttribute $propertyAttribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PropertyAttributeRequest $request, PropertyAttribute $propertyAttribute): RedirectResponse
    {
        $data = $request->validated();

        // Check if a new icon file was uploaded
        if ($request->hasFile('icon')) {
            // If an old icon exists, delete it from storage to save space
            if ($propertyAttribute->icon_path) {
                Storage::disk('public')->delete($propertyAttribute->icon_path);
            }
            // Store the new icon and get its path
            $path = $request->file('icon')->store('attribute_icons', 'public');
            $data['icon_path'] = $path;
        }

        // Handle the 'choices' field based on the selected 'type'
        if ($data['type'] === 'dropdown' && isset($data['choices'])) {
            $cleanedChoices = array_filter($data['choices'], function ($choice) {
                return !empty($choice['en']) && !empty($choice['ar']);
            });
            // Re-index the array
            $data['choices'] = array_values($cleanedChoices);
        } else {
            // If the type is NOT dropdown, ensure the choices are set to null to clear them from the database.
            $data['choices'] = null;
        }

        $propertyAttribute->update($data);

        return redirect()->route('admin.property-attributes.index')
            ->with('success', __('messages.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PropertyAttribute $propertyAttribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PropertyAttribute $propertyAttribute): RedirectResponse
    {
        // Optional: Check if attribute is in use before deleting
        if ($propertyAttribute->propertyTypes()->exists()) {
            return redirect()->route('admin.property-attributes.index')
                ->with('error', 'Cannot delete attribute as it is assigned to one or more property types.');
        }

        // Also delete the icon file from storage when the attribute is deleted
        if ($propertyAttribute->icon_path) {
            Storage::disk('public')->delete($propertyAttribute->icon_path);
        }

        $propertyAttribute->delete();

        return redirect()->route('admin.property-attributes.index')
            ->with('success', __('messages.deleted_successfully'));
    }
}