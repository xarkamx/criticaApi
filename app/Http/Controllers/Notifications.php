<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Notification;

use App\Post;

use App\Helpers\Tools;

class Notifications extends Controller
{
    /**
        *@api {get} api/notifications/push custom Push Notification --Deprecated
        * @apiName send Push Notifications 
        * @apiGroup Notifications
        * @apiParam {String} topic (optional) target of multipleClients
        * @apiParam {String} title (optional) title of push Notifications
        * @apiParam {String} body (optional) body of push Notifications
        * @apiParam {String} icon (optional) icon img of push Notifications
        * @apiParam {String} click_action (optional) event on click (url)
        * @apiParam {String} to (optional) singular target of push (gets override by topics)
        * @apiVersion 0.1.0
        *  @apiSuccessExample Success-Response:
        *     HTTP/1.1 200 OK
                {
                message_id: {number}
                }
        *
*/
    public function sendNotification(Request $request){
        $noti=new Notification();
        $tools=new Tools();
        $data=$request->toArray();
        return $noti->easyNotification($data); 
    }
    
    /**
        *@api {get} api/notifications/push/:postID Push Notification by PostID
        * @apiName Send Push notifications defined by the postID
        * @apiGroup Notifications
        * @apiParam {Integer} postID 
        * @apiVersion 0.1.0
        *  @apiSuccessExample Success-Response:
        *     HTTP/1.1 200 OK
                {
                message_id: {number}
                }
        *
    */
    public function pushByID($placeID,$postID,$topic){
        $post=new Post();
        $noti=new Notification();
        $post=$post->getPost($placeID,$postID);
        $data=[];
        $data['topic']=$topic;
        $data['title']=$post[0]['title'];
        $data['body']=$post[0]['excerpt'];
        $data['icon']=$post[0]['thumb'];
        
        return $noti->easyNotification($data);
    }
}
