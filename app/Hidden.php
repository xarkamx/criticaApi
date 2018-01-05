<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Hidden extends Model
{
    protected $table="Hidden";
    function toggleStatus($args){
        if($this->isHidden($args)){
            $this->remove($args);
            return 0;
        }
        $this->addFilter($args);
        return 1;
    }
    function addFilter($args){
        $this->missingParameters($args);
        $tools=new Tools();
        return $tools->saveByModel($this,$args);
    }
    private function missingParameters($args){
        if(count($args)==0){
            throw new \Exception("Missing parameters");
        }
    }
    private function isHidden($args){
        $this->missingParameters($args);
        $placeID=$args['placeId'];
        $portID=$args['portId'];
        $sql="select id from Hidden where placeId=$placeID and portId=$portID";
        $result=\DB::select($sql);
        return count($result)>0;
    }
    private function remove($args){
        
        $placeID=$args['placeId'];
        $portID=$args['portId'];
        return $this->
        where([["placeId","=",$placeID],["portId","=",$portID]])->delete();
    }
}
