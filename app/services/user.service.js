import vars from "../libs/laurel/js/vars.js";

export default {
    url: vars.urlApi,
    optionsRequest: function(data) {
        return {
            method: "POST",
            body: data
        }
    },
    validate: async function(datos) {
        try {
            const response = await fetch(this.url + "auth/login", this.optionsRequest(datos));
            const result = await response.json();
            return result.response.type == "logged" ? true : false;
        } catch (err) {
            console.error(err)
        }
    },
    create: async function(datos) {
        try {
            const response = await fetch(this.url + "users/store", this.optionsRequest(datos));
            const result = await response.json();
            return result.status == 200 ? true : result.response.type;
        } catch (err) {
            console.error(err)
        }
    },
    update: async function(datos, id) {
        try {
            const response = await fetch(this.url + `user/update/text/${id}`, this.optionsRequest(datos));
            const result = await response.json();
            return result.response.ok == 200 ? true : result.response.type;
        } catch (err) {
            console.error(err)
        }
    },
    get: async function(id) {
        try {
            const response = await fetch(this.url + `users/edit/${id}`);
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },
    see: async function() {
        try {
            const response = await fetch(this.url + `auth/see`);
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },

    users: async function(name) {
        try {
            const response = await fetch(this.url + `user/users/${name}`);
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },
    list: async function(page) {
        try {
            const response = await fetch(this.url + `users?page=${page}`);
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },
    listRoles: async function() {
        try {
            const response = await fetch(this.url + "rol/all");
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },
    disable: async function(data) {
        try {
            const response = await fetch(this.url + "users/disable", this.optionsRequest(data));
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },
    enable: async function(data) {
        try {
            const response = await fetch(this.url + "users/enable", this.optionsRequest(data));
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    }

};