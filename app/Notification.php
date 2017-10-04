<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Notification extends Model
{
    function addClientToTopic(){}
    function saveClient(){}
    function sendPushNotification($data){
        $tools=new Tools();
        if(!isset($data)){
            return ["Error"=>"Undefined data"];
        }
        $headers=array(
                "Content-Type: application/json",
                "Authorization:key=AAAAg-QTm0k:APA91bHluACUeWZkitqOmUOun6EBEenWJOGsPoVpJWykYdhDd92plDjKhtOti7hIc8U2Runpf3Jm_2rRz3ikrE6a9fI4mAigMkwsLpG-YGReS6pPL1kpOnezrVjYmjFnP8yzE9bwMAOU "
            );
        $path="https://fcm.googleapis.com/fcm/send";
        return $tools->easyCurl($path,$headers,$data);
    }
    function easyNotification(Array $data){
        $send=[];
        if(isset($data['topic'])){
            $send['to']="/topics/".$data['topic'];
            $data['to']="";
            unset($data['topic'],$data['to']);
        }elseif(isset($data['to'])){
            $send['to']=$data['to'];
            $data['topic']="";
            unset($data['topic'],$data['to']);
        }
        foreach($data as $key=>$item){
            $send['notification'][$key]=$item;
        }
        
        return $this->sendPushNotification(json_encode($send));
    }
    function notificateNewCategoryPost($posts){
        $data=[];
        foreach ($posts as $post) {
            $post=(array)$post;
            $categories=json_decode($post['categories']);
            foreach ($categories as $category) {
                $data['topic']=$post['place']."_".$category;
                $data['title']=$post['title'];
                $data['body']=$post['excerpt'];
                $data['icon']=$post['full'];
                $this->easyNotification($data);
            }
        }
    }
}
