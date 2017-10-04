'use strict';
class Templates extends Ajax {
    /**
     * @param {DOM} parentDom
     * @param {DOM} targetDom
     * @param {object||array||json} data
     * @param {object} specialEvents permite customizar la impresion de un argumento
     * por la clase de su DOM, por ejemplo si la clase de tu Dom objetivo es
     * .titulo, tu metodo dentro de specialEvents deberia ser titulo(dom,value);
     * 
     */
    fillTemplate(parentDom, templateDom, data, specialEvents = {}) {
        if (parentDom == null) {
            parentDom = document.body;
        }
        if (templateDom == null) {
            templateDom = document.body;
        }
        if (typeof data != 'object') {
            data = JSON.parse(data);
        }
        if (!Array.isArray(data)) {
            data = [data];
        }
        for (let pos = 0; pos < data.length; ++pos) {
            let item = data[pos];
            let clone = templateDom.cloneNode(true);
            this.setTemplateContent(item, clone, specialEvents);
            parentDom.appendChild(clone);
        }
        templateDom.parentElement.removeChild(templateDom);
    }
    setTemplateContent(items, dom, sp) {
        for (let key in items) {
            let item = items[key];
            let doms = this.validDomChild(dom, key);
            if (doms == false) {
                continue;
            }
            for (let index = 0; index < doms.length; ++index) {
                this.fillDom(doms[index], key, item, sp);
            }
        }
        return dom;
    }
    fillDom(dom, key, value, sp) {
        if (sp[key] != undefined) {
            return sp[key](dom, value);
        }
        if (this[dom.tagName] == undefined) {
            (dom.value == undefined) ? dom.innerHTML = value: dom.value = value;
            return dom;
        }
        else {
            this[dom.tagName](dom, value);
            return dom;
        }
    }
    validDomChild(dom, key) {
            let doms = dom.querySelectorAll('.' + key) ||
                dom.querySelectorAll('#' + key) ||
                dom.querySelectorAll("input['name=" + key + "']");
            return (doms.length > 0) ? doms : false;
        }
        /**
         *@param {object} json 
         *@param {DOM} targetNode
         */
    printForm(json, tn, specialEvents = {}) {
            if (typeof json != 'object') {
                json = JSON.parse(json);
            }
            for (let pos in json) {
                let item = json[pos];
                let parent = document.createElement('div');
                let label = document.createElement('label');
                parent.classList.add("form-group");
                parent.classList.add(item.name);
                label.innerHTML = item.label;
                parent.appendChild(label);
                parent.appendChild(this.setInput(item));
                if (specialEvents[pos] != undefined) {
                    specialEvents[pos](parent);
                }
                tn.appendChild(parent);
            }
        }
        /**
         *@param {object} data 
         *@param {DOM} targetNode
         */
    fillForm(data, form, sp = {}) {
        if (typeof data != 'object') {
            data = JSON.parse(data);
        }
        if (Array.isArray(data)) {
            data = data[data.length - 1];
        }
        let inputs = form.querySelectorAll('input,select,textarea');
        for (let index = 0; index < inputs.length; ++index) {
            let input = inputs[index];
            let name = input.name;
            if (sp[name] != undefined) {
                sp[name](input, data[name]);
                continue;
            }
            input.value = data[name] || input.value;
        }
    }
    setInput(input) {
        let customInput = this[input.type];
        let generatedInput = document.createElement('input');
        if (customInput != undefined) {
            generatedInput = customInput(input);
        }
        for (let pos in input) {
            let att = input[pos];
            if (generatedInput.isReadOnly(pos)) continue;
            generatedInput[pos] = att;
        }
        return generatedInput;
    }
    select(input) {
        let sel = document.createElement('select');
        for (let pos in input.options) {
            let item = input.options[pos];
            let option = document.createElement('option');
            option.value = item;
            option.innerHTML = item;
            sel.add(option);
        }
        return sel;
    }
    textarea(input) {
        return document.createElement('textarea');
    }
    IMG(input, value) {
        input.src = value;
    }
    jsonToMenu(json, target, sp = {}) {
        let mTarget = target.cloneNode(true);
        let parent = target.parentNode;
        for (let pos in json) {
            let menu = json[pos];
            let clone = mTarget.cloneNode(true);
            this.fillMenu(pos, menu, clone, sp);
            parent.appendChild(clone);
        }
        target.remove();
        return mTarget;
    }
    fillMenu(name, menu, dom, sp = this) {
        menu.name = name;
        if (menu['childs'] == undefined) {
            dom.querySelector('.childs').remove();
        }
        for (let index in menu) {
            let element = menu[index];
            let item = dom.querySelector('.' + index);
            if (item == null) {
                continue;
            }
            index = index.replace(/-/gi, '_');
            if (typeof sp[index] == 'function') {
                sp[index](item, element);
                continue;
            }
            item.innerHTML = element;
        }
    }
    addChildToTemplate(targetNode, data, singularity) {
        let clone = targetNode.cloneNode(true);
        let parent = targetNode.parentElement;
        let childs = parent.innerHTML;
        parent.innerHTML = '';
        parent.appendChild(clone);
        this.fillTemplate(parent, clone, data, singularity);
        parent.insertAdjacentHTML('beforeEnd', childs);
    }
}
