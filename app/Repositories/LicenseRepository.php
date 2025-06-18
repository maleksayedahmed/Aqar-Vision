<?php

namespace App\Repositories;

use App\Models\License;

class LicenseRepository extends BaseRepository
{
    public function __construct(License $model)
    {
        parent::__construct($model);
    }

    public function getWithRelations($id)
    {
        return $this->model->with(['licenseType', 'agent', 'agency', 'creator', 'updater'])->findOrFail($id);
    }

    public function paginate($perPage = 10)
    {
        return $this->model->with(['licenseType', 'agent', 'agency'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByAgency($agencyId)
    {
        return $this->model->where('agency_id', $agencyId)
            ->with(['licenseType', 'agent'])
            ->get();
    }

    public function getByAgent($agentId)
    {
        return $this->model->where('agent_id', $agentId)
            ->with(['licenseType', 'agency'])
            ->get();
    }

    public function getExpiringSoon($days = 30)
    {
        return $this->model->where('expiry_date', '<=', now()->addDays($days))
            ->where('expiry_date', '>=', now())
            ->with(['licenseType', 'agent', 'agency'])
            ->get();
    }

    public function getExpired()
    {
        return $this->model->where('expiry_date', '<', now())
            ->with(['licenseType', 'agent', 'agency'])
            ->get();
    }
} 