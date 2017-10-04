class Empresas{
    constructor(sp,form,view){
        this.config=sp;
        this.view=view;
        this.form=form;
        this.tools=this.config.tools;
        this.config.printForm(form,"/json/empresaTransportadora.Form.json");
        this.printView();
        this.empresaEvents(form);
    }
    empresaEvents(dom){
        let form=dom.parentElement;
        form.addEventListener('submit',(ev)=>{
           ev.preventDefault();
           this.save(form);
        });
    }
    save(dom){
        let data=this.tools.helpers.inputsToObject(dom);
        this.tools.helpers.fileToImage(data.logo[0]).
        then(this.validImg).
        then((ev)=>{
            data.logo=ev;
            this.saveEmpresa(data);   
        });
    }
    saveEmpresa(data){
        this.tools.ajax.postData("/api/empresas",data,(ev)=>{
            let target=this.view.querySelector('.target');
            try{
                this.tools.templates.addChildToTemplate(target,ev,this);
            }catch(error){
                this.printView();
            }
        },'post');    
    }
    validImg(obj){
        let img=obj.img;
        let w=img.naturalWidth;
        let h=img.naturalHeight;
        let response=true;
        if(w!=h || w>300 || obj.file.size>250000){
            alert('La imagen debe ser cuadrada, medir un maximo de 300x300 y'+
            ' pesar menos de 76kb');
            response=false;
        }
        return new Promise((load,fail)=>{
             if(response==true)load(img.src);
        });
    }
    id(dom,value){
        dom.addEventListener('click',(ev)=>{
           let msg='Esta accion eliminara una Empresa,'
           +' y por lo tanto algunas ordenes podrian verse afectadas.\n Desea continuar?';
           if(confirm(msg)) {
               this.deleteEmpresa(value,dom);
           }
        });
    }
    deleteEmpresa(id,dom){
        let data={
            _method:'delete',
            _token:this.config.token
        }
    this.tools.ajax.postData('/api/empresas/'+id,data,(ev)=>{
        if(JSON.parse(ev)[0]==true)dom.closest('li').remove();
    },'post');
    }
    printView(){
        this.config.printTemplate(this.view,
            "/custom/views/config/html/empresas.html",
            "/api/empresas");
    }
}