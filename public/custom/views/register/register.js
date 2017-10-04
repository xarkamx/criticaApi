class AdminRegister{
    constructor(){
        this.tools=new Tools();
    }
    printForm(parentNode,path){
        let json=JSON.parse(this.tools.ajax.import(path));
        this.tools.templates.printForm(json,parentNode);
        this.registerEvents();
    }
    registerEvents(){
        let formulario=document.querySelector('.register');
        formulario.addEventListener('submit',(ev)=>{
            ev.preventDefault();
            let password=formulario.querySelector('.password');
            let confirm=formulario.querySelector('.confirmPass');
            if(password.value!=confirm.value){
                alert("Las contraseñas no coinciden");
                return false;
            }
            let data=this.tools.helpers.inputsToObject(formulario);
            delete data.confirmPass;
            this.register(data);
        });
    }
    register(data){
        this.tools.ajax.postData("/api/users",data,(ev)=>{
            window.location.reload();
        },'post');
    }
    login(dom){
        let data=this.tools.helpers.inputsToObject(dom);
        this.tools.ajax.postData("/login",data,(ev)=>{
            ev=JSON.parse(ev);
            if(ev[0]==true){
                window.location.href='/home';
            }else{
                alert('Ingreso no valido');
            }
        },'post');
    }
    loginEvents(dom){
        dom.addEventListener('submit',(ev)=>{
            ev.preventDefault();
            this.login(dom);
        })
    }
}