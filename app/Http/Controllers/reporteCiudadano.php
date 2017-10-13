<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Reportes;
class reporteCiudadano extends Controller
{
    public function upload(Request $request){
        $data=$request->toArray();
        $reportes=new Reportes();
        return $reportes->uploadData($data);
    }
}
