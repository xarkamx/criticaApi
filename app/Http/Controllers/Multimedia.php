<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Media;

use App\Bitacora;

class Multimedia extends Controller
{
    function update(Request $request){
        $media=new Media();
        $placeID=$request->placeID;
        $type=$request->type;
        $bitacora=new Bitacora();
        if($bitacora->isCoolDownOver(5,"update $type",$placeID)){
            $bitacora->setEvent("update $type",$placeID);
            return $media->saveMedia($placeID,$type);
        }
          return [
                "response"=>false,
                "Error"=>"is not ready"
            ];
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
    function saveImpreso(Request $request){
        $media=new Media();
        return [$media->addImpresos($request->toArray())];
    }
    function impresos(Request $request){
        $data=$request->toArray();
        $media=new Media();
        return $media->getImpresos($request->toArray());
    }
    function deleteImpresos(Request $request){
        $media=new Media();
        $media->deleteImpresos($request->path);
        return [is_dir($request->path) || is_file($request->path)];
    }
   
}
