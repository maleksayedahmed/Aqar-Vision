<?php

namespace App\Repositories;

use App\Models\AgentType;

class AgentTypeRepository extends BaseRepository
{
    public function __construct(AgentType $model)
    {
        parent::__construct($model);
    }

    public function getActive()
    {
        return $this->model->where('is_active', true)->get();
    }
} 