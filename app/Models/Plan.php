<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Plan extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'name',
        'target_type',
        'price_monthly',
        'ads_regular',
        'ads_featured',
        'ads_premium',
        'ads_map',
        'agent_seats',
        'description',
        'created_by',
        'updated_by',
        'duration_in_days',
        'features',
        'monthly_price',
        'yearly_price',
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'price_monthly' => 'decimal:2',
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'ads_regular' => 'integer',
        'ads_featured' => 'integer',
        'ads_premium' => 'integer',
        'ads_map' => 'integer',
        'agent_seats' => 'integer',
        'features' => 'array',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function scopeNotFree($query)
    {
        return $query->where('price_monthly', '>', 0);
    }
}
