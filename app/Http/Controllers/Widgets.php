<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Widget;

class Widgets extends Controller
{
    public function getGasolinerasFromSource(){
        $widget=new Widget();
        return $widget->getGasolinerasFromSource();
    }
    public function saveGasolinerasFromSource(){
        $widget=new Widget();
        return $widget->saveGasolineras();
    }
    public function getNearestGasolinera(Request $request){
        $widget=new Widget();
        $lat=$request->lat;
        $lon=$request->lon;
        return $widget->getNearestGasolinera($lat,$lon);
    }
}
