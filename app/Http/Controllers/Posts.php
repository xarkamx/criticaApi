<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Place;
use App\Post;
use App\Bitacora;
use App\Portada;
use App\Category;
class Posts extends Controller
{
    /**
    *@api {get} api/posts get posts 
    * @apiName get Posts
    * @apiGroup Post
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *     [
            {
                id: 4591,
                date: "2016-07-26 10:26:04",
                place: 65,
                title: "Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong",
                content: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> ",
                excerpt: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> ",
                categories: "[2]",
                full: "http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png",
                thumbnail: "",
                created_at: null,
                updated_at: null
            }
        ]
    *
    */
    /**
    *@api {get} api/places/{placeID}/posts/{postID?} get posts by placeID
    * @apiName Posts by placeID
    * @apiGroup Post
    * 
    * @apiVersion 0.1.0
    * @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
        [
            {
                id: 4591,
                date: "2016-07-26 10:26:04",
                place: 65,
                title: "Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong",
                content: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> ",
                excerpt: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> ",
                categories: "[2]",
                full: "http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png",
                thumbnail: "",
                created_at: null,
                updated_at: null
            }
        ]
    *
    */
    function index(Request $request,$placeID=null,$postID=null){
        $post = new Post();
        $place = new Place();
        $location=$place->getPlaceByCoordinates($request->toArray());
        if($location==false){
            return $post->getPost($placeID,$request->postID,$request->search);
        }
        $posts=$post->getPost($location->id,$request->postID);
        return (count($posts)>0)?$posts:
            $post->savePosts($location->url,$postID,$location->id);
    }
    /**
    *@api {get} api/places/:placeID/wposts get posts by placeID
    * @apiName Posts by placeID
    * @apiGroup Post
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *     {
    *       id: 3698,
            date: "2017-05-28T00:28:55",
            date_gmt: "2017-05-28T03:13:28",
            guid: {
                rendered: "http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/"
            },
            modified: "2017-05-28T00:28:55",
            modified_gmt: "2017-05-28T05:28:55",
            slug: "tras-reunion-g7-concluyen-estrategia-cambio-climatico",
            status: "publish",
            type: "post",
            link: "http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/",
            title: {
                rendered: "Tras reunión G7 no concluyen estrategia para el cambio climático"
            },
            content: {
                rendered: "demo"
                protected: false
                }
    *       }
    *
    */
    function getWPost(Request $request,$placeID="65",$postID=""){
        $post = new Post();
        $place = new Place();
        $location=$place->getPlaceByCoordinates($request->toArray());
        if($location==false){
            $location=$place->getPlaceById($placeID)[0];
        }
        return $post->getPostFromUrl($location->url,$postID."?_embed");
    }
    /**
    *@api {get} api/places/{placeID}/wposts/update update post by place
    * @apiName update Post by placeID
    * @apiGroup Post
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *     {
    *       id: 3698,
            date: "2017-05-28T00:28:55",
            date_gmt: "2017-05-28T03:13:28",
            guid: {
                rendered: "http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/"
            },
            modified: "2017-05-28T00:28:55",
            modified_gmt: "2017-05-28T05:28:55",
            slug: "tras-reunion-g7-concluyen-estrategia-cambio-climatico",
            status: "publish",
            type: "post",
            link: "http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/",
            title: {
                rendered: "Tras reunión G7 no concluyen estrategia para el cambio climático"
            },
            content: {
                rendered: "demo"
                protected: false
                }
    *       }
    *
    */
    function updatePosts($placeID="65",$postID=""){
        $bitacora=new Bitacora();
        $post=new Post();
        $place=new Place();
        $location=$place->getPlaceById($placeID)[0];
        if($bitacora->isCoolDownOver(5,'update Post '.$location->url,$placeID)){
            //$bitacora->setEvent("update Post ".$location->url,$placeID);
            return $post->savePosts($location->url,$postID,$placeID);
        }
        return [
                "response"=>false,
                "Error"=>"is not ready"
            ];
    }
    /**
    *@api {get} api/places/{placeID}/wposts/update/all update all posts by place
    * @apiName update all Posts by placeID
    * @apiGroup Post
    * 
    * @apiVersion 0.1.0
    *  @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
    *     {
    *       id: 3698,
            date: "2017-05-28T00:28:55",
            date_gmt: "2017-05-28T03:13:28",
            guid: {
                rendered: "http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/"
            },
            modified: "2017-05-28T00:28:55",
            modified_gmt: "2017-05-28T05:28:55",
            slug: "tras-reunion-g7-concluyen-estrategia-cambio-climatico",
            status: "publish",
            type: "post",
            link: "http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/",
            title: {
                rendered: "Tras reunión G7 no concluyen estrategia para el cambio climático"
            },
            content: {
                rendered: "demo"
                protected: false
                }
    *       }
    *
    */
    function updateAllPosts($placeID="65",$postID=""){
        $post=new Post();
        $place=new Place();
        $location=$place->getPlaceById($placeID)[0];
        return $post->saveAllPosts($location->url,$postID,$placeID);
    }
    /**
    *@api {get} api/posts/location get Post by cordinates
    * @apiName get Posts by Cordinates
    * @apiGroup Post
    * @apiParam {String} lat latitude coordinates
    * @apiParam {String} lon longitude coordinates
    * @apiVersion 0.1.0
    * @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
        [
            {
                id: 4591,
                date: "2016-07-26 10:26:04",
                place: 65,
                title: "Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong",
                content: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> ",
                excerpt: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> ",
                categories: "[2]",
                full: "http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png",
                thumbnail: "",
                created_at: null,
                updated_at: null
            }
        ]
    *
    *
    */
    function getPostByLocation(Request $request, $postID){
        $post=new Post();
        $place=new Place();
        $location=$place->getPlaceByCoordinates($request->toArray());
        if($location==false){
            return ["Location is required"];
        }
        return $post->getPost($location->id,$postID);
    }
    /**
    *@api {get} api/posts/{placeID}/category/id/{categoryID} get Post by Category ID
    * @apiName get Post by Category ID
    * @apiGroup Post
    * @apiVersion 0.1.0
    * @apiSuccessExample Success-Response:
    *     HTTP/1.1 200 OK
        [
            {
                id: 4591,
                date: "2016-07-26 10:26:04",
                place: 65,
                title: "Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong",
                content: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> ",
                excerpt: "<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> ",
                categories: "[2]",
                full: "http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png",
                thumbnail: "",
                created_at: null,
                updated_at: null
            }
        ]
    *
    *
    */
    function postByCategoryId($placeID,$categoryID){
         $post=new Post();
         $bitacora=new Bitacora();
         $category=new Category();
         
         $catData=$category->getCategoryById($placeID,$categoryID);
         $catName=$catData[0]->category;
         $bitacora->setEvent(
            "Categoria $catName visitada",
            $placeID,
            "categories",
            $categoryID
            );
         return $post->getPostByCategory($placeID,$categoryID);
    }
    /**
    *@api {get} api/posts/home
    * @apiName add Post by ID in Home
    * @apiGroup Post
    * @apiVersion 0.1.0
    */
    function postByCategoryName($placeID,Request $request){
        $categoryArg=new Category();
        $catData=$categoryArg->getCategoryByName($placeID,$request->category);
        return $this->postByCategoryId($placeID,$catData[0]->wpId);
    }
    function addPostToHomeScreen(Request $request){
         $portada=new Portada();
         return [$portada->add($request->id,$request->placeID)];
    }
    function getHomePosts(Request $request){
        $portada=new Portada();
        return $portada->getPosts($request->placeID);
    }
    function removePostToHomeScreen(Request $request){
         $portada=new Portada();
         return $portada->remove($request->id);
    }
    function orderPostsInHome(Request $request){
        $portada=new Portada();
        return [$portada->changeOrder($request->id,$request->orden)];
    }
}