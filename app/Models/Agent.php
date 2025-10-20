<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'full_name',
        'agent_type_id',
        'phone_number',
        'email',
        'city_id',
        'license_issue_date',
        'license_expiry_date',
        'national_id',
        'address',
        'agency_id',
        'created_by',
        'updated_by',
        'has_visited_active',
    ];

    protected $casts = [
        'license_issue_date' => 'date',
        'license_expiry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agentType()
    {
        return $this->belongsTo(AgentType::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

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

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribeTo(Plan $plan)
    {
        return $this->subscriptions()->create([
            'plan_id' => $plan->id,
            'ends_at' => now()->addDays($plan->duration_in_days),
        ]);
    }
}
