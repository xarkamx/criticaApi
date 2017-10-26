<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Reportes extends Model
{
    protected $table='reporteCiudadano';
    public function uploadData(Array $data){
        $tools=new Tools();
        $data['imagen']=$this->uploadImage($data);
        $this->mail($data);
        return [$tools->saveByModel($this,$data)];
    }
    private function uploadImage($data){
        $correo=$data['correo'];
        $fileName=md5($correo.date('ymdhis'));
        $path=dirname(__DIR__)."/public/uploads/archivos/";
        if (!file_exists($path.$correo)) {
            mkdir($path.$correo, 0775, true);
        }
        $path.="$correo/$fileName.jpg";
        $file=fopen($path,"w");
        fwrite($file,base64_decode($data['imagen']));
        fclose($file);
        return "/uploads/archivos/$correo/".$fileName;
    }
    function mail($data){
        $para      = 'contacto@grupomexicopublica.com.mx';
        $titulo    = 'Reporte ciudadano';
        $mensaje   = $data['descripcion']."\n".$data['imagen'];
        $cabeceras = 'From: '.$data['correo']. "\r\n" .
            'Reply-To:'.$data['correo']. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        mail($para, $titulo, $mensaje, $cabeceras);
    }
}
