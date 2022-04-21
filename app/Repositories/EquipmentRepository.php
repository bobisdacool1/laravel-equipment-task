<?php /** @noinspection PhpInconsistentReturnPointsInspection */


namespace App\Repositories;


use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Rules\FitMask;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentRepository extends BasicRepository
{
    /**
     * @param $request
     * @param null $type_id
     * @return mixed
     */
    public function checkIfSerialCodeFitTypeMask($request, $type_id = null)
    {
        if ($type_id === null)
            $type_id = $request->type_id;

        $mask = EquipmentType::where('id', $type_id)->first()->mask;

        return $request->validate([
            'serial_code' => [
                'string',
                new FitMask($mask),
            ],
        ]);
    }

    /**
     * @return Builder
     */
    protected function getModelWithRelations()
    {
        return Equipment::with('type');
    }

    /**
     * @return string
     */
    protected function getModel()
    {
        return Equipment::class;
    }

    /**
     * @param $data
     * @return AnonymousResourceCollection|JsonResource
     */
    protected function newResourceCollection($data)
    {
        return EquipmentResource::collection($data);
    }

    /**
     * @param $object
     * @return EquipmentResource
     */
    protected function newResource($object)
    {
        return new EquipmentResource($object);
    }
}
