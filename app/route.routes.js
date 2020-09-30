(function(window, document) {
    document.addEventListener("DOMContentLoaded", () => {
        window.laurel.getBy(laurel.mainView).router()
            .route("/", ["home"], null, () => {
                // window.location.hash = "#/links";
            })
            .route("/error404", ["error404"], null, null, true)
            // .route("/error500", ["error500"], null, null, true)
            .route("/links", ["create-link", "links"], 'link', function() {
                laurel.getComponent().list();
            })
            .route("/users", ["users"], 'user', function() {
                laurel.getComponent().list();
            })
            .route("/notes", ["notes"], 'note', function() {
                // laurel.getComponent().list();
            })
            .route("/tasks", ["tasks"], 'task', function() {

                // laurel.getComponent().list();
            })

    });
})(window, document);