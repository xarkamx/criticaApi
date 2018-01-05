class BitacoraView {
    printList(parentNode, type) {
        let bitacora = new Bitacora();
        bitacora.getByType(type).then((ev) => {
            let tools = new Tools();
            let targetNode = parentNode.querySelector(".target");
            tools.templates.fillTemplate(parentNode, targetNode, ev);
        });
    }
}
