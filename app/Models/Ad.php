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
     * This array is now updated to match the database and form fields.
     */
    protected $fillable = [
        // Foreign Keys
        'user_id',
        'ad_price_id',
        'property_type_id',
        'district_id',

        // Ad Status
        'status',
        'expires_at',

        // Property Details from Step 1
        'title',
        'description',
        'listing_purpose',
        'total_price',
        'area_sq_meters',
        'age_years',
        'rooms',
        'bathrooms',
        'floor_number',
        'finishing_status',
        'facade',

        // Location Details
        'latitude',         
        'longitude',       
        'street_name',
        'province',

        // Features & Additional Details
        'features',
        'property_usage',
        'plan_number',
        'is_mortgaged',
        'furniture_status',
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
        'bathrooms' => 'integer',
        'rooms' => 'integer',
        'features' => 'array',
        'images' => 'array',
        'is_mortgaged' => 'boolean',
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