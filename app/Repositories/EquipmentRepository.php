<?php /** @noinspection PhpInconsistentReturnPointsInspection */


namespace App\Repositories;


use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Rules\FitMask;

class EquipmentRepository extends BasicRepository
{
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
