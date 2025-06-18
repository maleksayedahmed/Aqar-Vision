<?php

namespace App\Repositories;

use App\Models\PropertyType;

class PropertyTypeRepository extends BaseRepository
{
    public function __construct(PropertyType $model)
    {
        parent::__construct($model);
    }

    public function getActive()
    {
        return $this->model->where('is_active', true)->get();
    }

    public function toggleStatus($id)
    {
        $propertyType = $this->find($id);
        $propertyType->is_active = !$propertyType->is_active;
        $propertyType->save();
        return $propertyType;
    }
} 