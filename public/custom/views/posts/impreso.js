class Impreso {
    printForm(jsonPath, target) {
        let tools = new Tools();
        let json = tools.ajax.import(jsonPath);
        json = JSON.parse(json);
        tools.templates.printForm(json, target);
    }
}
