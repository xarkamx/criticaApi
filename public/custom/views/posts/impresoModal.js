class impresoModal {
    constructor() {
        this.pc = new PostsController();
    }
    loadModal() {
        if (this.modal != undefined) {
            return this.modal;
        }
        if (document.querySelector(".modal") != undefined) {
            document.querySelector(".modal").remove();
        }
        localStorage.clear();
        let modal = this.pc.tools.ajax.import("/custom/views/html/modalPrints.html");
        document.body.insertAdjacentHTML("beforeend", modal);
        this.modal = document.querySelector('.postLists');
        this.originalModal = this.modal.cloneNode(true);
        this.search();
        return this.modal;
    }
    printPosts(place, pliego) {
        pliego = pliego.replace(/\/\//gi, "/");
        let modal = this.loadModal();
        this.place = place;
        this.pliego = pliego;
        this.id = {};
        this.loadLeft(modal, pliego);
        //this.loadRight(modal, pliego);
    }
    showModal() {
        $(".postLists").modal("show");
    }
    left() {
        return {
            id: (dom, val) => {
                this.id[val] = dom;
                dom.addEventListener("click", (ev) => {
                    this.pc.addPostToPliego(this.place, val, this.pliego)
                        .then((ev) => {
                            console.log(ev);
                            this.loadRight(this.modal, this.pliego);
                            dom.style.background = "#ccc";
                        });
                });
            }
        }
    }
    right() {
        return {
            id: (dom, val) => {
                let left = this.id[val];
                left.style.background = "#ccc";
                dom.addEventListener("click", (ev) => {
                    dom.style.background = "#f00";
                    this.pc.removePostFromPliego(val, this.pliego)
                        .then((ev) => {
                            this.remove(dom, ev);
                            left.style.background = "#fff";
                        });
                });
            }
        }
    }
    remove(dom, val) {
        if (val[0] == true) {
            dom.closest("li").remove();
        }
    }
    loadLeft(modal, pliego, search = "") {
        let tools = new Tools();
        this.pc.getPosts(search).then((ev) => {
            let parentNode = modal.querySelector(".m_left .content ul");
            let targetNode = this.originalModal
                .querySelector(".m_left .content li").cloneNode(true);
            parentNode.innerHTML = "";
            tools.templates.fillTemplate(
                parentNode,
                targetNode,
                ev,
                this.left());
            this.loadRight(modal, pliego)
            this.showModal();
        });
    }
    loadRight(modal, pliego) {
        let tools = new Tools();
        this.pc.getLinkedPosts(pliego).then((ev) => {
            let parentNode = modal.querySelector(".m_right .content ul");
            let targetNode = this.originalModal
                .querySelector(".m_right .content li").cloneNode(true);
            parentNode.innerHTML = "";
            tools.templates.fillTemplate(
                parentNode,
                targetNode,
                ev,
                this.right());
        })
    }
    search() {
        let search = this.modal.querySelector(".search");
        search.addEventListener("change", (ev) => {
            let query = encodeURI(ev.target.value);
            this.loadLeft(this.modal, this.pliego, query);
        });
    }
}
