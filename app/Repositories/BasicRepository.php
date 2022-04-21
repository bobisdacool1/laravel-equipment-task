<?php /** @noinspection PhpInconsistentReturnPointsInspection */


namespace App\Repositories;


use App\Repositories\Interfaces\IBasicRepository;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BasicRepository extends Repository implements IBasicRepository
{
    /**
     * @param int $quantity
     * @param int $page
     * @param array|string[] $sort
     * @param array $searchFields
     * @return JsonResource|mixed
     */
    public function getAll(int $quantity = 50, int $page = 1, array $sort = ['field' => 'created_at', 'order' => 'asc'], array $searchFields = [])
    {
        try {
            return $this->newResourceCollection(
                $this->getModelWithRelations()
                    ->where(function ($query) use ($searchFields) {
                        foreach ($searchFields as $searchKey => $searchValue) {
                            $query->where($searchKey, 'LIKE', "%$searchValue%");
                        }
                    })
                    ->orderBy($sort['field'], $sort['order'])
                    ->paginate($quantity, page: $page)
            );
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }
    }

    /**
     * @return JsonResource
     */
    abstract protected function newResourceCollection($data);

    /**
     * @return Builder
     */

    abstract protected function getModelWithRelations();

    /**
     * @param int $id
     * @return JsonResource|mixed
     */
    public function getById(int $id)
    {
        try {
            return $this->newResource(
                $this->getModelWithRelations()->where('id', $id)->first()
            );
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }
    }

    /**
     * @return JsonResource
     */
    abstract protected function newResource($object);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        try {
            $model = $this->getModel()::where('id', $id)->first();

            if ($model == null)
                abort(400);

            return $model->delete();
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }
    }

    /**
     * @return Model
     */
    abstract protected function getModel();

    /**
     * @param int $id
     * @param array $fields
     * @return JsonResource|mixed
     */
    public function update(int $id, array $fields)
    {
        try {
            $model = $this->getModelWithRelations()->where('id', $id)->first();

            if ($model == null)
                abort(400);

            $model->fill($fields);
            $model->save();

            return $this->newResource($model);
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }
    }

    /**
     * @param array $fields
     * @return JsonResource|mixed
     */
    public function save(array $fields)
    {
        try {
            $model = new ($this->getModel())();
            $model->fill($fields);
            $model->save();

            return $this->newResource($model);
        } catch (Exception $e) {
            abort(400, $e->getMessage());
        }
    }
}
