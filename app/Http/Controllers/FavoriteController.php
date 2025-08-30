<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class FavoriteController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user's favorite properties.
     */
    public function index()
    {
        $favorites = Auth::user()->favoriteAds()
            ->with(['propertyType', 'district.city', 'user'])
            ->where('status', 'active')
            ->paginate(12);

        return view('favorites.index', compact('favorites'));
    }

    /**
     * Add a property to favorites.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:ads,id'
        ]);

        $ad = Ad::findOrFail($request->ad_id);

        // Check if already favorited
        $exists = Favorite::where('user_id', Auth::id())
            ->where('ad_id', $ad->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'العقار مضاف مسبقاً إلى المفضلة'
            ], 409);
        }

        Favorite::create([
            'user_id' => Auth::id(),
            'ad_id' => $ad->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة العقار إلى المفضلة'
        ]);
    }

    /**
     * Remove a property from favorites.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:ads,id'
        ]);

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('ad_id', $request->ad_id)
            ->first();

        if (!$favorite) {
            return response()->json([
                'status' => 'error',
                'message' => 'العقار غير موجود في المفضلة'
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم إزالة العقار من المفضلة'
        ]);
    }

    /**
     * Toggle favorite status for a property.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:ads,id'
        ]);

        $adId = $request->ad_id;
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('ad_id', $adId)
            ->first();

        if ($favorite) {
            // Remove from favorites
            $favorite->delete();
            $isFavorited = false;
            $message = 'تم إزالة العقار من المفضلة';
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => Auth::id(),
                'ad_id' => $adId
            ]);
            $isFavorited = true;
            $message = 'تم إضافة العقار إلى المفضلة';
        }

        return response()->json([
            'status' => 'success',
            'is_favorited' => $isFavorited,
            'message' => $message
        ]);
    }
}
