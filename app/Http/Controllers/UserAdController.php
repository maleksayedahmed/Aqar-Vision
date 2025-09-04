<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AdFormManagementTrait;
use Illuminate\Http\Request;

class UserAdController extends Controller
{
    /**
     * This controller uses a shared trait to handle all the logic for creating,
     * editing, and managing ads. The logic is identical for both regular
     * users and agents, so it is stored in one place for maintainability.
     */
    use AdFormManagementTrait;

    // You can add any methods here that are SPECIFIC ONLY to regular users.
    // Currently, all ad management logic is shared.
}