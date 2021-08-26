<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Model_Employees;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\RegisterRequest;

class ApiController extends Controller
{

    public function regis(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $data = $request->only('email', 'password');
        $token = auth()->attempt($data);
        // return response()->json(compact('user', 'token'));
        return (new UserResource($request->user()))
        ->additional(['meta' => [
            'token' => $token,
        ]]);
    }

    public function loginApi(LoginRequest $request)
    {
        $data = $request->only('email', 'password');
        if(!$token = auth()->attempt($data)){
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        return (new UserResource($request->user()))
        ->additional(['meta' => [
            'token' => $token,
        ]]);
    }

    public function user(Request $request)
    {
        $user = auth()->user();
        return new UserResource($user);
    }

    public function getEmployes($id)
    {

        $employe = Model_Employees::where('company_id',$id)->get();
        if($employe->count() > 0){
            return $employe;
        }else{
            return response()->json("tidak ada data yang ditemukan");
        }
    }
}
