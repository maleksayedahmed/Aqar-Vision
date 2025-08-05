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
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Foreign Keys
        'user_id',
        'ad_price_id',
        
        // Ad Status
        'status',
        'expires_at',

        // Step 1: Basic Info
        'title',
        'age',
        'transaction_type',
        'floor_number',
        'price',
        'finishing_status',
        'property_type',
        'direction',
        'bathrooms',
        'rooms',
        'area',
        'description',

        // Step 1: Location Info
        'city',
        'neighborhood',
        'province',
        'street',
        'latitude',         
        'longitude',       

        // Step 1: Features & Additional Details
        'features', // This will store the array of selected features
        'usage',
        'plan_number',
        'mortgaged',
        'furniture',
        'build_status',
        'building_number',
        'postal_code',

        // Step 2: Media (Simple path storage)
        'video_path',
        'images', // This will store an array of image paths
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'price' => 'decimal:2',
        'area' => 'decimal:2',
        'bathrooms' => 'integer',
        'rooms' => 'integer',
        'features' => 'array', // Automatically convert the features array to/from JSON
        'images' => 'array',   // Automatically convert the images array to/from JSON
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
}