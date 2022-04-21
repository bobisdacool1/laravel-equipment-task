<?php


namespace App\Repositories\Interfaces;


interface ITokenRepository
{
    /**
     * @param int $userId
     * @param string $tokenName
     * @return mixed
     */
    public function generateNewToken(int $userId, string $tokenName);
}
