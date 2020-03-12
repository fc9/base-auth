<?php

namespace Fc9\Auth\Http\Controllers\Api;

use Fc9\Auth\Http\Requests\RegisterRequest;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = (new \Fc9\Auth\Services\RegisterService)->register($request->all());

        return response()->json($user, 201);
    }
}