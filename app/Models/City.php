<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'is_active',
    ];

    /**
     * Get the country that owns the City.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}