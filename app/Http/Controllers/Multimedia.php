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
        $type=$request->type;
        $media=$media->saveMedia($placeID,$type);
    }
    function updatePDF(Request $request){
        $media=new Media();
        $placeID=$request->placeID;
        $pdf=$media->savePdf($placeID);
    }
    function videos(Request $request){
        $media=new Media();
        $placeID=$request->placeID;
        return $media->getVideos($placeID);
    }
    function pdf(Request $request){
        $media=new Media();
        $placeID=$request->placeID;
        return $media->getPDF($placeID);
    }
}
