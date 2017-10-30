<?php

namespace App\Helpers;

class Tools 
{
    public function tokenizer($credentials){
        $user=$credentials['username'];
        $password=$credentials['password'];
        $date=date("Y-m-d H:i:s");
        $rand=uniqid();
        return md5("$user:$password:$date:$rand");
    }
    public function validInput($inputJson,$value){
        if(property_exists($inputJson,'required')){
            $value=($inputJson.required==false&&$value==null)?'':$value;
        }else{
            $value=($value==null)?'':$value;
        }
        return $value;
    }
    public function splitAtUpperCase($s) {
        $split=preg_split('/(?=[A-Z])/', $s, -1, PREG_SPLIT_NO_EMPTY);
        return implode(' ',$split);
    }
    public function saveByModel($modal,$args,$jsonRef=null,$column='id',$id=null){
        
            $table=$modal->getTable();
            $data=new \stdClass();
            $updateArgs=[];
            $mod=$this->exist_in_modal($modal,$column,$id);
            if($id==null||$mod==false){
                $data=new $modal();
            }
            if($jsonRef==null){
                $columns = \Schema::getColumnListing($table);
                $walker=$columns;
            }else{
                $walker=array_keys(json_decode($jsonRef));
            }
            foreach($walker as $key){
                $value='';
                if($key=='id' && !isset($args[$key])){
                    continue;
                }
                if(isset($args[$key])){
                    $value=$args[$key];
                }
                $data->$key=$value;
                if($value!=''){
                    $updateArgs[$key]=$value;   
                }
            }
            if($id==null||$mod==false){
                unset($data->created_at);
                unset($data->updated_at);
                 
                return $data->save();
            }
            unset($updateArgs['created_at']);
            unset($updateArgs['updated_at']);
            return $mod->update((array)$updateArgs);
        
    }
    public function exist_in_modal($modal,$column,$value){
        if($value==null){
            return false;
        }
        $values=$modal->where($column,$value);
        return (count($values->get())>0)?$values:false;
    }
    public function b64toFile($folderName,$b64file,$filename='myfile',$ext=null){
            if (!file_exists($folderName)) {
                mkdir($folderName, 0775, true);
            }
            $b64file=trim($b64file);
            $data=preg_split('/,/',$b64file);
            $type=preg_split('/\//',$data[0]);
            $ext=($ext==null)?preg_replace("/;base64/",'',$type[1]):$ext;
            $file=str_replace(' ','+',$data[1]);
            $file=base64_decode($file);
            file_put_contents("$folderName/$filename.$ext",$file);
            return "/$folderName/$filename.$ext";
        }
    public function systemPathToUrl($path){
        return "http://".str_replace($_SERVER['DOCUMENT_ROOT'],$_SERVER['HTTP_HOST'],$path);
    }
    public function replaceWeirdChar($r){
    $r=preg_replace("/ /","_",$r);
    $r=preg_replace("/\+/","plus",$r);
    $r=preg_replace("/\:/","",$r);
    $r=preg_replace("/-/","_",$r);
    $r=strtolower($r);
    $r = iconv('ISO-8859-1','ASCII//TRANSLIT//IGNORE',$r);
    $r=preg_replace("/ú/i","u",$r);
    $r=preg_replace("/[\.\?\¿\(\)]/","",$r);
    return $r;
}//elimina todos los caracteres que podrian dar problemas en una db
    public function replaceHtmlchar($string){

        $avoid=preg_replace("/</","&lt;",$string);

        $avoid=preg_replace("/>/","&gt;",$avoid);

        return $avoid;

}//elimina corchetes angulares.
    public function replaceSimpleQuote($string){
        return preg_replace("/'/",'',$string);
    }
    public function downfile($archivo){

        if (file_exists($archivo)) {



            header("Content-Length: " . filesize ( $archivo ) );

                header("Content-type: application/octet-stream");

                header("Content-disposition: attachment; filename=".basename($archivo));

                header('Expires: 0');

                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

                ob_clean();

                flush();

                readfile($archivo);

        }else{

            echo $filename[0];

        }

}//descarga archivos
    public function crearCarpeta($direccion){

        if(!file_exists($direccion)){

            mkdir($direccion,0777);

        }

}
    public function sendMailbyPost($post,$sendTo=null,$title=null){
        add_post_to_db($post,$title);
        $mail=$post['mail'];
        unset($post['mail']);
        $mensaje="Haz recibido una cotizacion de $mail \r\n";
        $keys=array_keys($post);
        $price=0;
        foreach($keys as $key){
            $quiz_val=preg_split("/-/",$post[$key]);
            $deformatKey=str_replace("_"," ",$key);
            $mensaje.="¿$deformatKey? $quiz_val[1]\r\n";
            $price+=$quiz_val[0];
        }
        $price=number_format ( $price ,2);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <$mail>" . "\r\n";
        //echo $mensaje.'Con un precio total de $'.$price;
        //($sendTo!=null)?mail($sendTo,'Cotización',$mensaje.'Con un precio total de $'.$price):'';
        header('Location: ' . $_SERVER['HTTP_REFERER']."?alert=1");
}//manda directamente tu post a un correo. //requiere personalizacion.
    public function exist_on_array($array,$element){

        for ($x=0;$x<count($array);$x++){

            if($array[$x]==$element){

                return true;

            }

        }

        return false;

}//busca un elemento en el array, y regresa true de existir y false de no hacerlo
    public function listDirectory($dir){

    $result = array();

    $root = scandir($dir);

    foreach($root as $value) {

      if($value === '.' || $value === '..') {

        continue;

      }

      if(is_file("$dir$value")) {

        $result[] = "$dir$value";

        continue;

      }

      if(is_dir("$dir$value")) {

        $result[] = "$dir$value/";

      }

      foreach(self::listDirectory("$dir$value/") as $value)

      {

        $result[] = $value;

      }

    }

    return $result;

  }//enlista todos los directorios del camino asignado
    public function arr_to_form($args){
        if($args==null){
            return 0;
        }

        $title='';
        if($args['titulo']){
            $title=$args['titulo'];
            unset($args['titulo']);
        }
        $html="<div class='g_form'>
        <h3>$title</h3>
        ";


        foreach($args as $element){
            $id=$element['id'];
            unset($element['id']);
            $keys=array_keys($element);
             $html.="<div class='g_input' id='li-$id-$title'>
                   ";
            foreach($keys as $key){
                $html.=" <div class='gr_input'>
                    <label>$key</label>
                    <input id='$id-$key-$title' class='gen_input' name='$id-$key-$title' value='$element[$key]'></div>";
            }
            $html.="
                    <div class='gr_input'>
                        <div class='deleteButton' id='d-$id-$title' onclick='killElement(this.id)'>X</div>
                    </div>
                </div>";
        }
        $html.='</from></div>';
        return $html;
    }//convierte un arreglo en formulario
    public function fileToPath($path,$files,$name=''){
        $plugin_path=dirname(__DIR__);
        if(!is_dir($path)){
            mkdir($path);
        }
        $result=[];
        foreach ( $files['name'] as $key=>$file) {
        if ($files["error"][$key] == UPLOAD_ERR_OK) {
            $tmp_name = $files["tmp_name"][$key];
            pathinfo($files["name"][$key], PATHINFO_EXTENSION);
            $name = $files["name"][$key];
            $result[]= (move_uploaded_file($tmp_name, "$path/$name"))?"$name":'El archivo no se copio correctamente.';
        }
           
    }
     return $result;
    }
    public function find_repeat_on_matrix($args,$colum){
        $repeat=array();
        foreach($args as $row){
            $repeat[$row[$colum]]=($repeat[$row[$colum]]=='')?1:1+$repeat[$row[$colum]];
        }
        return $repeat;
    }
    public function array_unshift_assoc($arr, $key, $val, $species='',$type=''){ 
        $arr = array_reverse($arr, true);
        if($arr[$key]!=''){
            unset($arr[$key]);
        }
        $arr[$key] =(is_array($val))? $val:array($val);
        if($type=='vendor'){
            $arr[$key]['class']=$species;
        }
        return  array_reverse($arr, true); 
    } //esta no me acuerdo que hace XD creo que agrega un item al principio del array
    public function console( $data) {
	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
	
	    echo $output;
	}//imprime en consola de js 
	public function camelCase($str, $separator = ' '){
         $words = explode($separator, strtolower($str));
		 $return = '';
		 foreach ($words as $word) {
		 if ($words[0]==$word) {  $return .= trim($word); continue;}
		  $return .= ucfirst(trim($word));
		  }
		  return $return;
}//cameliza un STR
	public function date_us_to_iso($str){
            $str = new \DateTime($str);
            $str = $str->format('Y-m-d');
            return $str;
    }// Fecha US 12/31/2016 a 2016-12-31
    public function array_date_us_to_iso($arr){
        foreach($arr as $k => $v){
            if (!is_array($v)){
                if (\DateTime::createFromFormat('m/d/Y', $v) !== FALSE) {
                    $arr[$k] = date("Y-m-d", strtotime($v));
                }
            }
        }
            return $arr;
    }// Fecha US 12/31/2016 a 2016-12-31
    public function array_date_iso_to_us($arr){
        foreach($arr as $k => $v){
            if (!is_array($v)){
                if (DateTime::createFromFormat('Y-m-d', $v) !== FALSE) {
                    $arr[$k] = date("m/d/Y", strtotime($v));
                }
            }
            else{
                $arr[$k]=$this->array_date_iso_to_us($v);
            }
        }
            return $arr;
    }// Fecha ISO 2016-12-31 a 12/31/2016
    public function is_json($string) {
        $json=json_decode($string);
        return (is_object($json)||is_array($json));
    }
    public function replace_key_function($array, $key1, $key2){
        $keys = array_keys($array);
        $index = array_search($key1, $keys);
    
        if ($index !== false) {
            $keys[$index] = $key2;
            $array = array_combine($keys, $array);
        }
    
        return $array;
    }
    public function massiveBulk($table,$argumentos){
        $keys=array_keys((array)current($argumentos));
        $keysVal=implode(',',$keys);
        foreach($keys as $key){
            $keyUp[]="$key=values($key)";
        }
        foreach((array)$argumentos as $key=>$item){
            $values[]="'".implode("','",(array)$item)."'";
        }
        $vals=implode('),(',$values);
        $update=implode(',',$keyUp);
        ini_set('memory_limit','900M');
        $insert="INSERT into $table ($keysVal) values ($vals) ON DUPLICATE KEY UPDATE $update";
        \DB::select($insert);
    }
    public function dateDiff($date1,$date2){
        $datetime1 = new \DateTime($date1);
        $datetime2 = new \DateTime($date2);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%R%a')+0;
    }
    public function isCalledByAjax(){
        return $_SERVER['HTTP_ACCEPT']=='*/*';
    }
    public function searchInAssocArray($arr,$key,$keyword){
        
        foreach((array)$arr as $k=>$item){
            $selected=$item->$key;
            if(is_array($selected)){
               
                if(array_search($keyword,$selected)!==false){
                    return $item;
                }
            }else{
                if($selected==$keyword){
                    return $item;
                }
            }
        }
        return false;
    }
    public function easyCurl($url,$headers=null,$data=null){
        $curl = curl_init($url);
        if(isset($headers)){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        if(isset($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        }
        
        curl_setopt ($curl ,CURLOPT_RETURNTRANSFER,1);
        $result=curl_exec($curl);
        $response=json_decode($result,true);
        $response=(count($response)<=0)?$result:$response;
        curl_close($curl);
        return $response;
    }
    public function XMLFileToAssocArray($filePath){
        $file=file_get_contents($filePath);
        $ob= simplexml_load_string($file);
        $json  = json_encode($ob);
        $configData = json_decode($json, true);
        return $configData;
    }
    public function foldersToJson($path){
        $files=scandir($path);
        $data=[];
        foreach($files as $file){
            if(is_dir($path.$file) && ($file!="."&&$file!="..")){
                $data[$file]=$this->foldersToJson($path.$file);
            }
            if(!is_dir($path.$file) && ($file!="."&&$file!="..")){
                $data[]=$file;
            }
        }
        return $data;
    }
}
