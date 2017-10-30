class Place {
    printForm(jsonPath, target) {
        let tools = new Tools();
        let json = tools.ajax.import(jsonPath);
        json = JSON.parse(json);
        tools.templates.printForm(json, target);
    }
    printTable(target) {
        let places = new Places();
        let tables = new Tables();
        places.getAll().then((ev) => {
            let parent = target.querySelector('tbody');
            let targetNode = target.querySelector('tbody tr');
            tables.fillTable(target, ev, targetNode, parent, {
                place: this.editablePlace,
                url: this.editablePlace,
                alias: this.editablePlace,
                id: this.getID
            });
        });
    }
    editablePlace(dom, value) {
        dom.contentEditable = true;
        dom.innerHTML = value;
        let currentID = this.currentid;
        dom.addEventListener('focusout', (ev) => {
            let places = new Places();
            if (value != dom.innerText) {
                value = dom.innerText;
                places.update({
                    column: dom.classList[0],
                    value,
                    id: currentID,
                    _method: "PUT"
                });
            }
        });
    }
    getID(dom, value) {
        this.currentid = value
    }
}
