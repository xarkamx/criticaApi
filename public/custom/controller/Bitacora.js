class Bitacora {
    async getByType(type, limit = 10) {
        let tools = new Tools();
        let path = "/api/bitacora/" + type;
        let resp = await tools.ajax.fetchData(path, { limit });
        return resp;
    }
}
