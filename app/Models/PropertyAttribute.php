<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PropertyAttribute extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'type', 'icon_path'];
    public $translatable = ['name'];

    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class, 'attribute_property_type');
    }
}