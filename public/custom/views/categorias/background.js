class Background{
    constructor(path=null){
        this.tools=new Tools();
        if(path!=null){
            this.userForm=JSON.parse(this.tools.ajax.import(path));
        }
    }
    print(targetDom){
        this.tools.templates.printForm(this.userForm,targetDom);
        this.addCatsToSelect(targetDom);
        this.submit(targetDom);
    }
    addCatsToSelect(dom){
        let cat=new Categories();
        let select=dom.querySelector('.categoria select');
        cat.getAll().then((ev)=>{
            let checker={};
            for(let index in ev){
                let item=ev[index];
                let option=document.createElement('option');
                if(checker[item.category]!=undefined){
                    continue;
                }
                checker[item.category]=true;
                option.innerHTML=item.category;
                option.value=item.category;
                select.add(option);
            }
        })
    }
    submit(dom){
        let form=dom.closest('form');
        let cat=new Categories();
        form.addEventListener('submit',(ev)=>{
            ev.preventDefault();
            let inputs=this.tools.helpers.inputsToObject(form);
            this.tools.helpers.fileToImage(inputs.background[0]).
            then((data)=>{
                if((data.file.size/1024)>500){
                    alert("La imagen es muy pesada.");
                    return false;
                }
                let cat=new Categories();
                cat.sendBackground(inputs.categoria,data.img.currentSrc,inputs['_token']).then((path)=>{
                    alert("se ha subido el background de la categoria");
                });
            });
        });
    }
}