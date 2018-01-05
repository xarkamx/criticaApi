class Posts {
    constructor(app) {
        this.appDOM = document.querySelector(app);
        this.template = this.appDOM.querySelector(".listParent").cloneNode(true);
        this.pc = new PostsController();
        this.modal = new PostsModal();

        this.triggerEvents(this.appDOM.querySelector(".addPosts"));
        this.modal.currentPosts = {};
        this.printPlaces();
        this.placeID = 0;
        setInterval(() => {
            this.printPortada(this.placeID);
        }, 1000);
    }
    triggerEvents(doc) {
        doc.addEventListener('click', (ev) => {
            this.modal.showModal();
        });

    }
    printPortada(place = 0) {

        this.pc.getHomePosts(place).then((ev) => {
            if (JSON.stringify(this.modal.currentPosts) == JSON.stringify(ev)) {
                return false;
            }

            this.modal.currentPosts = ev;
            let parent = this.template.cloneNode(true);
            let target = parent.querySelector('.listTarget');
            this.pc.tools.templates.fillTemplate(parent, target, ev, this);

            this.appDOM.querySelector(".postList").innerHTML = "";
            this.appDOM.querySelector(".postList").appendChild(parent);
        });
    }
    thumbnail(dom, val) {
        dom.style.backgroundImage = "url(" + val + ")";
    }
    place(dom, val) {
        this.currentPlace = val;
        if (val == 0) {
            dom.innerHTML = "<i class='fa fa-globe' aria-hidden='true'></i>";
            dom.style.color = "green";
        }
    }
    portID(dom, val) {
        dom.querySelector(".delete").addEventListener('click', (ev) => {
            this.pc.removePostFromHome(val).then((ev) => {
                dom.closest('li').remove();
            });

        });
        dom.querySelector('.orden').addEventListener("change", (ev) => {
            this.pc.orderPostsInHome(val, ev.target.value);
        });

    }
    portada(dom, val) {
        dom.querySelector(".filtro").addEventListener("click", (ev) => {
            this.toggleVisibility(val);
        })
    }
    filtro(dom, val) {
        if (this.currentPlace != 0) {
            dom.innerHTML = "";
        }
        if (val != null) {
            dom.style.color = "#D00";
            dom.innerHTML = "<i class='fa fa-eye-slash' Title='Oculto' aria-hidden='true'></i>";
        }
    }
    orden(dom, val) {
        dom.value = val;

    }
    printPlaces() {
        let places = new Places();
        places.getAll().then((ev) => {
            let estados = this.appDOM.querySelector(".place select");
            estados.addEventListener("change", (evento) => {
                this.placeID = evento.target.value;
                this.modal.placeID = this.placeID;
                this.printPortada(this.placeID);
            });
            ev.map((item) => {
                if (item.country != "MEX") {
                    return false;
                }
                let option = document.createElement("option");
                option.value = item.id;
                option.innerHTML = item.place;
                estados.add(option);
            });
        });
    }
    toggleVisibility(val) {
        this.pc.toggleStatus(val, this.placeID).then((ev) => {
            this.printPortada(this.placeID);
        });
    }
}
