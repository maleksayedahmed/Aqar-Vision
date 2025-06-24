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
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'price_monthly' => 'decimal:2',
        'ads_regular' => 'integer',
        'ads_featured' => 'integer',
        'ads_premium' => 'integer',
        'ads_map' => 'integer',
        'agent_seats' => 'integer',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
