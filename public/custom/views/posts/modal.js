class PostsModal{
    constructor(){
        this.pc=new PostsController();
        this.modal=this.loadModal();
        this.parent=this.modal.querySelector(".parent").cloneNode(true);
    }
    loadModal(){
        let modal=this.pc.tools.ajax.import("/custom/views/html/modal.html");
        document.body.insertAdjacentHTML("beforeend",modal);
        this.modalEvents(document.querySelector('.postLists'));
        return document.querySelector('.postLists');
        
    }
    modalEvents(modal){
        let interval;
         
        modal.querySelector(".search").addEventListener("change",(ev)=>{
            this.printAllPosts(ev.target.value);
        });
    }
    printAllPosts(search){
        let posts=this.pc.getPosts(search).then(ev=>{
            let parent=this.parent.cloneNode(true);
            let target=parent.querySelector('.post');
            this.modal.querySelector('.parent').remove();
            this.pc.tools.templates.fillTemplate(parent,target,ev,this);
            this.modal.querySelector('.modal-body').insertAdjacentElement("beforeend",parent);
            
        });
    }
    id(dom,val){
        let found=this.pc.tools.helpers.
            findInArrayOfObjects(this.currentPosts, "id", val);
        if(found!=null){
            dom.classList.add("selected");
        }
        dom.addEventListener('click',(ev)=>{
            if(dom.classList.contains('selected')==false){
                dom.classList.add("selected");
                this.addPostToHome(val);
            }else{
                this.pc.removePostFromHome(val);
                dom.classList.remove("selected")
            }
        })
    }
    full(dom,val){
        dom.style.backgroundImage="url("+val+")";
    }
    addPostToHome(id){
        this.pc.addPostToHome(id);
    }
    showModal(){
        this.printAllPosts();
        $(this.modal).modal("show");
    }
}