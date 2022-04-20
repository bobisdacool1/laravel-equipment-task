<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TokenRepository;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function new(Request $request)
    {
        $token = $this->repository->generateNewToken($request->user_id, $request->token_name);

        return response()->json(['token' => $token]);
    }

    protected function newRepository()
    {
        return new TokenRepository();
    }
}
