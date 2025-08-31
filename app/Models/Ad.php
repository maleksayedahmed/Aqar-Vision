<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * This array is now updated to remove the old, fixed columns.
     */
    protected $fillable = [
        // Foreign Keys
        'user_id',
        'ad_price_id',
        'property_type_id',
        'district_id',

        // Ad Status
        'status',
        'user_status',
        'expires_at',

        // Core Property Details
        'title',
        'description',
        'listing_purpose',
        'total_price',
        'area_sq_meters',
        'age_years',

        // Location Details
        'latitude',         
        'longitude',       
        'street_name',
        'province',

        // Features & Additional Details (Now includes all dynamic attributes)
        'features',
        'property_usage',
        'plan_number',
        'building_status',
        'building_number',
        'postal_code',

        // Media Paths
        'video_path',
        'images',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'total_price' => 'decimal:2',
        'area_sq_meters' => 'decimal:2',
        'features' => 'array', // This is now the main field for dynamic attributes
        'images' => 'array',
    ];

    /**
     * Get the user who owns the ad.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the ad package details for this ad.
     */
    public function adPrice()
    {
        return $this->belongsTo(AdPrice::class);
    }

    /**
     * Get the district for this ad.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the property type for this ad.
     */
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}