class Ajax extends Helpers {
    ajaxConnect() {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        }
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        return xmlhttp;
    }

    simple_cURL(args) {
        if (!navigator.onLine) {
            return this.onFail('No internet');
        }
        var xmlhttp = this.ajaxConnect();
        var response = '';
        args = this.onStart(args);
        if (args.callback != undefined || args.callback != null) {
            this.onEnd = args.callback;
        }
        xmlhttp.onreadystatechange = (ev) => {
            this.onLoad(xmlhttp);
            if (xmlhttp.status >= 400 && xmlhttp.readyState == 4) {
                this.onFail(xmlhttp);
            }
            else if (xmlhttp.readyState == 4) {
                this.data = this.onEnd(xmlhttp.response);
            }
        }
        xmlhttp.open(args.method, args.url, args.asinc);
        for (let index in args.header) {
            let header = args.header[index];
            xmlhttp.setRequestHeader(index, header);
        }
        xmlhttp.send(args.parameters);
        return this.data;
    }
    /**
     * @param path, {object} parameters,{function} response, method,asinc */
    postData(path = {}, parameters = {}, response = null, method = "GET",
        asinc = true, header = {
            "Content-type": "application/x-www-form-urlencoded"
        }) {

        if (header['Content-Type'] == "application/json") {
            parameters = JSON.stringify(parameters);
        }
        else {
            parameters = this.objectToSerialize(parameters);
            if (method.toLowerCase() == 'get') {
                path += '?' + parameters;
                parameters = '';
            }
        }
        let args = {
            method,
            url: path,
            header,
            asinc,
            parameters: parameters,
            callback: response,
        };
        let result = this.simple_cURL(args);
        return result;
    }
    /**
     * @param path */
    import (path) {
        let content = ''
        if (localStorage.getItem(path) == null) {
            content = this.postData(path, {}, (ev) => {
                return ev;
            }, 'get', false);
            localStorage.setItem(path, content);
        }
        return localStorage.getItem(path);
    }

    onStart(args = null) {
        //console.log("crea tu propio metodo, ajax.onStart=tuFuncion estas son las variables ", args);
        return args;
    }

    onLoad(result) {
        //console.log("crea tu propio metodo, ajax.onLoad=tuFuncion esta es la respuesta", result);
        return result;
    }

    onEnd(response) {
        //console.log("este se dispara cuando termino el request ajax.OnEnd=tuFuncion, crea el tuyo", response);
        return response;
    }

    onFail(msg) {
        return this.error(msg);
    }
    async fetchData(path, parameters = {}, method = "get") {
        parameters = this.objectToSerialize(parameters);

        let args = {
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }
        if (method.toLowerCase() == 'get') {
            path += '?' + parameters;
            parameters = '';
        }
        else {
            args.body = parameters;
        }
        args.method = method;
        //debugger;
        let data = await fetch(path, args);

        return await data.json();


    }
}
