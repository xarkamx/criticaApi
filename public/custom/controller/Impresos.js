class Impresos {
    async upload(folder, file, place) {
        let tools = new Tools();
        if ((file.size / 1024) / 1024 > 6) {
            alert("el archivo " + file.name + " es demaciado grande y no pudo ser procesado (max 5mb)");
            return false;
        }
        let b64 = await tools.helpers.fileTo64(file);
        let data = await tools.ajax.fetchData("/api/media/impresos", {
            folder,
            place,
            type: file.type.replace(/\//, "-"),
            name: file.name,
            b64: b64.target.result
        }, 'post');
        return data;
    }
}
