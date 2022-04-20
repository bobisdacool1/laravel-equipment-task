<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\EquipmentIndexRequest;
use App\Http\Requests\Equipment\StoreEquipmentRequest;
use App\Models\EquipmentType;
use App\Repositories\EquipmentRepository;
use App\Rules\FitMask;

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

        $mask = EquipmentType::where('id', $validated['type_id'])->first()->mask;

        $request->validate([
            'serial_code' => [
                'string',
                new FitMask($mask),
            ],
        ]);

        $equipment = $this->repository->save($validated);

        return response()->json($equipment);
    }

    public function update(StoreEquipmentRequest $request, int $id)
    {
        $validated = $request->validated();

        $mask = EquipmentType::where('id', $validated['type_id'])->first()->mask;

        $request->validate([
            'serial_code' => [
                'string',
                new FitMask($mask),
            ],
        ]);

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
