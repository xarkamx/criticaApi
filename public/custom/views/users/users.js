class Users{
    constructor(path=null){
        this.tools=new Tools();
        if(path!=null){
            this.userForm=JSON.parse(this.tools.ajax.import(path));
        }
    }
    print(targetDom){
        this.tools.templates.printForm(this.userForm,targetDom);
    }
    save(targetDom){
        let data=this.tools.helpers.inputsToObject(targetDom);
        if(data.password!=data.confirmPass){
            alert("Tu contraseña no coincide.");
            return false;
        }
        this.tools.ajax.postData(targetDom.action,data,(ev)=>{
            alert("El usuario ha sido agregado al sistema");  
        },targetDom.method);
    }
    fillById(id,form){
        let data={
            id
        }
        this.tools.ajax.postData("/api/users/all",data,(ev)=>{
            this.tools.templates.fillForm(ev,form,{
                email:function(dom,value){dom.disabled=true;dom.value=value},
                password:function(dom,value){dom.required=false},
                confirmPassword:function(dom,value){dom.required=false}
            });
        });
    }
    userExistByMail(dom,mail){
        let data={
            value:mail,
            by:'email'
        }
        this.tools.ajax.postData("/api/users/all",data,(ev)=>{
            ev=JSON.parse(ev);
            if(ev.length>0){
                dom.placeholder='Ese correo ya esta en uso';
                dom.value='';
            }
        });
    }
    loadUsers(table,path){
        this.tabla=new Tables();
        let UserList=this.tabla.createTable(path,table,this);
    }
    id(dom,value){
        this.userEvents(dom,value);
    }
    userEvents(dom,value){
        dom.querySelector('.edit').addEventListener('click',(ev)=>{
           window.location.href="/usuarios/add/"+value; 
        });
        dom.querySelector('.delete').addEventListener('click',(ev)=>{
            if(confirm('Estas seguro de que deseas eliminar este usuario?')){
                this.userDelete(value,dom);
            }
        });
    }
    userDelete(id,dom){
        let data={
            _method:"delete",
            _token:document.body.dataset.csrf_token
        }
        this.tools.ajax.postData("/api/users/"+id,data,(ev)=>{
            if(JSON.parse(ev)[0]==true){
                this.tabla.delete(this.dataTable,dom.parentElement);
            }
        },'post');
    }
    getCurrentUser(){
        return new Promise((load,fail)=>{
           this.tools.ajax.postData("/api/users/current",{},load) 
        });
    }
}