import vars from "../libs/laurel/js/vars.js";

export default {
    url: vars.urlApi,
    optionsRequest: function(data) {
        return {
            method: "POST",
            body: data
        }
    },
    create: async function(datos) {
        try {
            const response = await fetch(this.url + "rols/store", this.optionsRequest(datos));
            const result = await response.json();
            return result.response.ok == 200 ? true : result.response.type;
        } catch (err) {
            console.error(err)
        }
    },
    list: async function() {
        try {
            const response = await fetch(this.url + "rols");
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },
    get: async function(id) {
        try {
            const response = await fetch(this.url + `rols/get/${id}`);
            const result = await response.json();
            return result;
        } catch (err) {
            console.error(err)
        }
    },
    update: async function(datos) {
        try {
            const response = await fetch(this.url + `rols/update`, this.optionsRequest(datos));
            const result = await response.json();
            return result.response.ok == 200 ? true : result.response.type;
        } catch (err) {
            console.error(err)
        }
    },

    delete: async function(datos) {
        try {
            const response = await fetch(this.url + `rols/delete`, this.optionsRequest(datos));
            const result = await response.json();
            return result.response.ok == 200 ? true : result.response.type;
        } catch (err) {
            console.error(err)
        }
    },



};