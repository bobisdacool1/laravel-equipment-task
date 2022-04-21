<?php /** @noinspection PhpInconsistentReturnPointsInspection */


namespace App\Repositories;


use App\Http\Resources\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentTypeRepository extends BasicRepository
{
    /**
     * @return Builder
     */
    protected function getModelWithRelations()
    {
        return EquipmentType::query();
    }

    /**
     * @return string
     */
    protected function getModel()
    {
        return EquipmentType::class;
    }

    /**
     * @param $data
     * @return AnonymousResourceCollection|JsonResource
     */
    protected function newResourceCollection($data)
    {
        return EquipmentTypeResource::collection($data);
    }

    /**
     * @param $object
     * @return EquipmentTypeResource
     */
    protected function newResource($object)
    {
        return new EquipmentTypeResource($object);
    }
}
