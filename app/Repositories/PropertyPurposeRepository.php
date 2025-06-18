<?php

namespace App\Repositories;

use App\Models\PropertyPurpose;

class PropertyPurposeRepository extends BaseRepository
{
    public function __construct(PropertyPurpose $model)
    {
        parent::__construct($model);
    }

    public function getActive()
    {
        return $this->model->where('is_active', true)->get();
    }

    public function toggleStatus($id)
    {
        $propertyPurpose = $this->find($id);
        $propertyPurpose->is_active = !$propertyPurpose->is_active;
        $propertyPurpose->save();
        return $propertyPurpose;
    }
} 