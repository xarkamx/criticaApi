class Utilidades{
    constructor(sp,form,view){
        this.config=sp;
        this.view=view;
        this.form=form;
        this.tools=this.config.tools;
        this.config.printForm(form,"/json/importacionExportacion.Form.json");
        this.printView();
        this.utilidadesEvents(form);
    }
    utilidadesEvents(dom){
        let form=dom.parentElement;
        form.addEventListener('submit',(ev)=>{
           ev.preventDefault();
           this.save(form);
        });
    }
    save(dom){
        let data=this.tools.helpers.inputsToObject(dom);
        this.tools.ajax.postData("/api/utilidades",data,(ev)=>{
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
           let msg='Esta accion eliminara una utilidad,'
           +' y por lo tanto algunas ordenes podrian verse afectadas.\n Desea continuar?';
           if(confirm(msg)) {
               this.deleteUtilidad(value,dom);
           }
        });
    }
    deleteUtilidad(id,dom){
        let data={
            _method:'delete',
            _token:this.config.token
        }
        this.tools.ajax.postData('/api/utilidades/'+id,data,(ev)=>{
            if(JSON.parse(ev)[0]==true)dom.parentElement.remove();
        },'post');
    }
    printView(){
        this.config.printTemplate(this.view,
            "/custom/views/config/html/utilidades.html",
            "/api/utilidades");
    }
}