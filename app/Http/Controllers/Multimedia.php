<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Media;

class Multimedia extends Controller
{
    function update(Request $request){
        $media=new Media();
        $placeID=$request->placeID;
        $videos=$media->saveVideos($placeID);
    }
    function videos(Request $request){
        $media=new Media();
        $placeID=$request->placeID;
        return $media->getVideos($placeID);
    }
}
