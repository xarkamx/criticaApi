class Impresos {
    async upload(folder, file, place) {
        let tools = new Tools();
        let b64 = await tools.helpers.fileTo64(file);
        let data = await tools.ajax.fetchData("/api/media/impresos", {
            folder,
            place,
            name: file.name,
            b64: b64.target.result
        }, 'post');
        return data;
    }
}
