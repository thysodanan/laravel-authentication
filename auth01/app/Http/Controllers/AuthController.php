<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin(){
        return view('login');
    }
    public function processLogin(Request $request){
        $validator=Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $credentials=$request->only('email','password');
        if(Auth::guard('web')->attempt($credentials)){
             $user=Auth::guard()->user()->role;
             if($user=='teacher'){
                 return redirect()->route('teacher.index');
             }elseif($user=='student'){
                 return redirect()->route('teacher.index');
             }
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }
    public function showRegister(){
        return view('register');
    } 
    public function processRegister(Request $request){
        $validator=Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user=new User();
        $user->name=$request->username;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect()->route('auth.login.show')->with('message','Registration Successful!');
    }
}
