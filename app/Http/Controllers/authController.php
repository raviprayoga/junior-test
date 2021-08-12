<?php

namespace App\Http\Controllers;

use App\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class authController extends Controller
{
     // Login
    public function login(){
        return view('auth.login');
    }
    public function loginpost(Request $request){
        // dd($request->all());
        // if(Auth::attempt($request->only('email','password'))){
        //     return redirect('/home');
        // }
        // return redirect('/login');

        // jwt
        //    if(Auth::attempt($request->only('email', 'password'))){
        //     $user = Auth::user();
        //     $token = $user->createToken('token')->plainTextToken;
        //     // return redirect('/home');
        //     return $token;
        //    }
        //    return redirect('/login');

        // $data = [
        //     'email' => $request->email,
        //     'password' => $request->password
        // ];
        // $user = Auth::attempt($data);
        
        // if($user){
        //     if(Auth::attempt($request->only('email', 'password'))){
        //         $token = JWTAuth::attempt($data);
        //         session(['jwt_token' => $token]);
        //         return redirect('/home');
        //     }else{
        //         return redirect()->back();
        //     }
        // }else {
        //     return redirect()->back()->with('wrong','Account does not exist!');
        // }
    $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // return response()->json(compact('token'));
        // return ($request);
        return redirect('home');

    }

    // signup
    public function signup( Request $request){
        return view('auth.signup');
    }
    public function registerPost(Request $request){
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
        ]);

        $data =  new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        // dd($request->all());
        return redirect('/login')->with('alert-success','Kamu berhasil Register');
    }

    // logout
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
