<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Empresa extends Model
{
    protected $table='Empresa';
    public function saveModel(Array $data){
        $tools=new Tools();
        return $tools->saveByModel($this,$data,null,"empresa",$data['empresa']);
    }
    public function printModel($id,$value='id'){
        if(isset($id)){
            return $this->where($value,$id)->get();
        }
        return $this->get();
    }
    public function deleteModel(){}
}
