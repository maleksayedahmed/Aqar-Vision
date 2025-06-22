<?php

namespace App\Repositories;

use App\Models\CommercialRecord;

class CommercialRecordRepository extends BaseRepository
{
    public function __construct(CommercialRecord $model)
    {
        parent::__construct($model);
    }

    public function getWithRelations($id)
    {
        return $this->model->with(['agency', 'creator', 'updater'])->findOrFail($id);
    }

    public function paginate($perPage = 10)
    {
        return $this->model->with(['agency'])->orderBy('created_at', 'desc')->paginate($perPage);
    }
} 