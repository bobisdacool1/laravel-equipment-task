<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TokenRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function new(Request $request)
    {
        $token = $this->repository->generateNewToken($request->user_id, $request->token_name);

        return response()->json(['token' => $token]);
    }

    /**
     * @return TokenRepository
     */
    protected function newRepository()
    {
        return new TokenRepository();
    }
}
