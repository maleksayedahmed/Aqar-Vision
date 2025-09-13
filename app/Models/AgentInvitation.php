<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentInvitation extends Model
{
    protected $fillable = ['agency_id', 'agent_id', 'status'];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
