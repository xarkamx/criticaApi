<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Portada extends Model
{
    protected $table="Portada";
    function add($id){
        $tools=new Tools();
        return $tools->saveByModel($this,["postID"=>$id]);
    }
    function getPosts(){
        $sql="SELECT posts.id as portID,Portada.orden,posts.* FROM `Portada`
            left join posts on posts.id=Portada.postID order by orden asc";
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
