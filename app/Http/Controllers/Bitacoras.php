<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Bitacora;

class Bitacoras extends Controller
{
    function index(Request $request){
        $data=$request->toArray();
        
        $bitacora=new Bitacora();
        foreach($data as $item){
            if($item==null||$item==''){
                return ["error"=>"invalid request"];
            }
            return [$bitacora->setEvent(
            $data['mensaje'],
            $data['placeID'],
            $data['type'],
            $data['keyID']
            )];
        }
    }
    function get(Request $request,$type){
        $bitacora=new Bitacora();
        return $bitacora->getByType($type,$request->limit);
    }
}
