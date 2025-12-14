var actualizar = document.getElementsByClassName("actualizacion");
var eliminar = document.getElementsByClassName("eliminacion");
var compartir = document.getElementsByClassName("compartir");
var fecha = document.getElementsByClassName("fecha");

var modal_compartir = document.getElementsByClassName("modal-compartir");

var habilitar_compartir = document.getElementById("habilitar-compartir");
var habilitar_opciones = document.getElementById("habilitar-opciones");
var habilitar_fecha = document.getElementById("hab_fecha");
var inhabilitacion = document.getElementById("inhab");

var txt = document.getElementById("search");
var response_main = document.getElementById("response-ajax-main");
var response_keyup = document.getElementById("response-ajax-keyup");

var form_search_user = document.getElementById("search-user-link");
var result_user = document.getElementById("result-user");

(function() {
    window.onload = function() {
        $(document).ready(function() {
            setTimeout(function() {
                $("#alert").alert("close");
            }, 5000);
        });

        ejecutarAjaxBusquedaUsuario();
        ejecutarAjaxBusquedaLinks();
        if (cargarDatos(true)) {
            opciones(false);
            acciones(false);
            verFecha(false);
        }
        inhabilitacion.addEventListener("click", function() {
            opciones(false);
            acciones(false);
            verFecha(false);
            event.preventDefault();
        });

        habilitar_compartir.addEventListener("click", function() {
            habilitarCompartir(true);
            acciones(true);
            llamadoModalCompartir();
            event.preventDefault();
        });

        habilitar_fecha.addEventListener("click", function() {
            verFecha(true);
            event.preventDefault();
        });

        habilitar_opciones.addEventListener("click", function() {
            opciones(true);
            acciones(true);

            event.preventDefault();
        });
        $(function() {
            // popovers
            $('[data-toggle="popover"]').popover({
                placement: "right",
                trigger: "hover",
            });

            //  activacion
            $('[data-toggle="tool"]').tooltip();
        });
    };

    function llamadoModalCompartir() {
        for (var i = 0; i < modal_compartir.length; i++) {
            modal_compartir[i].addEventListener("click", function(e) {
                $("#buscar-usuario")
                    .modal("show")
                    .attr("name", this.getAttribute("name"));
            });
        }
    }
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
    function opciones(valor) {
        for (let i = 0; i < eliminar.length; i++) {
            if (valor) {
                actualizar[i].style.display = "block";
                eliminar[i].style.display = "block";
            } else {
                actualizar[i].style.display = "none";
                eliminar[i].style.display = "none";
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

    // ---------------------
    function habilitarCompartir(valor) {
        for (let i = 0; i < compartir.length; i++) {
            if (valor) {
                compartir[i].style.display = "block";
            } else {
                compartir[i].style.display = "none";
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

    // carga los datos por defecto del servidor
    function cargarDatos(valor) {
        if (valor == true) {
            var ajax = getXMLHttpRequest();
            let querySearch = new URLSearchParams(location.search),
                page = 1;
            if (querySearch.has("page")) {
                page = querySearch.get("page");
            }
            const search = `${querySearch.has("search") ? `&search=${querySearch.get("search")}` : ""}`;
            ajax.open("GET", "index.php?c=link&m=getAll_ax&ver=ok&page=" + page + search, true);
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    if (ajax.responseText != "") {
                        response_main.innerHTML = ajax.responseText;
                        mostrarMensaje(false);
                    } else {
                        mostrarMensaje(true);
                    }
                }
                mensajeCargando(false)
            };
            ajax.send();
        }
        
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

    function handleKeyupLinks() {
                const url = new URL(window.location.href);
                url.searchParams.set("search", txt.value);
                if (txt.value == "") {
                    url.searchParams.delete("search");
                }
                window.history.pushState(null, "", url);
                mensajeCargando(true);
                cargarDatos(true);
            }
    function ejecutarAjaxBusquedaLinks() {
        if (document.getElementById("search-user-link")) {
            let idSetTimeout = null;
            txt.addEventListener("keyup", ()=>{
                clearTimeout(idSetTimeout);
                idSetTimeout = setTimeout(handleKeyupLinks, 500);
            });
        }
    }
    // proceso de ajax para la consulta del formulario
    function ejecutarAjaxBusquedaUsuario() {
        if (document.getElementById("search-user-link")) {
            form_search_user.addEventListener("keyup", function() {
                var ajax = getXMLHttpRequest();
                var params = "valor=" + this.value;
                ajax.open("POST", "index.php?c=link&m=searchUserLink_ax", true);
                ajax.onreadystatechange = procesoHttpBusquedaUsuario;
                ajax.setRequestHeader(
                    "Content-type",
                    "application/x-www-form-urlencoded"
                );
                ajax.send(params);
            });
        }
    }

    function procesoHttpBusquedaUsuario() {
        if (this.readyState == 4 && this.status == 200) {
            var data;
            if (typeof this.responseText !== "undefined") {
                data = JSON.parse(this.responseText);
            } else {
                data = this.responseText;
            }
            console.log(data);
            var id_link = $("#buscar-usuario").attr("name");
            var showUser = "";
            for (let i = 0; i < data.length; i++) {
                showUser +=
                    '<div class="simulacion-option py-2 mt-2" idl="' +
                    id_link +
                    '" idu="' +
                    data[i].id_usuario_PK +
                    '">';
                showUser += '<a class="text-decoration-none" href="#">';
                showUser +=
                    '<span class="h6 ml-2">' +
                    data[i].nombre +
                    " " +
                    data[i].apellido +
                    "</span>";
                showUser += "</a>";
                showUser +=
                    "<span class='small mr-2 float-right text-muted'>" +
                    data[i].nickname +
                    "</span>";
                showUser += "</div>";
            }
            result_user.innerHTML = showUser;
            habilitarCompartirLink();
        }
    }

    function habilitarCompartirLink() {
        var num = document.getElementsByClassName("simulacion-option");

        for (let i = 0; i < num.length; i++) {
            num[i].addEventListener("click", function() {
                var id_usuario = this.getAttribute("idu");
                var id_link = this.getAttribute("idl");

                window.location.href =
                    "?c=link&m=newShareLink&idusuario=" +
                    id_usuario +
                    "&idlink=" +
                    id_link;
            });
        }
    }

    if (document.getElementsByClassName("ver-modal-link")) {
        var numero = document.getElementsByClassName("ver-modal-link");
        for (let i = 0; i < numero.length; i++) {
            numero[i].addEventListener("click", function(e) {
                $("#ver-link").modal("show");
                $("#modal-a").attr("href", this.href);
                $("#result-link").html(this.href);
                e.preventDefault();
            });
        }
    }
})();
// For global use
function updateSearchAndRedirect(baseUrl, event) {
    event.preventDefault();
    const searchInput = document.querySelector('#search');
    let finalUrl = baseUrl;
    if (searchInput && searchInput.value.trim()) {
        const searchValue = encodeURIComponent(searchInput.value.trim());
        finalUrl += '&search=' + searchValue;
    }
    window.location.href = finalUrl;
}