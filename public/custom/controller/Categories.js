class Categories{
    async getAll(){
        let tools=new Tools();
        let categories=await tools.ajax.fetchData("/api/categories");
        return categories;
    }
    sendBackground(name,file,_token){
        let tools=new Tools();
        return new Promise((load,fail)=>{
            tools.ajax.postData("/api/categories/background",{name,file,_token},(ev)=>{load(ev)},'post');
        });
    }
}