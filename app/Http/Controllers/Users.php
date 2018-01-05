<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Bitacora;

class Users extends Controller
{
    public function set(Request $request){
        $user= new User();
        return [$user->addNewUser($request->toArray())];
    }
    public function login(Request $request){
        $bitacora=new Bitacora();
        $user=new User();
        $event="Acceso de ".$request->email;
        $failevent="error de login con el usuario ".$request->email;
        $resp=$user->login($request->toArray());
        if($resp==true){
            $bitacora->setEvent($event,0,"login",$id=0);
        }else{
            $bitacora->setEvent($failevent,0,"loginError",$id=0);
        }
        return [$resp];
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
