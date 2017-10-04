class Clients{
    constructor(path=null){
        this.tools=new Tools();
        if(path!=null){
            this.clientForm=JSON.parse(this.tools.ajax.import(path));
        }
    }
    print(targetDom){
        this.tools.templates.printForm(this.clientForm,targetDom);
    }
    save(targetDom){
        let data=this.tools.helpers.inputsToObject(targetDom);
        if(data.password!=data.confirmPassword){
            alert("Tu contraseña no coincide.");
            return false;
        }
        this.tools.ajax.postData(targetDom.action,data,(ev)=>{
            alert("El cliente ha sido agregado al sistema");  
        },targetDom.method);
    }
    clientExist(input){
        let data={
            by:'email',
            value:input.value
        };
        this.tools.ajax.postData("/api/clients",data,(ev)=>{
            if(JSON.parse(ev).length>0){
                input.value='';
                input.placeholder="este correo ya ha sido definido";
            }
        });
    }
    loadClients(table,path){
        this.table=new Tables();
        let clientsList=this.table.createTable(path,table,this);
    }
    id(dom,value){
        this.actionsEvents(dom.parentElement,value);
    }
    actionsEvents(dom,id){
        dom.querySelector('.delete').addEventListener('click',(ev)=>{
            if(confirm("¿seguro que deseas eliminar este cliente?")){
                this.deleteUser(dom,id);
            }
        });
        dom.querySelector('.edit').addEventListener('click',(ev)=>{
            window.location.href="/clientes/add/"+id;
            
        });
    }
    deleteUser(dom,id){
        let data={
            _method:"DELETE",
            _token:document.body.dataset.csrf_token
        }
        this.tools.ajax.postData("/api/clients/"+id,data,(ev)=>{
            this.table.delete(this.dataTable,dom);
        },'post');
    }
    fillById(id,form){
        let data={
            id
        }
        this.tools.ajax.postData("/api/clients",data,(ev)=>{
            this.tools.templates.fillForm(ev,form,{
                email:function(dom,value){dom.disabled=true;dom.value=value},
                password:function(dom,value){dom.required=false},
                confirmPassword:function(dom,value){dom.required=false}
            });
        });
    }
}