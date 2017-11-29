<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Place extends Model
{
    protected $table="places";
    public function saveModel(Array $data){
        $tools=new Tools();
        return [$tools->saveByModel($this,$data,null,"url",$data['url'])];
    }
    public function getPlaces($country=''){
        if($country==''){
            $values=$this->orderbyRaw("country,place ASC")->get();
        }else{
            $values=$this->where('country',$country)->get();
        }
        return (count($values)>0)?$values:abort(404);
    }
    public function getPlaceIdByName($place){
        $place=$this->where("place",$place)->get();
        if(count($place)==0){
            $place=$this->where("place","mexico")->get();
        }
        return $place;
    }
    public function getPlaceNameByCoordinates($lat,$long){
        if(!isset($lat)){
            abort(404);
        }
        $tools=new Tools();
        $googleMap='https://maps.googleapis.com/maps/api/geocode/json';
        if($lat=="undefined"){
            return  false;    
        }
        $params="?latlng=$lat,$long&key=AIzaSyCm_nTL5Ndyz-zR5u7LZNhtK0_ex1Auh_Q";
       
        $curl = curl_init($googleMap.$params);
        curl_setopt ($curl ,CURLOPT_RETURNTRANSFER,1);
        $response=json_decode(curl_exec($curl));
        curl_close($curl);
        if(!isset($response->results)){
            return [false];
        }
        
        $placeData=$tools->searchInAssocArray($response->results[0]->address_components,
        "types",
        "administrative_area_level_1");
        
        return $placeData->long_name;
    }
    public function getPlaceById($id){
        return $this->where('id',$id)->get();
    }
    public function getPlaceByCoordinates($args){
        $place=$this;
        if(isset($args['lat'])&&isset($args['lon'])){
           $lat=$args['lat'];
           $lon=$args['lon'];
           $placeName=$place->getPlaceNameByCoordinates($lat,$lon);
           $id=$place->getPlaceIdByName($placeName);
           return (count($id)>0)?$id[0]:false;
        }
        return false;
    }
    public function updatePlace(Array $data){
        $tools=new Tools();
        $column=$data["column"];
        $value=$data["value"];
        $id=$data["id"];
        return \DB::select("update places set $column='$value' where id='$id'");
    }
}
