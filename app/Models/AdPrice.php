<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AdPrice extends Model
{
    use HasTranslations, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'duration_days',
        'type',
        'is_active',
        'description',
        'icon_path',
        'created_by',
        'updated_by'
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}