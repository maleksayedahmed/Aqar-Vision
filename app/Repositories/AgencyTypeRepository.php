<?php

namespace App\Repositories;

use App\Models\AgencyType;

class AgencyTypeRepository extends BaseRepository
{
    public function __construct(AgencyType $model)
    {
        parent::__construct($model);
    }

    public function getActive()
    {
        return $this->model->where('is_active', true)->get();
    }

    public function toggleStatus($id)
    {
        $agencyType = $this->find($id);
        $agencyType->is_active = !$agencyType->is_active;
        $agencyType->save();
        return $agencyType;
    }
} 