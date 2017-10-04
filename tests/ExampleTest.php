<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Notification;
use App\Bitacora;


class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPushNotification(){
        $noti=new Notification();
        $data=' {
	    "to": "/topics/important",
	    "notification": {
	    	"title": "Hola Mundo",
		    "body": "Mensaje de prueba",
		    "icon":"http://www.alabamapublica.com/wp-content/uploads/sites/43/2017/06/cntx170619019-150x150.jpg"
		    "click_action": "https://critica-xarkamx.c9users.io"
	        }
        }';
        $this->assertArrayHasKey("message_id",$noti->sendPushNotification($data));
    }
   /* public function testPushMultipleNotification(){
        $noti=new Notification();
        $data=\DB::select("SELECT * FROM `posts` limit 0,2");
        $noti->notificateNewCategoryPost((array) $data);
    }*/
    public function testBitacoraSetEvent(){
        $bitacora=new Bitacora();
        $bitacora->setEvent('test',65);
    }
}
