<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommercialRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agency_id',
        'commercial_register_number',
        'commercial_issue_date',
        'commercial_expiry_date',
        'city',
        'address',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'commercial_issue_date' => 'date',
        'commercial_expiry_date' => 'date',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
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