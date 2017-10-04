<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Tools;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function addNewUser(Array $userData){
        $tools=new Tools();
        if(isset($userData['password'])){
            $userData['password']=bcrypt($userData['password']);
        }
        return $tools->saveByModel($this,
        $userData,null,"email",$userData['email']);
    }
    public function login(Array $credentials){
        unset($credentials['_token']);
        return Auth::attempt($credentials);
    }
    public function printUsers($by='id',$value=null){
        $tools=new Tools();
        if(!$tools->isCalledByAjax()){
            abort(404);
        }
        if($value==null){
            return $this->get();    
        }
        return $this->where($by,$value)->get();
    }
    public function deleteUser($id){
        if($this->find($id)->delete()){
            return [true];
        }
    }
}
