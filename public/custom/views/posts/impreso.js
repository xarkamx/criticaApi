class Impreso {
    printForm(jsonPath, target) {
        let tools = new Tools();
        let json = tools.ajax.import(jsonPath);
        json = JSON.parse(json);
        tools.templates.printForm(json, target);
        this.printPlaces(target);
        this.sendFiles(target);
    }
    sendFiles(target) {
        let form = target.closest('form');
        let impresos = new Impresos();
        form.addEventListener('submit', (ev) => {
            ev.preventDefault();
            let counter = 0;
            let place = target.querySelector(".place select").value;
            let tools = new Tools();
            let inputs = tools.helpers.inputsToObject(target);
            let porcentaje = document.createElement('div');
            porcentaje.classList.add('blackFull');
            document.body.appendChild(porcentaje);
            porcentaje.innerHTML = "Cargando Archivos";
            for (let index = 0; index < inputs.files.length; index++) {
                let file = inputs.files[index];
                impresos.upload(inputs.folderName, file, place).then((ev) => {
                    ++counter;
                    let status = Math.floor((counter / inputs.files.length) * 100)
                    porcentaje.innerHTML = "Cargando Archivos " + status + "%";
                    if (status == 100) {
                        porcentaje.innerHTML = "Carga completada";
                        setInterval(() => {
                            porcentaje.remove();
                        }, 2000)

                    }
                });
            }
        });
    }
    printPlaces(target) {
        let places = new Places();
        places.getAll().then((ev) => {
            for (let index in ev) {
                let place = ev[index];
                let option = document.createElement('option');
                option.value = place.id;
                option.innerHTML = place.place;
                target.querySelector('.place select').add(option);
            }
        });
    }
}
