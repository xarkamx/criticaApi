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
            this.places = ev;
            let parent = target.querySelector('tbody');
            let targetNode = target.querySelector('tbody tr');
            tables.fillTable(target, ev, targetNode, parent, this);
        });
    }
    editablePlace(dom, value) {
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
    id(dom, value) {
        let borrarButton = dom.querySelector('.eliminar');
        let editarButton = dom.querySelector('.editar');
        borrarButton.addEventListener('click', (ev) => {
            let response = confirm('¿Seguro que deseas proceder?');
            if (response) {
                let places = new Places();
                places.kill(value).then((result) => {
                    dom.closest('tr').remove();
                })
            }
        });
        editarButton.addEventListener('click', (ev) => {
            let modal = new ModalView();
            let modalDOM = modal.openModal({
                "modal-title": "Formulario de lugares",
                "modal-body": "",
                "btn": "Guardar",
            }, "modal-lg", {
                btn: (boton, etiqueta) => {
                    boton.innerText = etiqueta;
                    boton.addEventListener('click', () => {
                        this.sendPut(document.querySelector('.modal-body'), value);
                    })
                }
            });
            let tools = new Tools();
            let result = tools.helpers.searchByKey(this.places, "id", value);
            this.printForm(
                "/json/places.Form.json",
                modalDOM.querySelector('.modal-body'));
            tools.templates.fillForm(result, modalDOM);
        });


    }
    sendPut(form, id) {
        let tools = new Tools();
        let inputs = tools.helpers.inputsToObject(form);
        inputs.id = id;
        let place = new Places();
        place.update(inputs).then((ev) => {
            location.reload();
        });
    }
    submitEvent() {
        let form = document.querySelector('.places')
        form.addEventListener('submit', (ev) => {
            ev.preventDefault();
            let place = new Places();
            let tools = new Tools();
            let inputs = tools.helpers.inputsToObject(form);
            place.save(inputs).then(ev => {
                window.location.href = "/places/vista";
            });
        })
    }
}
