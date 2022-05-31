<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{

    public function get_user() {

        return $this->successResponse([
            'user' => Auth::user(),
        ]);
    }

    public function login(LoginRequest $request) {


        if(!Auth::attempt($request->validated())){

            $this->errorResponse(['message' => 'Credentials invalid'], 401);

        }

        $token = Auth::user()->createToken('MyTokenTest')->accessToken;

        return $this->successResponse([
            'user' => Auth::user(),
            'token' => $token
        ]);

    }

    public function register(RegisterRequest $request){

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = $user->createToken('MyTokenTest')->accessToken;

        $user = $user->refresh();

        return $this->successResponse([
            'message' => 'ok',
            'token' => $token,
            'user' => $user
        ]);

    }
}
