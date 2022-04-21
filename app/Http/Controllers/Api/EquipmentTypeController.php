<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentType\EquipmentTypeIndexRequest;
use App\Repositories\EquipmentTypeRepository;
use Illuminate\Http\JsonResponse;

class EquipmentTypeController extends Controller
{
    /**
     * @param EquipmentTypeIndexRequest $request
     * @return JsonResponse
     */
    public function index(EquipmentTypeIndexRequest $request)
    {
        $sort['field'] = $request->input('sort_by', 'created_at');
        $sort['order'] = $request->input('sort_order', 'asc');

        $searchField = $request->input('search', []);

        $count = $request->input('count', 50);
        $page = $request->input('page', 1);

        $channels = $this->repository->getAll($count, $page, $sort, $searchField);

        return response()->json($channels);
    }


    /**
     * @return EquipmentTypeRepository
     */
    protected function newRepository()
    {
        return new EquipmentTypeRepository();
    }
}
