<?php

namespace App\Repositories;

use App\Models\Agent;

class AgentRepository extends BaseRepository
{
    public function __construct(Agent $model)
    {
        parent::__construct($model);
    }

    public function getByType($typeId)
    {
        return $this->model->where('agent_type_id', $typeId)->get();
    }

    public function getByUser($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }

    public function getWithRelations($id)
    {
        return $this->model->with(['user', 'agentType', 'agency', 'creator', 'updater'])->findOrFail($id);
    }
} 