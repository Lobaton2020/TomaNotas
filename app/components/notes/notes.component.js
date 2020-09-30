import NoteService from "../../services/note.service.js";
(function(window, document) {
    "use strict"
    document.addEventListener("DOMContentLoaded", (e) => {
        window.laurel.component('note', {
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
            disable: async function(id) {
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