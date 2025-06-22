<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class LicenseType extends Model
{
    use HasTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'created_by',
        'updated_by'
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function licenses()
    {
        return $this->hasMany(License::class);
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