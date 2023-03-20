<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
   public function index(){
    return view('login');
   }

   function registration(){
    return view('registration');
   }

   function validate_registration(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password' => [
                'required',
                // 'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $data=$request->all();

        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);

        return redirect('login')->with('success', 'Registration Completed, now you can login');
   }

   function validate_login(Request $request){
    $request->validate([
        'email'=>'required',
        'password'=>'required'
    ]);
    $credentials = $request->only ('email', 'password');

    if(Auth::attempt($credentials)){
        return redirect('dashboard');
    } 
    
    return redirect('login')->with('success', 'Login details are not valid');

   }

   function dashboard(){
    if(Auth::check()){
        return view('dashboard');
    }

    return redirect('login')->with('success', 'Please login');

   }

   function logout(){
        Session::flush();

        Auth::logout();

        return redirect('login')->with('success', 'You are logged out now.');
   }
}
