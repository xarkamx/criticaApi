class Helpers {
    objectToSerialize(param) {
        let keys = Object.keys(param),
            values = [];
        for (let k in keys) {
            let value = (typeof (param[keys[k]]) == 'object' && Array.isArray(param[keys[k]]) == false) ? JSON.stringify(param[keys[k]]) : param[keys[k]];
            values.push(keys[k] + '=' + value);
        }
        return values.join('&');

    }
    inputsToObject(dom) {
        let inputs = dom.querySelectorAll('input,select,textarea'),
            pos = 0;
        let content = {};
        for (pos; pos < inputs.length; ++pos) {
            if (!inputs[pos].checkValidity()) {
                alert('el campo ' + inputs[pos].name + ' no es valido');
                return false;
            }
            var input = inputs[pos];
            var value;
            if (input.type == 'file') {
                value = input.files;
                input.name
            }
            else if (input.type == 'checkbox') {
                value = input.checked;
            }
            else if (input.type == 'radio' ) {
                if(input.checked==false){
                    continue;
                }
                value = input.value;
            }
            else {
                if (input.value == '') {
                    continue;
                }
                value = input.value.replace(/,/, '.');
                value = encodeURIComponent(value);
            }
            if (input == undefined || typeof (input) != 'object') {
                continue;
            }
            if (!inputs[pos].checkValidity()) {
                alert('el campo ' + inputs[pos].name + ' no es valido');
                return false;
            }
            if (content[input.name] == undefined) {
                content[input.name] = value;
            }
            else if (typeof (content[input.name]) == 'object') {
                content[input.name].push(value);
            }
            else {
                let val = content[input.name];
                content[input.name] = [];
                content[input.name].push(val);
                content[input.name].push(value);
            }
        }
        return content;
    }
    error(msg) {
        document.body.innerHTML = msg.responseText;
        throw msg;
    }
    removeBySelector(selector) {
        let killList = document.querySelectorAll(selector);
        let pos = 0;
        for (pos; pos < killList.length; ++pos) {
            let killItem = killList[pos];
            killItem.parentElement.removeChild(killItem);
        }
    }
    findInArrayOfObjects(arrg, key, value) {
        for (let index in arrg) {
            let item = arrg[index];
            if (item[key] == value) {
                return item;
            }
        }
    }
    fileTo64(file) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        return new Promise((load, reject) => {
            reader.onload = load;
            reader.onerror = reject;
        });
    }
    fileToImage(file, dom) {
        return this.fileTo64(file).then((ev) => {
            let img = document.createElement('img');
            img.src = ev.target.result;
            return new Promise((load, reject) => {
                let data = {
                    img,
                    file
                }
                load(data);
            });
        });
    }
    getBodyToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    }
    merge(...objs){
        let finalObject={}
        for(let index in objs){
            let obj=objs[index];
            for(let keys in obj){
                finalObject[keys]=obj[keys];
            }
        }
        return finalObject;
    }
    searchAndDestroy(args,key,value){
        let filter=args.filter((item,index)=>{
            return item[key]!=value;
            
        });
        return filter;
    }
    searchAndInsert(args,where,val,key,insert){
        return args.map((item,index)=>{
            if(item[where]==val){
                item[key]=insert;
            }
            return item;
        })
    }
    searchByKey(args,key,value){
        let filter=args.filter((item,index)=>{
            return item[key]==value;
            
        });
        return filter;
    }
    searchInObject(args,query) {
        return args.filter((item, index) => {
            for (let key in item) {
                if(item[key]==null){
                    continue;
                }
                let data = item[key].toString();
                let regQuery = RegExp(query, "i");
                let match = data.match(regQuery);
                if (match != null) {
                    return true;
                }
            }
            return false;
        });
    }
    getObjectTitles(obj){
        let result=[];
        for (let key in obj){
            result.push({key})
        }
        return result;
    }
}
