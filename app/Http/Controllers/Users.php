<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class Users extends Controller
{
    public function set(Request $request){
        $user= new User();
        return [$user->addNewUser($request->toArray())];
    }
    public function login(Request $request){
        $user=new User();
        return [$user->login($request->toArray())];
    }
    public function logout(){
        \Auth::logout();
        return redirect("/");
    }
    public function index(Request $request){
        $users=new User();
        return $users->printUsers($request->by,$request->value);
    }
    public function delete(Request $request){
        $users=new User();
        return $users->deleteUser($request->id);
    }
    public function currentUser(){
        return \Auth::user();
    }
}
