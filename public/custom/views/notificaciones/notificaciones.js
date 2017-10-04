class CloudMessaging{
    constructor(){
        var config = {
        apiKey: "AIzaSyBUU5y73rsXXY1JEVjNmXo-PBXK2k9OcpU",
        authDomain: "pushcritica.firebaseapp.com",
        databaseURL: "https://pushcritica.firebaseio.com",
        projectId: "pushcritica",
        storageBucket: "pushcritica.appspot.com",
        messagingSenderId: "566467205961"
        
    };
    this.tools=new Tools();
    this.fb=firebase.initializeApp(config);
    }
    requestPermission(){
        let msn=this.fb.messaging();
        msn.requestPermission().then((ev)=>{
           console.log("Tiempo de Spaaaaaaaam");
           this.checkToken(msn);
        }).catch((ev)=>{
            console.log(ev);
            
        });
    }
    checkToken(messaging){
         messaging.getToken()
          .then((currentToken)=>{
              
            this.register(currentToken,"important");
          })
          .catch(function(err) {
            console.log('An error occurred while retrieving token. ', err);
            showToken('Error retrieving Instance ID token. ', err);
            setTokenSentToServer(false);
          });
    }
    sendNotification(title='hola',body='mundo'){
        let tools=new Tools();
        let headers={
            "Content-Type": "application/json",
            Authorization:"key=AAAAg-QTm0k:APA91bHluACUeWZkitqOmUOun6EBEenWJOGsPoVpJWykYdhDd92plDjKhtOti7hIc8U2Runpf3Jm_2rRz3ikrE6a9fI4mAigMkwsLpG-YGReS6pPL1kpOnezrVjYmjFnP8yzE9bwMAOU "
        }
        let data={
            "to": "/topics/important",
            "notification": {
                title,
                body,
                icon:"https://critica-xarkamx.c9users.io/uploads/logos/web-gdl.jpg",
                "click_action" : "https://critica-xarkamx.c9users.io"
             },
            "data": {
                "message": "This is a GCM Topic Message!"
                }
            };
        tools.ajax.postData("https://fcm.googleapis.com/fcm/send",data,(ev)=>{
            console.log(ev);    
        },'post',true,headers);
    }
    register(id,category){
        let path="https://iid.googleapis.com/iid/v1/"+id+"/rel/topics/"+category;
        let headers={
            "Content-Type": "application/json",
            Authorization:"key=AAAAg-QTm0k:APA91bHluACUeWZkitqOmUOun6EBEenWJOGsPoVpJWykYdhDd92plDjKhtOti7hIc8U2Runpf3Jm_2rRz3ikrE6a9fI4mAigMkwsLpG-YGReS6pPL1kpOnezrVjYmjFnP8yzE9bwMAOU "
        }
        console.log(path);
        this.tools.ajax.postData(path,{},(ev)=>{
            console.log("demo");
            console.log(ev);
            this.getTopics(id);
        },'post',true,headers);
    }
    getTopics(id){
        let path="https://iid.googleapis.com/iid/info/"+id;
        let headers={
            
            Authorization:"key=AAAAg-QTm0k:APA91bHluACUeWZkitqOmUOun6EBEenWJOGsPoVpJWykYdhDd92plDjKhtOti7hIc8U2Runpf3Jm_2rRz3ikrE6a9fI4mAigMkwsLpG-YGReS6pPL1kpOnezrVjYmjFnP8yzE9bwMAOU "
        }
        console.log(path);
        this.tools.ajax.postData(path,{},(ev)=>{
            console.log(ev);
        },'post',true,headers);
    }
}
