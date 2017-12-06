<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Tools;

class Post extends Model{
    protected $table="posts";
    public function __construct(){
        $this->wpApi="wp-json/wp/v2/posts";
    }
    public function getPostFromUrl($url,$postID=""){
        $tools=new Tools();
        $response=$tools->easyCurl($url.$this->wpApi."/$postID");
        return $response;
    }
    public function savePosts($url,$postID,$placeID){
        $latest=$this->select("date")->where("place",$placeID)
            ->orderBy("date","desc")->get();
        $date=(count($latest)>0)?preg_replace("/ /","T",$latest[0]['date']):
            date("Y-m-d")."T00:00:00";
        $data=$this->getPostFromUrl(
            $url,$postID."?_embed&per_page=100&after=$date&filter[orderby]=date&order=asc"
            );
            
        $posts=[];
        if(gettype( $data)=="string"){
            $data=[$data];
        }
        if(count($data)<1 or $data==false){
            return ["error"=>"no new Posts"];
        }
        foreach($data as $key=>$item){
            if(!isset($item['_embedded'])){
                continue;
            }
            if(!isset($item['_embedded']['wp:featuredmedia'])){
                $item['_embedded']['wp:featuredmedia'][0]['source_url']="https://www.criticajalisco.com/wp-content/themes/critica2/img/logos/critica.png";
            }
            $media=$item['_embedded']['wp:featuredmedia'][0];
            $thumb="https://www.criticajalisco.com/wp-content/themes/critica2/img/logos/critica.png";
            if(isset($media['media_details']['sizes'])){
               $thumb=$media['media_details']['sizes']['thumbnail']['source_url'];
            }
            if(!isset($media['source_url'])){
                $media['source_url']="https://www.criticajalisco.com/wp-content/themes/critica2/img/logos/critica.png";
            }
            $full=$media['source_url'];
            $post['wpId']=$item['id'];
            $post['date']=$item['date'];
            $post['place']=$placeID;
            $post['title']=$item['title']['rendered'];
            $post['content']=preg_replace("/'/",'',$item['content']['rendered']);
            $post['excerpt']=$item['excerpt']['rendered'];
            $post['categories']=json_encode($item['categories']);
            $post['link']=$item['link'];
            $post['full']=$full;
            $post['thumbnail']=$thumb;
            $posts[]=$post;
        }
        $tools=new Tools();
        if(!isset($post)){
            return ['no response'];
        }
        $tools->massiveBulk('posts',$posts);
        return $this->getPost($placeID,$postID);
    }
    public function saveAllPosts($url,$postID,$placeID){
        $latest=$this->select("date")->where("place",$placeID)
            ->orderBy("date","desc")->get();
        $date=(count($latest)>0)?preg_replace("/ /","T",$latest[0]['date']):
            date("Y-m-d")."T00:00:00";
        $data=$this->getPostFromUrl($url,$postID."?_embed&per_page=100");
        $posts=[];
        if(!isset($data[0])){
            $data=[$data];
        }
        if(!isset($data[0]['_embedded'])){
            return ['Error'=>"undefined post"];
        }
        
        foreach($data as $key=>$item){
            if(!isset($item['_embedded']['wp:featuredmedia'])){
                $item['_embedded']['wp:featuredmedia'][0]['source_url']="http://www.criticajalisco.com/wp-content/themes/critica2/img/logos/critica.png";
            }
            $media=$item['_embedded']['wp:featuredmedia'][0];
            $thumb="http://www.criticajalisco.com/wp-content/themes/critica2/img/logos/critica.png";
            if(isset($media['media_details']['sizes']['thumbnail'])){
               $thumb=$media['media_details']['sizes']['thumbnail']['source_url'];
            }
            if(!isset($media['source_url'])){
                $media['source_url']="https://www.criticajalisco.com/wp-content/themes/critica2/img/logos/critica.png";
            }
            $full=$media['source_url'];
            $post['wpId']=$item['id'];
            $post['date']=$item['date'];
            $post['place']=$placeID;
            $post['title']=$item['title']['rendered'];
            $post['content']=addslashes ( $item['content']['rendered']);
            $post['excerpt']=$item['excerpt']['rendered'];
            $post['categories']=json_encode($item['categories']);
            $post['full']=$full;
            $post['thumbnail']=$thumb;
            $posts[]=$post;
        }
        $tools=new Tools();
        $tools->massiveBulk('posts',$posts);
        return $this->getPost($placeID,$postID);
    }
    public function getPost($placeID,$postID=null,$search=null){
        if($search!=null){
            $queries=$this->searchQuery($search);
            $query=($placeID==0)?"$queries":"place=$placeID and $queries";
            $data=\DB::select("SELECT * FROM `posts` 
            where $query group by title limit 0,30 ");
            return $data;
        }
        if($postID!=null){
            return $this->where("place",$placeID)->orWhere('id',$postID)
            ->orderBy('date','desc')
            ->take(270)
            ->get();
        }elseif($placeID!=null && $placeID!=0){
            return $this->where("place",$placeID)
            ->take(270)
            ->orderBy('date','desc')
            ->get();    
        }else{
            return $this->take(100)->orderBy('date','desc')->get();
        }
    }
    private function searchQuery($search){
        $searchs=preg_split("/ /",$search);
        $queries=[];
        foreach ($searchs as $search) {
            $query="(title like '%$search%' or 
            content like '%$search%' or 
            excerpt like '%$search%')";
            $queries[]=$query;
        }
        return implode("and",$queries);
    }
    public function getPostByCategory($placeID,$categoryID){
        $spliter='FIND_IN_SET("'.$categoryID.'",replace(replace(categories,"]",""),"[",""))>0';
        $query="SELECT id,date,place,title,content,full,link,excerpt FROM `posts` where $spliter and place='$placeID'
            order by id desc limit 0,30";
        $posts=\DB::select($query);
        return array_reverse($posts);
    }
}
