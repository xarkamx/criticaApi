<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Place;
use App\Helpers\Tools;

class Places extends Controller
{
    
/**
*@api {get} api/places/country/{country?} get the  "places"
* @apiName Place by country
* @apiGroup Places
* 
* @apiParam {String} country the first 3 chars country name {3}
* @apiSucess {String}  id uniq id of client
* @apiSucess {String} country Country Code
* @apiSucess {String} place place name
* @apiSucess {String} url original url of place
* @apiVersion 0.1.0
*  @apiSuccessExample Success-Response:
*     HTTP/1.1 200 OK
*     {
*       id: 52,
*       country: "MEX",
*       place: "Aguascalientes",
*       url: "http://www.aguascalientespublica.com/",
*       created_at: "2017-05-25 23:09:19",
*       updated_at: "2017-05-25 23:09:20"
*       }
*
*/
    function codes($country=''){
        $place=new Place();
        return $place->getPlaces($country);
    }
/**
*@api {get} api/places/loc/ get place data by coordinates
* @apiName Codes by location
* @apiGroup Places
* 
* @apiParam {String} lat latitude coordinates
* @apiParam {String} lon longitude coordinates
* @apiSucess {String}  id uniq id of client
* @apiSucess {String} country Country Code
* @apiSucess {String} place place name
* @apiSucess {String} url original url of place
* @apiVersion 0.1.0
*  @apiSuccessExample Success-Response:
*     HTTP/1.1 200 OK
*     {
*       id: 52,
*       country: "MEX",
*       place: "Aguascalientes",
*       url: "http://www.aguascalientespublica.com/",
*       created_at: "2017-05-25 23:09:19",
*       updated_at: "2017-05-25 23:09:20"
*       }
*
*/
    function location(Request $request){
        $place=new Place();
        $placeName=$place->getPlaceNameByCoordinates($request->lat,$request->lon);
        
        $response=$place->getPlaceIdByName($placeName);
        return $response;
    }
/**
 * @api {post} api/places/bulk set multiple "places"
 * @apiName setPlaces
 * @apiGroup Places
 *@apiVersion 0.1.0
 * @apiParam {String} json with URL,country and place.
 *
 * @apiSuccess {String} true return true if success.
 */
    function setPlaces(Request $request){
        $places=new Place();
        $locations=json_decode($request->places);
        foreach($locations as $place){
            $places->saveModel((array)$place);
        }
        return [true];
    }
    /**
*@api {get} api/places/ get all the  "places"
* @apiName all Places
* @apiGroup Places
* 
* @apiVersion 0.1.0
*  @apiSuccessExample Success-Response:
*     HTTP/1.1 200 OK
*     {
*       id: 52,
*       country: "MEX",
*       place: "Aguascalientes",
*       url: "http://www.aguascalientespublica.com/",
*       created_at: "2017-05-25 23:09:19",
*       updated_at: "2017-05-25 23:09:20"
*       }
*
*/
    function getPlaces(){
        $place=new Place();
        return $place->getPlaces();
    }
}
