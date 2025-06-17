<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Agency extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'user_id',
        'agency_name',
        'agency_type_id',
        'commercial_register_number',
        'commercial_issue_date',
        'commercial_expiry_date',
        'tax_id',
        'tax_issue_date',
        'tax_expiry_date',
        'address',
        'phone_number',
        'email',
        'accreditation_status',
        'created_by',
        'updated_by'
    ];

    public $translatable = ['agency_name', 'address', 'accreditation_status'];

    protected $casts = [
        'commercial_issue_date' => 'date',
        'commercial_expiry_date' => 'date',
        'tax_issue_date' => 'date',
        'tax_expiry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agencyType()
    {
        return $this->belongsTo(AgencyType::class);
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