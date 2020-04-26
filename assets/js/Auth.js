window.onload = function() {
    $(document).ready(function() {
        setTimeout(function() {
            $("#alert").alert("close");
        }, 10000);
    });
    var get = document.getElementById("getURL").value;
    if (get != "" && get == "A001") {
        $(document).ready(function() {
            $("#registro_user").html('<a href="?c=auth" class="btn btn-lg btn-primary btn-block text-uppercase">Iniciar Sesion</a>');

        });
    }


}



function enviar(event) {
    var clave1 = document.getElementById("clave").value;
    var clave2 = document.getElementById("clave_confirmar").value;
    var fecha = document.getElementById("fecha_nacimiento").value;

    var fecha_a = new Date();
    fecha = fecha.split("-");

    if (fecha[0] >= (fecha_a.getFullYear() - 5) || fecha[0] < (fecha_a.getFullYear() - 120)) {

        showAlert("danger", 'La fecha que ingresaste no es valida.');
        event.preventDefault();

    } else {
        if (clave1.length < 5) {

            showAlert("warning", 'Debes ingresar minimo 5 caracteres en la contraseña.');
            event.preventDefault();

        } else {
            if (clave1 != clave2) {

                showAlert("warning", 'Las contraseñas no coinciden.');
                document.getElementById("clave").value = "";
                document.getElementById("clave_confirmar").value = "";


                event.preventDefault();
            } else

                $(document).ready(function() {

                $.ajax({
                    data: $("#registro_user").serialize(),
                    url: "?c=auth&m=insert",
                    type: "post",
                    beforeSend: function() {
                        $("#msg_alert").html("Procesando...");
                    },
                    success: function(data) {
                        var data = JSON.parse(data);

                        if (data.response === true) {

                            showAlert("success", '<span class="text-peque">El usuario ha sido agregado correctamente.</span>');
                            $("#registro_user").html('<a href="?c=auth" class="btn btn-lg btn-primary btn-block text-uppercase">Iniciar Sesion</a>');

                        } else if (data.response == "bad_email") {

                            showAlert("danger", 'El correo que ingresaste no es valido. ');

                        } else {

                            showAlert("danger", 'El usuario que intentas registrar ya existe. ');

                        }

                    },
                    error: function() {

                        $("#msg_alert").html("Hubo un error al registrar el usuario");

                    }

                });
            });
            event.preventDefault();

        }

    }
}


function showAlert(tipo, texto) {

    var mensaje = '<div id="alert" class="alert alert-' + tipo + ' alert-dismissible fade text-peque show" role="alert">';
    mensaje += texto;
    mensaje += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    mensaje += '<span aria-hidden="true">&times;</span></button></div>';
    $("#msg_alert").html(mensaje);
}


var registro = document.getElementById("registro_user");

registro.addEventListener("submit", enviar);