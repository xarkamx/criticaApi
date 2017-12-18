<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pliego;

class Pliegos extends Controller
{
     function setPostToImpreso(Request $request){
        $pliegos=new Pliego();
        return [$pliegos->add($request->toArray())];
        //return [$request->toArray()];
    }
    function getPostsByPliego(Request $request){
        $pliegos=new Pliego();
        return $pliegos->getPostsByPliego($request->pliego);
    }
    function deletePostFromPliego(Request $request){
        $pliegos=new Pliego();
        return [$pliegos->deletePostFromPliego($request->toArray())];
    }
}