<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class authController extends Controller
{
     // Login
    public function login(){
        return view('auth.login');
    }
    public function loginpost(Request $request){
        // dd($request->all());
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/home');
        }
        return redirect('/login');
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
