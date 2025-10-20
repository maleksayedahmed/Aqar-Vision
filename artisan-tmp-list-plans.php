<?php

use App\Models\Plan;
use Illuminate\Support\Facades\Artisan;

Artisan::command('list:plans', function () {
    $this->info(Plan::all());
})->purpose('List all plans');
