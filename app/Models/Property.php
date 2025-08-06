<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     * UPDATED: Added 'district_id' and removed 'city', 'neighborhood'.
     */
    protected $fillable = [
        'title',
        'description',
        'district_id', // <-- THIS IS THE NEW REQUIRED FIELD
        'street_width',
        'facade',
        'area_sq_meters',
        'purpose_id',
        'price_per_unit',
        'total_price',
        'property_type_id',
        'age_years',
        'services',
        'listing_purpose',
        'contact_number',
        'encumbrances',
        'status',
        'list_date',
        'sold_rented_date',
        'agent_id',
        'user_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'street_width' => 'decimal:2',
        'area_sq_meters' => 'decimal:2',
        'price_per_unit' => 'decimal:2',
        'total_price' => 'decimal:2',
        'services' => 'array',
        'list_date' => 'date',
        'sold_rented_date' => 'date',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(150)
              ->height(150)
              ->sharpen(10);
    }

    /**
     * ADDED: This is the missing relationship method that causes the error.
     * A Property belongs to a District.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function purpose()
    {
        return $this->belongsTo(PropertyPurpose::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}