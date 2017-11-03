<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Tools;

class Bitacora extends Model
{
    protected $table="bitacora";
    function getLastPostUpdate($placeID){
        return $this->where([
                ['event','=','update Posts'],
                ['placeID','=',$placeID]
            ])->orderBy('id','desc')->limit(0,1)->get();        
    }
    function setEvent($event,$placeID,$type="system",$id=0){
        date_default_timezone_set("America/Mexico_City");
        $tools=new Tools();
        return $tools->saveByModel($this,[
            "evento"=>$event,
            "placeID"=>$placeID,
            "type"=>$type,
            "keyID"=>$id
            ]);
    }
    function isCoolDownOver($coolDown,$event,$placeID){
        $data=\DB::select("select * from bitacora
        where TIMESTAMPDIFF(MINUTE,created_at,now())<$coolDown and
        evento='$event' and placeID='$placeID'");
        return (count($data)<=0);
    }
}
