<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;
class Widget extends Model
{
    function getGasolinerasFromSource(){
        $tools=new Tools();
        $configData=$tools->XMLFileToAssocArray("https://publicacionexterna.azurewebsites.net/publicaciones/places");
        $priceData=$tools->XMLFileToAssocArray("https://publicacionexterna.azurewebsites.net/publicaciones/prices");
        return $this->usefullDataOfGasolineras($configData['place'],$priceData['place']);
    }
    private function usefullDataOfGasolineras($placeData,$priceData){
        $result=[];
        $prices=$this->formatPriceOfGasolinera($priceData);
        $tools=new Tools();
        foreach ($placeData as $item) {
            $key=$item['@attributes']['place_id'];
            $result[$key]['gasID']=$key;
            $result[$key]['nombre']=$tools->replaceSimpleQuote($item['name']);
            $result[$key]['domicilio']=$tools->replaceSimpleQuote($item['location']['address_street']);
            $result[$key]['longitud']=$item['location']['x'];
            $result[$key]['latitud']=$item['location']['y'];
            $result[$key]['regular']=(isset($prices[$key]))?$prices[$key]['regular']:0;
            $result[$key]['premium']=(isset($prices[$key]))?$prices[$key]['premium']:0;
            $result[$key]['diesel']=(isset($prices[$key]))?$prices[$key]['diesel']:0;
        }
        return $result;
    }
    private function formatPriceOfGasolinera($priceData){
        $result=[];
        foreach ($priceData as $item) {
            $key=$item['@attributes']['place_id'];
            if(isset($item['gas_price'])){
                $result[$key]['regular']=$item['gas_price'][0];
                $result[$key]['premium']=isset($item['gas_price'][1])?$item['gas_price'][1]:0;
                $result[$key]['diesel']=isset($item['gas_price'][2])?$item['gas_price'][2]:0;
            }
        }
        
        return $result;
    }
    function saveGasolineras(){
        $tools=new Tools();
        \DB::select("truncate gasolineras");
        $gas=$this->getGasolinerasFromSource();
        return $tools->massiveBulk("gasolineras",$gas);
    }
    function getNearestGasolinera($lat,$lon){
        if($lat=='' || $lon==''){
            return ["Error"=>"undefined coordinates"];
        }
        $hipotenusaQuery="sqrt(pow(latitud-$lat,2)+
        pow(longitud- $lon,2)) as hipotenusa";
        $gasStation=\DB::select("SELECT nombre,
        domicilio,
        regular,
        premium,
        diesel,
        $hipotenusaQuery
        from gasolineras  
        having hipotenusa<0.01
        ORDER BY `hipotenusa` ASC");
        return $gasStation;
    }
    
}
