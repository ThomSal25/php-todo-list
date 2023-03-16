<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function index(){
    return view('login');
   }

   function registration(){
    return view('registration');
   }

   function logout(){

   }
}
