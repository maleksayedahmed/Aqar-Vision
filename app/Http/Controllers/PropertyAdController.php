<?php

namespace App\Http\Controllers;

use App\Models\AdPrice;
use App\Models\Property;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyAdController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $properties = Property::where('created_by', $user->id)->with('advertisements')->get();
        return view('property-ads.index', compact('properties'));
    }

    public function create()
    {
        $adPrices = AdPrice::where('is_active', true)->get();
        return view('property-ads.create', compact('adPrices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'ad_price_id' => 'required|exists:ad_prices,id',
        ]);

        $user = Auth::user();
        $property = Property::findOrFail($validated['property_id']);
        
        // Check if the user owns the property
        if ($property->created_by !== $user->id) {
            return back()->with('error', 'You do not have permission to create an ad for this property.');
        }

        $adPrice = AdPrice::findOrFail($validated['ad_price_id']);

        try {
            DB::beginTransaction();

            // Create the advertisement
            $advertisement = Advertisement::create([
                'property_id' => $property->id,
                'start_date' => now(),
                'end_date' => now()->addDays($adPrice->duration_days),
                'status' => 'active',
                'created_by' => $user->id,
                'updated_by' => $user->id
            ]);

            // Here you would typically handle payment processing
            // For now, we'll just create the ad

            DB::commit();

            return redirect()->route('property-ads.index')
                ->with('success', 'Property ad created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create property ad. Please try again.');
        }
    }

    public function show(Advertisement $advertisement)
    {
        $user = Auth::user();
        if ($advertisement->property->created_by !== $user->id) {
            abort(403);
        }

        return view('property-ads.show', compact('advertisement'));
    }

    public function cancel(Advertisement $advertisement)
    {
        $user = Auth::user();
        if ($advertisement->property->created_by !== $user->id) {
            abort(403);
        }

        $advertisement->update([
            'status' => 'cancelled',
            'updated_by' => $user->id
        ]);

        return redirect()->route('property-ads.index')
            ->with('success', 'Property ad cancelled successfully.');
    }
} 