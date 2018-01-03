<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', "Welcome@index");
Route::post('/login', "Users@login");
Route::get('/logout', "Users@logout");
Route::group(['prefix'=>'home',"middleware"=>'admin'],function(){
    Route::get('/',function (){
        return view('home.freehome');
    });
});
Route::group(['prefix'=>'categorias',"middleware"=>'admin'],function(){
    Route::get('/background',function (){
        return view('Categories.background');
    });
});
Route::group(['prefix'=>'usuarios',"middleware"=>'admin'],function(){
    Route::get('vista',function (){
        return view('usuarios.vista');
    });
    Route::get('add',function (){
        return view('usuarios.add')->with(["id"=>""]);
    });
    
    Route::get('add/{id}',function ($id){
        return view('usuarios.add')->with(["id"=>"$id"]);
    });
});
Route::group(['prefix'=>'places',"middleware"=>'admin'],function(){
    Route::get('vista',function (){
        return view('lugares.vista');
    });
    Route::get('add',function (){
        return view('lugares.add')->with(["id"=>""]);
    });
    
    Route::get('add/{id}',function ($id){
        return view('usuarios.add')->with(["id"=>"$id"]);
    });
});
Route::group(['prefix'=>'api'],function(){
    Route::get("/",function(){
        return Redirect::to('/apidoc');
    });
    
    
    Route::get("/users/all/{id?}","Users@index");
    Route::get("/users/current","Users@currentUser");
    Route::post("/users/all/{id?}","Users@set");
    Route::delete("/users/{id?}","Users@delete");

    Route::get("/places/","Places@getPlaces");
    Route::get("/places/country/{country?}","Places@codes");
    Route::get("/places/loc","Places@location");
    Route::post("/places/","Places@savePlaces");
    Route::put("/places/","Places@updatePlaces");
    Route::post("/places/bulk","Places@setPlaces");
    
    Route::get("/posts/{postID?}","Posts@index");
    Route::get("/posts/{placeID}/category/id/{categoryID}","Posts@postByCategoryId");
    Route::get("/posts/{placeID}/category/name/","Posts@postByCategoryName");
    Route::get("/wposts/","Posts@getWPost");
    Route::get("/places/{placeID}/wposts/update","Posts@updatePosts");
    Route::get("/places/{placeID}/wposts/update/all","Posts@updateAllPosts");
    Route::get("/places/{placeID}/wposts","Posts@getWPost");
    Route::get("/places/{placeID}/posts/{postID?}","Posts@index");
    
    Route::get("/home","Posts@getHomePosts");
    Route::post("/home","Posts@addPostToHomeScreen");
    Route::delete("/home","Posts@removePostToHomeScreen");
    Route::put("/home/order","Posts@orderPostsInHome");
    
    Route::get("/notifications/push","Notifications@sendNotification");
    Route::get("/notifications/push/{postID}/{placeID}/{topic}","Notifications@pushById");
    
    Route::get("/categories/{placeID}/wp","Categories@getWpCategories");
    Route::get("/categories/{placeID}/wp/update","Categories@updateWpCategories");
    Route::get("/categories/{placeID?}","Categories@getCategories");
    Route::get("/categories/{placeID}/top","Categories@getTopCategories");
    Route::post("/categories/background","Categories@saveBackground");
    
    Route::get("/widgets/gasolineras/","Widgets@getGasolinerasFromSource");
    Route::get("/widgets/gasolineras/update","Widgets@saveGasolinerasFromSource");
    Route::get("/widgets/gasolineras/nearest","Widgets@getNearestGasolinera");
    
    Route::post('/voiceReader',"VoiceReaders@read");
    Route::get('/voiceReader',"VoiceReaders@read");
    
    Route::get('/media/wp/{placeID}',"Multimedia@update");
    Route::get('/media/videos/{placeID}',"Multimedia@videos");
    Route::get('/media/pdf/{placeID}',"Multimedia@pdf");
    Route::get('/media/impresos','Multimedia@impresos');
    Route::post('/media/impresos','Multimedia@saveImpreso');
    Route::post('/media/impresos/posts','Pliegos@setPostToImpreso');
    Route::get('/media/impresos/posts','Pliegos@getPostsByPliego');
    Route::delete('/media/impresos/posts','Pliegos@deletePostFromPliego');
    Route::delete('/media/impresos','Multimedia@deleteImpresos');
    
    Route::post('reporte',"reporteCiudadano@upload");
    Route::get('/bitacora',"Bitacoras@index");
    
});
Route::group(["prefix"=>"test","middleware"=>'admin'],function(){
    Route::get('/urls',function (){
        return view('getURL');
    });
    Route::get('/notifications',function (){
        return view('test.notifications');
    });
    
});
Route::group(["prefix"=>"posts","middleware"=>'admin'],function(){
    Route::get('/sorter',function (){
        return view('Posts.portadaSetter');
    });
    Route::get('/notifications',function (){
        return view('test.notifications');
    });
    Route::get('/impresos',function (){
        return view('impresos.add');
    });
});