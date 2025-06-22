<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PropertyType extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'name',
        'parent_id', // Add this
        'icon',      // Add this
        'description',
        'is_active',
        'created_by',
        'updated_by'
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Parent relationship
    public function parent()
    {
        return $this->belongsTo(PropertyType::class, 'parent_id');
    }

    // Children relationship
    public function children()
    {
        return $this->hasMany(PropertyType::class, 'parent_id');
    }

    // Applicable attributes relationship
    public function attributes()
    {
        return $this->belongsToMany(PropertyAttribute::class, 'attribute_property_type');
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
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