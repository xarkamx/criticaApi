class PostsController {
    constructor() {
        this.tools = new Tools();
    }
    async getPosts(search = "") {
        let url = "/api/places/0/posts";
        search = (search == "") ? {} : { search };
        let result = await this.tools.ajax.fetchData(url, search, 'get');
        return result;
    }
    addPostToHome(id) {
        let _token = this.tools.helpers.getBodyToken();
        let url = "/api/home"
        return new Promise((load, fail) => {
            this.tools.ajax.postData(url, { id, _token }, (ev) => {
                load(ev);
            }, "post")
        });
    }
    async getHomePosts(placeID) {
        let url = "/api/home";
        let result = await this.tools.ajax.fetchData(url, { placeID }, 'get');
        return result;
    }
    removePostFromHome(id) {
        let _token = this.tools.helpers.getBodyToken();
        let url = "/api/home"
        return new Promise((load, fail) => {
            this.tools.ajax.postData(url, { id, _token, _method: "delete" }, (ev) => {
                load(ev);
            }, "post")
        });
    }
    orderPostsInHome(id, orden) {
        let _token = this.tools.helpers.getBodyToken();
        let url = "/api/home/order"
        return new Promise((load, fail) => {
            this.tools.ajax.postData(url, { id, _token, orden, _method: "put" }, (ev) => {
                load(ev);
            }, "post")
        });
    }
    async getPostByCategory(placeID = 0, category) {
        let path = "/api/posts/" + placeID + "/category/name"
        let result = await this.tools.ajax.fetchData(path, { category });
        return result;
    }
    async addPostToPliego(placeID, postID, pliego) {
        let path = "/api/media/impresos/posts";
        let result = await this.tools.ajax.fetchData(path, {
                pliego,
                postID,
                placeID
            },
            "post");
        return result;
    }
    async removePostFromPliego(postID, pliego) {
        let path = "/api/media/impresos/posts";
        let result = await this.tools.ajax.fetchData(path, {
                pliego,
                postID
            },
            "delete");
        return result;
    }
    async getLinkedPosts(pliego) {
        let url = "/api/media/impresos/posts";
        let result = await this.tools.ajax.fetchData(url, { pliego });
        return result;
    }
}
