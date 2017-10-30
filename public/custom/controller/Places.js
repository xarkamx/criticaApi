class Places {
    async getAll() {
        let tools = new Tools();
        let places = await tools.ajax.fetchData("/api/places");
        return places;
    }
    async update(args) {
        let tools = new Tools();
        let places = await tools.ajax.fetchData("/api/places", args, "post");
        console.log(await places);
    }
}
