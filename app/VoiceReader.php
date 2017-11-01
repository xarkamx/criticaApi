<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class VoiceReader extends Model
{
    public function loadText($filename,$text){
        if($filename==null || $text==null){
            return [false];
        }
        $tools=new Tools();
        $args=array(
            "key"=>"66b52ecdb1aa4a0c8e14f7327db38b74",
            "hl"=>"es-mx",
            "src"=>$text,
            "f"=>"44khz_16bit_mono"
            );
        $path=dirname(__DIR__)."/public/uploads/archivos/$filename.mp3";
        if(file_exists($path)){
            return file_get_contents($path);
        }
        $result=$tools->easyCurl("http://api.voicerss.org",null,$args);
        $file=fopen($path,"w");
        fwrite($file,$result);
        fclose($file);
        return $result;
    }
}
