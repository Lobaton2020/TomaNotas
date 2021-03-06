import HomeService from "../../services/home.service.js";
(function(window, document) {
    "use strict"
    document.addEventListener("DOMContentLoaded", (e) => {
        window.laurel.component('home', {
            create: async function(form) {
                try {
                    laurel.renderLoader(true);
                    // 
                    laurel.renderLoader(false);
                } catch (err) {
                    console.error(err)
                }
            },
            list: async function() {
                try {
                    laurel.renderLoader(true);
                    // 
                    laurel.renderLoader(false);
                } catch (err) {
                    console.error(err)
                }
            },
            edit: async function(id) {
                try {
                    laurel.renderLoader(true);
                    // 
                    laurel.renderLoader(false);
                } catch (err) {
                    console.error(err)
                }
            },
            update: async function(form) {
                try {
                    laurel.renderLoader(true);
                    // 
                    laurel.renderLoader(false);
                } catch (err) {
                    console.error(err)
                }
            },
            delete: async function(id) {
                try {
                    laurel.renderLoader(true);
                    // 
                    laurel.renderLoader(false);
                } catch (err) {
                    console.error(err)
                }
            }
        });
    });
})(window, document);