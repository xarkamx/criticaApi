class Impreso {
    printForm(jsonPath, target) {
        let tools = new Tools();
        let json = tools.ajax.import(jsonPath);
        json = JSON.parse(json);
        tools.templates.printForm(json, target);
        this.printPlaces(target);
        this.sendFiles(target);
        this.places = {};
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
                        return setTimeout(() => {
                            porcentaje.remove();
                            this.print();
                        }, 2000);
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
            this.places = ev;
            this.print();
        });
    }
    print(redraw = true) {
        let fileList = document.querySelector(".fileList");
        let impresos = new Impresos();
        if (this.clonedFileList != undefined) {
            fileList.innerHTML = "";
            fileList.appendChild(this.clonedFileList);
        }
        let originalFileList = fileList.querySelector(".parent");
        this.clonedFileList = originalFileList.cloneNode(true);
        impresos.get().then((revistas) => {
            this.fillFileList(revistas, originalFileList);
        });
    }
    fillFileList(files, template, path = "/uploads/impreso") {
        for (let index in files) {
            let file = files[index];
            let child = template.querySelector(".child").cloneNode(true);
            let fn = this.setFileName(child, file, index);
            this.openFile(child, file, path + "/" + index + "/");
            this.deleteFile(child, path + "/" + fn);
            this.folderOrFile(file, child, path + "/" + fn);
            template.appendChild(child);
        }
        template.querySelector(".child").remove();
    }
    setMainFolderName(name, places, child) {
        let place = places.filter((item) => {
            return item.id == name;
        });
        if (place.length > 0) {
            console.log(place);
            child.querySelector(".delete").remove();
        }
        return (place.length > 0) ? place[0].place : name;
    }
    setFileName(child, file, index) {
        let filename = child.querySelector(".fileName");
        let name = file;
        if (typeof file == "object") {
            filename.innerHTML = this.setMainFolderName(index, this.places, child);
            name = "";
        }
        else {
            filename.innerHTML = file;
        }
        return name;
    }
    openFile(child, file, path) {
        let open = child.querySelector(".open");
        let impresos = new Impresos();
        open.addEventListener('click', (ev) => {
            let content = child.querySelector(".content");
            if (content.innerHTML == "") {
                open.querySelector(".fa").classList.remove("fa-plus-square");
                open.querySelector(".fa").classList.add("fa-minus-square");
                impresos.get(path).then((revistas) => {
                    this.openFolder(content, revistas, child, path);
                })
            }
            else {
                content.innerHTML = "";
                open.querySelector(".fa").classList.remove("fa-minus-square");
                open.querySelector(".fa").classList.add("fa-plus-square");
            }
        });
    }
    deleteFile(child, path) {
        let del = child.querySelector(".delete");
        if (del == undefined) {
            return false;
        }
        del.addEventListener("click", (ev) => {
            let impresos = new Impresos();
            let token = document.body.dataset.csrf_token;
            impresos.delete(path, token).then((response) => {
                child.remove();
            });
        })
    }
    folderOrFile(file, template, path) {
        let preview = template.querySelector(".preview");
        if (typeof file == "string") {
            console.log(template);
            template.querySelector(".open").remove();
            preview.classList.remove("hidden");
            preview.querySelector("img").src = path;
        }
    }
    openFolder(content, file, child, path) {
        let newChild = this.clonedFileList.cloneNode(true);
        if (typeof file == "object") {
            content.appendChild(newChild);
            this.fillFileList(file, child.querySelector(".content"), path);
        }
    }
}
