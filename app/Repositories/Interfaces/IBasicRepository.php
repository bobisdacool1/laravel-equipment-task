<?php


namespace App\Repositories\Interfaces;


interface IBasicRepository
{
    /**
     * @param int $quantity
     * @param int $page
     * @param array|string[] $sort
     * @param array $searchFields
     * @return mixed
     */
    public function getAll(int $quantity = 50, int $page = 1, array $sort = ['order' => 'asc', 'field' => 'created_at'], array $searchFields = []);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);

    /**
     * @param int $channelId
     * @param array $fields
     * @return mixed
     */
    public function update(int $channelId, array $fields);

    /**
     * @param array $fields
     * @return mixed
     */
    public function save(array $fields);
}
