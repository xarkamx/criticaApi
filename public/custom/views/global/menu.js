class Menu {
    constructor(path = '') {
        this.tools = new Tools();
        if (path != null || path != '') {
            localStorage.clear();
            this.menu = this.tools.ajax.import(path);
        }
    }
    printer(templates, json = '', specialEvents = this) {
        if (json == null || json == '') {
            json = this.menu;
        }
        if (typeof json == 'string') {
            json = JSON.parse(json);
        }
        this.tools.templates.jsonToMenu(json, templates, specialEvents);
        $('#side-menu').removeData("mm");
        $('#side-menu').metisMenu();
    }
    fa(dom, value) {
        dom.classList.add('fa');
        dom.classList.add(value);
    }
    url(dom, value) {
        dom.href = value;
    }
    childs(dom, json) {
        parent = dom.parentElement;
        dom = dom.cloneNode(true);
        for (let pos in json) {
            dom.querySelector('a').innerHTML = pos;
            dom.querySelector('a').href = json[pos].url;
            parent.appendChild(dom);
            dom = dom.cloneNode(true);
        }

    }
}
