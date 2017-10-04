class ConfigViews{
    constructor(targetNode,type){
        this.tools=new Tools();
        this.tabla=new Tables();
        this.token=document.body.dataset.csrf_token;
        let form=targetNode.querySelector('.form');
        let view=targetNode.querySelector('.view');
        switch (type) {
            case 'servicios':
                this.type=new Services(this,form,view);
            break;
            case 'empresas':
                this.type=new Empresas(this,form,view);
            break;
            case 'utilidades':{
                this.type=new Utilidades(this,form,view);
            }break;
            case 'estados':{
                this.type=new Estados(this,form,view);
            }break;
            case 'checkpoints':{
                this.type=new Checkpoints(this,form,view);
            }break;
            default:
                // code
        }
    }
    printForm(targetNode,path){
        let form=this.tools.ajax.import(path);
        this.tools.templates.printForm(form,targetNode);
        
    }
    printTemplate(target,template,path){
        target.insertAdjacentHTML('beforeEnd',this.tools.ajax.import(template));
        let pn=target.querySelector('.parent');
        let tn=target.querySelector('.target');
        this.tools.ajax.postData(path,{},(ev)=>{
            this.tools.templates.fillTemplate(pn,tn,ev,this.type); 
        });
    }
}