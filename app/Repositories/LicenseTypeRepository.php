<?php

namespace App\Repositories;

use App\Models\LicenseType;

class LicenseTypeRepository extends BaseRepository
{
    public function __construct(LicenseType $model)
    {
        parent::__construct($model);
    }

    public function getActive()
    {
        return $this->model->where('is_active', true)->get();
    }

    public function toggleStatus($id)
    {
        $licenseType = $this->find($id);
        $licenseType->is_active = !$licenseType->is_active;
        $licenseType->save();
        return $licenseType;
    }
} 