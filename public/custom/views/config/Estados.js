class Estados{
    constructor(sp,form,view){
        this.config=sp;
        this.view=view;
        this.form=form;
        this.tools=this.config.tools;
        this.config.printForm(form,"/json/status.Form.json");
        this.config.printTemplate(view,
            "/custom/views/config/html/estados.html",
            "/api/estados");
        this.estadosEvents(form);
    }
    estadosEvents(dom){
        let form=dom.parentElement;
        form.addEventListener('submit',(ev)=>{
           ev.preventDefault();
           this.save(form);
        });
    }
    save(dom){
        let data=this.tools.helpers.inputsToObject(dom);
        this.tools.ajax.postData("/api/estados",data,(ev)=>{
            try{
                this.tools.templates.addChildToTemplate(
                this.view.querySelector('.target'),
                ev,
                this
                );   
            }catch(error){
                this.printView();
            }
        },'post')
    }
    id(dom,value){
        dom.addEventListener('click',(ev)=>{
           let msg='Esta accion eliminara un estado,'
           +' y por lo tanto algunas ordenes podrian verse afectadas.\n Desea continuar?';
           if(confirm(msg)) {
               this.deleteEstado(value,dom);
           }
        });
    }
    deleteEstado(id,dom){
        let data={
            _method:'delete',
            _token:this.config.token
        }
    this.tools.ajax.postData('/api/estados/'+id,data,(ev)=>{
        if(JSON.parse(ev)[0]==true)dom.parentElement.remove();
    },'post');
    }
    printView(){
        this.config.printTemplate(this.view,
                "/custom/views/config/html/estados.html",
                "/api/estados");
    }
}