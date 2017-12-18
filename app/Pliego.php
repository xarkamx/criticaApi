<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;
class Pliego extends Model
{
    protected $table="pliegos";
    function add($data){
        $tools=new Tools();
        if(!$this->isLinked($data['pliego'],$data['postID'])){
            return $tools->saveByModel($this,$data);   
        }else{
            return false;
        }
    }
    function getPostsByPliego($path){
        $query="SELECT * FROM `pliegos` 
            left join posts on pliegos.postID=posts.id 
            where pliego='$path'";
        return \DB::select($query);
    }
    function deletePostFromPliego($args){
        return $this->where([
            [
                'pliego',"=",$args['pliego']
            ],
            [
                'postID',"=",$args['postID']
            ]]
            )->delete();
    }
    function isLinked($pliego,$id){
        $query="select pliego,postID from pliegos
            where pliego='$pliego' and postID='$id'";
        return count(\DB::select($query))>0;
    }
}
