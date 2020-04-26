(function() {

    cargarDatos(true);
    window.onload = function() {
        $(document).ready(function() {
            setTimeout(function() {
                $("#alert").alert("close");
            }, 5000);

        });
        mensajeCargando(false);

        eliminacion(false);
        actualizacion(false);
        acciones(false);
        verFecha(false);



    }
    var actualizar = document.getElementsByClassName("actualizacion");
    var eliminar = document.getElementsByClassName("eliminacion");
    var fecha = document.getElementsByClassName("fecha");



    var habilitar_eliminacion = document.getElementById("hab_elim");
    var habilitar_actualizacion = document.getElementById("hab_actu");
    var habilitar_fecha = document.getElementById("hab_fecha");
    var inhabilitacion = document.getElementById("inhab");


    inhabilitacion.addEventListener("click", function() {
        eliminacion(false);
        actualizacion(false);
        acciones(false);
        verFecha(false);
        event.preventDefault();
    });



    habilitar_fecha.addEventListener("click", function() {
        verFecha(true);
        event.preventDefault();
    });

    habilitar_eliminacion.addEventListener("click", function() {
        eliminacion(true);
        acciones(true);

        event.preventDefault();
    });

    habilitar_actualizacion.addEventListener("click", function() {
        actualizacion(true);
        acciones(true);
        event.preventDefault();
    });


    $(function() {
        // popovers
        $('[data-toggle="popover"]').popover({
            placement: "right",
            trigger: "hover"
        });

        //  activacion
        $('[data-toggle="tool"]').tooltip();


    });

    // fecha
    function verFecha(valor) {

        for (let i = 0; i < fecha.length; i++) {
            if (valor) {
                fecha[i].style.display = "";
            } else {
                fecha[i].style.display = "none";
            }
        }
    }

    // funciones de uso de nav de notas
    function eliminacion(valor) {

        for (let i = 0; i < eliminar.length; i++) {
            if (valor) {
                eliminar[i].style.display = "block";
            } else {
                eliminar[i].style.display = "none";
            }
        }
    }

    // actualizacion
    function actualizacion(valor) {

        for (let i = 0; i < actualizar.length; i++) {
            if (valor) {
                actualizar[i].style.display = "block";
            } else {
                actualizar[i].style.display = "none";
            }
        }
    }
    // ocultar opciones de accion
    function acciones(valor) {
        var th1 = document.getElementById("table001");
        var td2 = document.getElementsByClassName("table002");

        if (valor) {
            th1.style.display = "block";
            th1.style.width = "100px";
            for (let i = 0; i < td2.length; i++) {
                td2[i].style.display = "block";
            }
        } else {
            th1.style.display = "none";
            for (let i = 0; i < td2.length; i++) {
                td2[i].style.display = "none";
            }

        }

    }


    //el objeto de ajax
    function getXMLHttpRequest() {
        var ajax = null;
        try {
            ajax = new XMLHttpRequest();
        } catch (error1) {
            try {
                ajax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (error2) {
                console.log("Imposible conectase con AJAX");
                ajax = false;
            }
        }
        return ajax;
    }

    var txt = document.getElementById("search");
    var response_main = document.getElementById("response-ajax-main");
    var response_keyup = document.getElementById("response-ajax-keyup");
    // carga los datos por defecto del servidor
    function cargarDatos(valor) {
        if (valor == true) {

            var ajax = getXMLHttpRequest();
            ajax.open("GET", "index.php?c=link&m=getAll_ax&ver=ok", true);
            ajax.onreadystatechange = function() {

                if (ajax.readyState == 4 && ajax.status == 200) {
                    if (ajax.responseText != "") {
                        response_main.innerHTML = ajax.responseText;
                    } else {

                        response_main.innerHTML = "No se han podido cargar los datos";
                    }
                }

            }
            ajax.send();

        }
        mostrarMensaje(false);
    }
    //---------------------------------------------------------------------------------------------------------------------------------
    // muestra el mensaje que no hay links
    function mostrarMensaje(valor) {
        var msg = document.getElementById("mensaje-ajax");
        if (valor == true) {
            msg.style.display = "block";
        } else {
            msg.style.display = "none";
        }
    }
    // mensaje de cargando
    function mensajeCargando(value) {
        var mensaje = document.getElementById("mensajeCargando");
        if (value) {
            mensaje.style.display = "block";
        } else {
            mensaje.style.display = "none";
        }
    }

    // proceso de ajax para la consulta del formulario



    txt.addEventListener("keyup", function() {
        mensajeCargando(true);
        var ajax = getXMLHttpRequest();
        var valor = txt.value;
        ajax.open("GET", "index.php?c=link&m=search_ax&value=" + valor, true);
        ajax.onreadystatechange = function() {

                if (ajax.readyState == 4 && ajax.status == 200) {
                    cargarDatos(false);
                    mensajeCargando(false);
                    if (ajax.responseText != "") {
                        mostrarMensaje(false);
                        response_keyup.innerHTML = ajax.responseText;
                        response_main.innerHTML = "";
                    } else {
                        mostrarMensaje(true);
                        response_keyup.innerHTML = "";
                    }
                }
            }
            // ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send();
    });



})();