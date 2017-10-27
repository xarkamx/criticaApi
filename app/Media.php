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
    function getMediaFromWP($url,$date='',$type="video"){
        $tools=new Tools();
        $after=($date=='')?'':"&after=$date";
        $typeQuery=$this->getQueryByType($type);
        $response=$tools->easyCurl($url.$this->wpApi."$typeQuery$after");
        return $response;
    }
    function saveMedia($placeID,$type="video"){
        $tools=new Tools();
        $place = new Place();
        $location=$place->getPlaceByID($placeID);
        date_default_timezone_set("America/Mexico_City");
        $latest=$this->select("created_at")->where("placeID",$placeID)
            ->orderBy("created_at","desc")->get();
        $date=(count($latest)>0)?preg_replace("/ /","T",$latest[0]['date']):
            date("Y-m-d")."T00:00:00";
        $multimedia=$this->getMediaFromWP($location[0]->url,$date,$type);
        $data=[];
        if(gettype($multimedia)=="string"){
            return [false];
        }
        foreach($multimedia as $key=>$media){
            $data[$key]['title']=$media['title']['rendered'];
            $data[$key]['path']=$media['source_url'];
            $data[$key]['wpID']=$media['id'];
            if(isset($media['media_details']['sizes'])&&
            count($media['media_details']['sizes'])>0){
                $data[$key]['thumb']=$media['media_details']['sizes']['full']['source_url'];
            }
            $data[$key]['placeID']=$placeID;
            $data[$key]['postID']=$media['post'];
            $data[$key]['type']=$type;
            $data[$key]['created_at']=date('Y-m-d H:i:s');
            $data[$key]['updated_at']=date('Y-m-d H:i:s');
        }
        
        return $tools->massiveBulk('Media',$data);
    }
    function getVideos($placeID){
        $sql="SELECT Media.path,posts.title,posts.place, posts.full FROM `Media` 
        left join posts on posts.wpId=Media.postID
        where type='video' and posts.id is not null and place='$placeID'";
        return \DB::select($sql);
    }
    function getPDF($placeID){
        $sql="SELECT * FROM `Media` where type='pdf' order by wpID and placeID=$placeID";
        return \DB::select($sql);
    }
    private function getQueryByType($type){
        $response="";
        switch ($type) {
            case 'video':
                $response="?media_type=video";
                break;
            case 'pdf':
                $response="?mime_type=application/pdf";
                break;
        }
        return $response;
    }
}
