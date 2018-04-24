class ModalView{
    constructor(){
        //this.modal=this.startModal();
        }
    openModal(args,cssClass="modal-sm",singularity={}){
        this.modal=this.startModal();
        let tools=new Tools();
        tools.templates.quickFill(this.modal,args,singularity);
        this.modal.querySelector('.modal-dialog').className+=' '+cssClass;
        //document.body.appendChild(this.modal);
        $(this.modal).modal();
        return this.modal;
    }
    alert(title,message){
        return this.openModal({
            "modal-title":title,
            "modal-body":message
        });
    }
    dismiss(){
        $(this.modal).modal('hide');
        //document.querySelector('#hsjModal').remove();
    }
    startModal(){
        if(document.querySelector('#hsjModal')!=undefined){
            document.querySelector('#hsjModal').remove();
        }
        let modal=document.querySelector('#modal');
        document.body.insertAdjacentHTML('beforeend',modal.innerHTML);
        return document.querySelector('#hsjModal');
    }
    listener(event,callback){
        $(this.modal).on(event,callback);
    }
    
}