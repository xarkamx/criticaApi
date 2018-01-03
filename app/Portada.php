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
        $sql="SELECT posts.id as portID,Portada.orden,posts.*,Portada.placeID as place FROM `Portada`
            left join posts on posts.id=Portada.postID where placeID='0' 
            or placeID='$placeID' order by orden asc";
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
