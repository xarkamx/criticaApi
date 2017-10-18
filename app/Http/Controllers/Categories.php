<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use App\Place;

use App\Bitacora;


class Categories extends Controller
{
    
    
    /**
    *@api {get} /categories/{placeID}/wp get categories from source 
    * @apiName get Categories From Source
    * @apiGroup Categories
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *     [
            {
            id: 22,
            count: 79,
            description: "71",
            link: "http://www.criticajalisco.com/categoria/ciencia/",
            name: "Ciencia",
            slug: "ciencia",
            taxonomy: "category",
            parent: 0,
            meta: [ ],
            _links: {
                self: [
                {
                    href: "http://www.criticajalisco.com/wp-json/wp/v2/categories/22"
                }
                ],
                collection: [
                    {
                        href: "http://www.criticajalisco.com/wp-json/wp/v2/categories"
                    }
                ],
                about: [
                {
                    href: "http://www.criticajalisco.com/wp-json/wp/v2/taxonomies/category"
                }
                ],
                wp:post_type: [
                    {
                        href: "http://www.criticajalisco.com/wp-json/wp/v2/posts?categories=22"
                    }
                ],
                curies: [
                    {
                        name: "wp",
                        href: "https://api.w.org/{rel}",
                        templated: true
                    }
                    ]
                }
            },
        ]
    *
    */
    public function getWpCategories($placeID){
        $category=new Category();
        $place=new Place();
        if(!isset($placeID)){
            abort(404);
        }
        $places=$place->getPlaceById($placeID);
        return $category->getWpCategories($places[0]->url);
    }
    /**
    *@api {get} /categories/{placeID}/wp/update save categories from source in db 
    * @apiName save categories from source in db
    * @apiGroup Categories
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *
    */
    public function updateWpCategories($placeID){
        $category=new Category();
        $data=$this->getWpCategories($placeID);
        $bitacora=new Bitacora();
        if($bitacora->isCoolDownOver(5,'update Categories',$placeID)){
            $bitacora->setEvent("update Categories",$placeID);
            return $category->addCategories($data,$placeID);
        }
        return [
                "response"=>false,
                "Error"=>"is not ready"
            ];
    }
    /**
    *@api {get} /categories/{placeID}/ get categories  
    * @apiName get Categories 
    * @apiGroup Categories
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *
    */
    public function getCategories($placeID=null){
        $category=new Category();
        $data=$category->getCategories($placeID);
        return (count($data)>0)?$data:$this->updateWpCategories($placeID);
    }
     /**
    *@api {get} /categories/{placeID}/top get top categories  
    * @apiName get top Categories 
    * @apiGroup Categories
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *
    */
    public function getTopCategories($placeID){
        $category=new Category();
        return $category->getTopCategories($placeID);
    }
    public function saveBackground(Request $request){
        $category=new Category();
        return $category->setBackground($request->name,$request->file);
    }
}
