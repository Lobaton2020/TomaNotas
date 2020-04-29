window.onload = function() {
    // esta pendiende del evento y llama una funcion si se encia el form
    if (document.getElementById("form_change_pass")) {
        document
            .getElementById("form_change_pass")
            .addEventListener("submit", validacionChangePass);
    }

    function validacionChangePass(e) {
        if (this.pass1.value == "" || this.pass2.value == "") {
            showAlert("danger", "Debes llenar los campos.");
            e.preventDefault();
        } else if (this.pass1.value != this.pass2.value) {
            showAlert("info", "Las contraseñas no coinciden");
            e.preventDefault();
        } else if (this.pass1.value.length < 5 || this.pass2.value.length < 5) {
            showAlert("info", "Minimo deben tener 5 caracteres la contraseña.");
            e.preventDefault();
        } else {
            //   $(document).ready(function() {
            // $.ajax({
            //     data: "clave=" + this.pass1.value + "&id=" + this.id.value,
            //     url: "?c=usuario&m=updatePass_ax",
            //     type: "post",
            //     beforeSend: function() {
            //         $("#msg_alert").html("Procesando...");
            //     },
            //     success: function(data) {
            //         var data = JSON.parse(data);
            //         console.log(data);
            //         if (data === true) {

            //             showAlert("success", '<span class="text-peque">El la contraseña ha sido cambiada correctamente.</span>');
            //         }
            //     },
            //     error: function() {

            //         $("#msg_alert").html("Hubo un error al cambiar la contraseña");

            //     }

            // });

            var ajax_req = function() {
                if (ajax.readyState == 4) {
                    console.log("oa");
                    if (ajax.status == 200) {
                        if (ajax.responseText === "true") {
                            showAlert(
                                "success",
                                "La contraseña ha sido actualidada correctamente."
                            );
                            document.getElementById("form_change_pass").style.display =
                                "none";
                            document.getElementById("envio1").style.display = "none";
                        } else {
                            showAlert("danger", "La contraseña no se pudo actualizar.");
                        }
                    }
                }
            };

            // uso de ajax para cambiar la contraseña

            var ajax = new XMLHttpRequest();
            ajax.open("post", "?c=usuario&m=updatePass_ax");
            ajax.onreadystatechange = ajax_req;
            ajax.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );
            ajax.send("clave=" + this.pass1.value + "&id=" + this.id.value);

            //   });

            e.preventDefault();
        }
    }
};

// funciona para mortrar un mensaje sencillo
function showAlert(tipo, texto) {
    var mensaje =
        '<div id="alert" class="alert alert-' +
        tipo +
        ' alert-dismissible fade text-peque show" role="alert">';
    mensaje += texto;
    mensaje +=
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    mensaje += '<span aria-hidden="true">&times;</span></button></div>';
    document.getElementById("alert_pass").innerHTML = mensaje;
}