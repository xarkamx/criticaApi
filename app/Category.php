<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Tools;

class Category extends Model
{
    protected $table="categories";
    public function __construct(){
        $this->wpJson="/wp-json/wp/v2/categories";
    }
    public function getWpCategories($url){
        $tools=new Tools();
        $path=$url.$this->wpJson;
        return $tools->easyCurl($path."?per_page=100");
    }
    public function addCategories($data,$placeID){
        $categories=[];
        $tools=new Tools();
        foreach($data as $key=> $item){
            $currentCat=$this->getCategoryById($placeID,$item['id']);
            if(count($currentCat)>0){
                continue;
            }
            $categories[$key]['wpId']=$item['id'];
            $categories[$key]['placeID']=$placeID;
            $categories[$key]['category']=$item['name'];
            $categories[$key]['count']=$item['count'];
        }
        if(count($categories)==0){
            return [false];
        }
        $tools->massiveBulk("categories",$categories);
        return $categories;
    }
    public function getCategories($placeID){
        if($placeID!=null){
            return $this->where('placeId',$placeID)->orderBy('count', 'desc')->get();
        }
        return $this->orderBy('count','desc')->get();
    }
    public function getTopCategories($placeID,Array $args=
    ['Nacional',
    'Local',
    'Internacional',
    'Impresa',
    'Finanzas/Empresas',
    'Ciencia',
    'Cultura',
    'Deportes',
    'Entretenimiento',
    'Últimas noticias'
    ]){
        $tools=new Tools();
        $categories=\DB::select("select * from categories where
        placeId='$placeID'");
        $cat=[];
        foreach ($args as $value) {
            $result=$tools->searchInAssocArray($categories,'category',$value);
            if($result==false){
                continue;
            }
            $cat[]=$result;
        }
        return $cat;
    }
    
    public function getCategoryById($placeID,$categoryID){
        $sql="SELECT * FROM `categories` 
            where placeId='$placeID' and wpId='$categoryID'";
        return \DB::select($sql);
    }
}
