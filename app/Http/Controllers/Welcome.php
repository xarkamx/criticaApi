<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;

class Welcome extends Controller
{
    public function index(){
        if(Auth::check()){
            return view('Posts.portadaSetter');
        }
        $users=new User();
        if(count($users->get())==0){
            return view('register');
        }
        return view('welcome');
    }
}
