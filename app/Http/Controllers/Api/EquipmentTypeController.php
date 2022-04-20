<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EquipmentRepository;

class EquipmentTypeController extends Controller
{
    //
    protected function newRepository()
    {
        return new EquipmentRepository();
    }
}
