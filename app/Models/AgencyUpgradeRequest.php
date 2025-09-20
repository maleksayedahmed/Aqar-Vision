<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyUpgradeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'upgrade_request_id',
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
    ];

    public function upgradeRequest()
    {
        return $this->belongsTo(UpgradeRequest::class);
    }

    public function agencyType()
    {
        return $this->belongsTo(AgencyType::class);
    }
}
