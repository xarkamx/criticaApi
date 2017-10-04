class PostsController{
    constructor(){
         this.tools=new Tools();
    }
    async getPosts(search=""){
            let url="/api/places/0/posts";
            search=(search=="")?{}:{search};
            let result= await this.tools.ajax.fetchData(url,search,'get');
            return result;
    }
    addPostToHome(id){
        let _token=this.tools.helpers.getBodyToken();
        let url="/api/home"
        return new Promise((load,fail)=>{
            this.tools.ajax.postData(url,{id,_token},(ev)=>{
                load(ev);
            },"post")
        });
    }
    async getHomePosts(){
        let url="/api/home";
        let result= await this.tools.ajax.fetchData(url,{},'get');
        return result;
    }
    removePostFromHome(id){
        let _token=this.tools.helpers.getBodyToken();
        let url="/api/home"
        return new Promise((load,fail)=>{
            this.tools.ajax.postData(url,{id,_token,_method:"delete"},(ev)=>{
                load(ev);
            },"post")
        });
    }
    orderPostsInHome(id,orden){
        let _token=this.tools.helpers.getBodyToken();
        let url="/api/home/order"
        return new Promise((load,fail)=>{
            this.tools.ajax.postData(url,{id,_token,orden,_method:"put"},(ev)=>{
                load(ev);
            },"post")
        });
    }
}