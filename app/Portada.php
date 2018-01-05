<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Portada extends Model
{
    protected $table="Portada";
    function add($id,$placeID){
        $tools=new Tools();
        return $tools->saveByModel($this,["postID"=>$id,"placeID"=>$placeID]);
    }
    function getPosts($placeID=0){
        $filterQuery="(
                SELECT id, portId
                FROM Hidden
                WHERE placeID ='$placeID'
            ) as filter on Portada.id=filter.portId";
            
            
        $sql="SELECT posts.id as portID,Portada.orden,posts.*
        ,Portada.placeID as place, filter.id as filtro FROM `Portada`
            left join posts on posts.id=Portada.postID
            left join $filterQuery 
            where placeID='0' 
            or placeID='$placeID' having filtro is null order by orden asc";
                
        return \DB::select($sql);
        
    }
    function getUncensoredPost($placeId=0){
        $filterQuery="(
                SELECT id, portId
                FROM Hidden
                WHERE placeID ='$placeId'
            ) as filter on Portada.id=filter.portId";
        $sql="SELECT posts.id as portID,Portada.orden,posts.*
        ,Portada.placeID as place, filter.id as filtro,Portada.id as portada FROM `Portada`
            left join posts on posts.id=Portada.postID
            left join $filterQuery 
            where placeID='0' 
            or placeID='$placeId' order by orden asc";
                
        return \DB::select($sql);
    }
    function remove($id){
        return \DB::select("Delete from Portada where postID='$id'");
    }
    function changeOrder($id,$orden){
        $tools=new Tools();
        return $tools->saveByModel($this,["orden"=>$orden],null,"postID",$id);
    }
}
