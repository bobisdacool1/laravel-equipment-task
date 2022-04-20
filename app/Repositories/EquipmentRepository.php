<?php /** @noinspection PhpInconsistentReturnPointsInspection */


namespace App\Repositories;


use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;

class EquipmentRepository extends BasicRepository
{
    protected function getModelWithRelations()
    {
        return Equipment::with('type');
    }

    protected function getModel()
    {
        return Equipment::class;
    }

    protected function newResourceCollection($data)
    {
        return EquipmentResource::collection($data);
    }

    protected function newResource($object)
    {
        return new EquipmentResource($object);
    }
}
