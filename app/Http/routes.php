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
Route::group(['prefix'=>'home',"middleware"=>'admin'],function(){
    Route::get('/',function (){
        return view('home.home');
    });
});
Route::group(['prefix'=>'clientes',"middleware"=>'admin'],function(){
    Route::get('/vista',function (){
        return view('clientes.vista');
    });
    Route::get('add/',function(){
          return View::make('clientes.add')->with(["id"=>""]); 
    });
    Route::get('add/{id}',function($id){
          return View::make('clientes.add')->with(["id"=>"$id"]); 
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
Route::group(['prefix'=>'api'],function(){
    Route::get("/",function(){
        return Redirect::to('/apidoc');
    });
    Route::get("/clients","Clients@index");
    Route::post('users',"Users@set");
    Route::get("/clients/all/{value?}","Clients@index");
    Route::post("/clients","Clients@save");
    Route::delete("/clients/{id}","Clients@delete");
    
    Route::get("/users/all/{id?}","Users@index");
    Route::get("/users/current","Users@currentUser");
    Route::post("/users/all/{id?}","Users@set");
    Route::delete("/users/{id?}","Users@delete");
    
    Route::get("/empresas/all/{id?}","Empresas@index");
    Route::post("/empresas/all/{id?}","Empresas@set");
    Route::delete("/empresas","Empresas@delete");

    Route::get("/places/","Places@getPlaces");
    Route::get("/places/country/{country?}","Places@codes");
    Route::get("/places/loc","Places@location");
    Route::post("/places/bulk","Places@setPlaces");
    
    Route::get("/posts/{postID?}","Posts@index");
    Route::get("/posts/{placeID}/category/id/{categoryID}","Posts@postByCategoryId");
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
    
    Route::get("/widgets/gasolineras/","Widgets@getGasolinerasFromSource");
    Route::get("/widgets/gasolineras/update","Widgets@saveGasolinerasFromSource");
    Route::get("/widgets/gasolineras/nearest","Widgets@getNearestGasolinera");
    
    Route::post('/voiceReader',"VoiceReaders@read");
    Route::get('/voiceReader',"VoiceReaders@read");
    
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
});