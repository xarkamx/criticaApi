<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Empresa;

class Empresas extends Controller
{
    public function index(Request $request){
        $empresa=new Empresa();
        return $empresa->printModel($request->id);
    }
    public function delete(){
        $empresa=new Empresa();
        //return [$empresa->deleteModel($request->id)];
    }
    public function set(Request $request){
        $empresa=new Empresa();
        return [$empresa->saveModel($request->toArray())];
    }
}
