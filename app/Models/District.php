<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    // This tells Laravel to use the 'districts' table for this model
    protected $table = 'districts';

    protected $fillable = ['name', 'city_id'];

    // This defines the relationship: A District belongs to a City
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}