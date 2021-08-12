<?php

namespace App\Http\Controllers;
use App\Http\Resource\User as UserResource;
use Illuminate\Http\Request;

class LoginJWTController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error' => 'invalid credentials']);
        }
        return (new UserResource($request->user()))
                    ->additional(['meta' => [
                        'token' => $token,
                    ]]);
    }
}
