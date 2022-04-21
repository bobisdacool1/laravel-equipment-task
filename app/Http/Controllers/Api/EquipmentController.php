<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\EquipmentIndexRequest;
use App\Http\Requests\Equipment\StoreEquipmentRequest;
use App\Http\Requests\Equipment\StoreManyEquipmentRequest;
use App\Repositories\EquipmentRepository;

class EquipmentController extends Controller
{
    public function index(EquipmentIndexRequest $request)
    {
        $sort['field'] = $request->input('sort_by', 'created_at');
        $sort['order'] = $request->input('sort_order', 'asc');

        $searchField = $request->input('search', []);

        $count = $request->input('count', 50);
        $page = $request->input('page', 1);

        $channels = $this->repository->getAll($count, $page, $sort, $searchField);

        return response()->json($channels);
    }

    public function show(int $channelId)
    {
        $channel = $this->repository->getById($channelId);

        return response()->json($channel);
    }

    public function store(StoreEquipmentRequest $request)
    {
        $validated = $request->validated();
        $this->repository->checkIfSerialCodeFitTypeMask($request);

        $equipment = $this->repository->save($validated);

        return response()->json($equipment);
    }

    // in php there is no methood reload, so i cant make two methods with different input request types, so i just made two methods
    public function storeMany(StoreManyEquipmentRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated as $validatedItem) {
            $this->checkIfSerialCodeFitTypeMask($request, $validatedItem['type_id']);

            // this is bad, it would be better if i could save multiple records once
            $equipment[] = $this->repository->save($validatedItem);
        }

        return response()->json($equipment);
    }

    public function update(StoreEquipmentRequest $request, int $id)
    {
        $validated = $request->validated();
        $this->repository->checkIfSerialCodeFitTypeMask($request);

        $equipment = $this->repository->update($id, $validated);

        return response()->json($equipment);
    }

    public function destroy(int $channelId)
    {
        $deleted = $this->repository->destroy($channelId);

        return response()->json(['deleted' => $deleted]);
    }

    protected function newRepository()
    {
        return new EquipmentRepository();
    }
}
