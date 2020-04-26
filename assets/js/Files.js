window.onload = function() {
        $(document).ready(function() {
            setTimeout(function() {
                $("#alert").alert("close");
            }, 5000);


        });
        if (screen.width < 700) {
            $("#active_responsive").attr("class", "table-responsive");
            $("#footer_ver").addClass("fixed-bottom");
        } else {
            $("#active_responsive").attr("class", "");

        }

    }
    // ------------


var archivo = document.getElementsByClassName("eliminar_archivo");
var habilitar_archivo = document.getElementById("eliminar_file");

function comprobacion() {

    if (habilitar_archivo.className == "Cerrar") {

        Elim_File(false);
        habilitar_archivo.className = "Eliminar";
        habilitar_archivo.innerHTML = "Eliminar";
    } else {
        Elim_File(true);
        habilitar_archivo.className = "Cerrar"
        habilitar_archivo.innerHTML = "Cerrar";

    }
    event.preventDefault();
}




Elim_File(false);

function Elim_File(valor) {

    for (let i = 0; i < archivo.length; i++) {
        if (valor) {
            archivo[i].style.display = "block";
        } else {
            archivo[i].style.display = "none";
        }
    }
}


// popovers
$('[data-toggle="popover"]').popover({
    placement: "right",
    trigger: "hover"
});

//  activacion
$('[data-toggle="tool"]').tooltip();


var active_boton = document.getElementById("input-file");

// escoger el inout tipo file
active_boton.addEventListener("change", function(event) {
    var n = event.target.files.length;
    var element = "";
    var tamaño_t = null;
    for (let i = 0; i < n; i++) {

        var name = event.target.files[i].name;
        var tamaño = (event.target.files[i].size * 0.000001) * 1;
        tamaño_t += tamaño;
        element += "<li class='list-group-item'>&bull; " + name + " / <span class='text-info'> " + tamaño.toLocaleString() + " MB</span></li>";
    }
    element += "<li class='list-group-item'> Tamaño del total de <b>" + n + "</b>  archivos: <span class='text-info'> " + tamaño_t.toLocaleString() + " MB</span></li>";

    if (tamaño_t > 15) {
        window.location.href = "?c=archivo&m=subir&cod=E007";
    }

    $(document).ready(function() {

        $("#files").html("<ul class='list-group'>" + element + "</ul>");
        $("#boton_a").removeAttr("disabled").attr("class", "btn btn-success").html(n > 1 ? "Subir Archivos" : "Subir Archivo");
    });
});
$(document).ready(function() {
    $("#boton_a").click(function() {
        $("#boton_a").attr("class", "btn btn-warning").html("Cargando...");
    });
});



function renameFile(id) {
    $(document).ready(function() {
        var value = $("#nombre_archivo" + id).val();
        var ext = $("#extencion" + id).val();
        $("#type").attr("value", ext);
        $("#old_name_file").attr("value", value);
        $("#new_id").attr("value", id);
        $("#new_name_file").attr("value", value);
        $("#alert_a").css("display", "none");

    });
}

$(document).ready(function() {

    $("#guardar_cambios").click(function() {
        var id = $("#new_id").val();
        var value = $("#new_name_file").val();
        var old = $("#old_name_file").val() + "." + $("#type").val();
        if (value === "") {
            alert("Ingresa un nombre para el archivo");
            // preventDefault.location();
        } else {
            value += "." + $("#type").val();

            $.ajax({
                type: "GET",
                url: "?c=archivo&m=renombrar&id=" + id + "&new=" + value + "&old=" + old,
                success: function(data) {
                    if (data) {
                        $("#alert_a").css("display", "").addClass("alert-success");
                        $("#content").html("Nombre de archivo actualizado.");
                        $("#basename" + id).html(value);
                    } else {
                        $("#alert_a").css("display", "").addClass("alert-danger");
                        $("#content").html("No se pudo actualizar el nombre del archivo.");
                    }
                },
                error: function() {
                    $("#alert_a").css("display", "").addClass("alert-danger");
                    $("#content").html("No se pudo actualizar el nombre del archivo.");
                }
            });
        }
    });

    var buscar_archivo = document.getElementById("buscar_archivo");
    buscar_archivo.addEventListener("keyup", function() {

        var valor = buscar_archivo.value;
        $.ajax({
            type: "GET",
            url: "?c=archivo&m=buscar_archivos&value=" + valor,
            success: function(data) {

                $("#resultados_ajax").html(data);
            },
            error: function() {
                $("#resultados_ajax").html("Error! No se pudieron cargar los datos.");

            }
        });

    });

});