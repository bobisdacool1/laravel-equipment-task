<?php


namespace App\Repositories\Interfaces;


interface IBasicRepository
{
    public function getAll(int $quantity = 50, int $page = 1, array $sort = ['order' => 'asc', 'field' => 'created_at'], array $searchFields = []);

    public function getById(int $id);

    public function destroy(int $id);

    public function update(int $channelId, array $fields);

    public function save(array $fields);
}
