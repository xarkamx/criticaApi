<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Tools;

use App\Place;

class Media extends Model
{
    protected $table="Media";
    function __construct(){
        $this->wpApi="/wp-json/wp/v2/media";
    }
    function getVideosFromWP($url,$date=''){
        $tools=new Tools();
        $after=($date=='')?'':"&after=$date";
        $response=$tools->easyCurl($url.$this->wpApi."?media_type=video$after");
        return json_decode($response);
    }
    function saveVideos($placeID){
        $tools=new Tools();
        $place = new Place();
        $location=$place->getPlaceByID($placeID);
        $date=date("Y-m-d")."T00:00:00";
        $videos=$this->getVideosFromWP($location[0]->url,$date);
        $data=[];
        if(count($videos)<=0){
            return [false];
        }
        
        foreach($videos as $key=>$video){
            $data[$key]['title']=$video['title']['rendered'];
            $data[$key]['path']=$video['source_url'];
            $data[$key]['wpID']=$video['id'];
            $data[$key]['placeID']=$placeID;
            $data[$key]['postID']=$video['post'];
            $data[$key]['type']='video';
            $data[$key]['created_at']=date('Y-m-d H:i:s');
            $data[$key]['updated_at']=date('Y-m-d H:i:s');
        }
        return $tools->massiveBulk('Media',$data);
    }
    function getVideos($placeID){
        $sql="SELECT Media.path,posts.title,posts.place, posts.full FROM `Media` 
        left join posts on posts.wpId=Media.postID
        where posts.id is not null and place='$placeID'";
        return \DB::select($sql);
    }
}
