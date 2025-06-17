<?php

namespace App\Repositories;

use App\Models\Agency;

class AgencyRepository extends BaseRepository
{
    public function __construct(Agency $model)
    {
        parent::__construct($model);
    }

    public function getByType($typeId)
    {
        return $this->model->where('agency_type_id', $typeId)->get();
    }

    public function getByUser($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }

    public function getWithRelations($id)
    {
        return $this->model->with(['user', 'agencyType', 'creator', 'updater'])->findOrFail($id);
    }

    public function updateAccreditationStatus($id, $status)
    {
        $agency = $this->find($id);
        $agency->accreditation_status = $status;
        $agency->save();
        return $agency;
    }
} 