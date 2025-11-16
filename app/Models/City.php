<?php

namespace App\Models; // <-- ENSURE THIS NAMESPACE IS CORRECT

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}