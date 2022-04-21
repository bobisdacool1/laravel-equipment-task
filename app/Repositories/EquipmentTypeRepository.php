<?php /** @noinspection PhpInconsistentReturnPointsInspection */


namespace App\Repositories;


use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;

class EquipmentTypeRepository extends BasicRepository
{
    protected function getModelWithRelations()
    {
        return EquipmentType::query();
    }

    protected function getModel()
    {
        return EquipmentType::class;
    }

    protected function newResourceCollection($data)
    {
        return EquipmentTypeResource::collection($data);
    }

    protected function newResource($object)
    {
        return new EquipmentTypeResource($object);
    }
}
