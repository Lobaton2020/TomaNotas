window.onload = function() {

        var mo = document.getElementsByClassName("muestra_nota");

        for (var i = 0; i < mo.length; i++) {
            if (mo[i].innerHTML.length > 100) {

                var porcen = mo[i].innerHTML.length * 0.5;
                mo[i].innerHTML = mo[i].innerHTML.substr(0, parseInt(porcen));
                mo[i].innerHTML = mo[i].innerHTML += "...";
            }
        }


        $(document).ready(function() {
            setTimeout(function() {
                $("#alert").alert("close");
            }, 5000);


        });
        if (screen.width < 700) {
            $("#active_responsive").attr("class", "table-responsive");
        } else {
            $("#active_responsive").attr("class", "");

        }
        init();
    }
    // ------------

// ----------------
function resizeTextarea(id) {
    var a = document.getElementById(id);

    a.style.height = 'auto';
    a.style.height = a.scrollHeight + 'px';
}

function init() {
    var e = document.getElementsByClassName("size_js");

    for (let i = 0; i < e.length; i++) {
        if (e[i].getAttribute('data-resizable') == 'true')

            resizeTextarea("size_js" + (i + 1));
    }

}

// --------
function getNota(id) {
    $(document).ready(function() {

        var titulo = $("#titulo" + id).val();
        // var descripcion = document.getElementById("descripcion" + id).textContent;
        var descripcion = $("#descripcion" + id).val();
        var fecha = $("#fecha" + id).val();
        var color = $("#color" + id).val()
        $("#id_nota").attr("value", id);
        $("#titulo_nota").html(titulo);
        $("#descripcion").html("<textarea class='form-control  text-peque border_none modal_nota' disabled >" + descripcion + "</textarea>");

        $("#fecha").html(fecha);

        $("#form_titulo").html("");
        $("#form_color").html("");
        $("#titulo_n").attr("value", titulo);
        $("#descripcion_n").attr("value", descripcion);
        $("#fecha_n").attr("value", fecha);
        $("#color_n").attr("value", color);

        $("#editar_nota").css("display", "block");
        $("#eliminar_nota").css("display", "block");

        // $("#cancelar").css("display", "none");
        $("#fecha").css("display", "block");
        $("#actualizar").css("display", "none");


    });
}


$("#editar_nota").click(function() {
    $(document).ready(function() {


        var titulo = $("#titulo_n").val();
        var descripcion = $("#descripcion_n").val();
        let color = $("#color_n").val();
        var form_title = "<small class='text-muted'>Actualiza el titulo<small>";
        form_title += "<textarea rows=1 class='form-control text-peque size_title' name='new_titulo'>" + titulo + "</textarea>";

        var form_descripcion = "<small class='text-muted'>Actualiza la descripcion<small>";
        form_descripcion += "<textarea class='form-control text-peque size_content ' name='nueva_descripcion'>" + descripcion + "</textarea>";
        let form_color = `
                <div class="form-group">
                <small>Establece un color</small>
                <input type="color" rows=1 class="form-control text-peque " name='color' value="${color ? color : "#ffffff"}" placeholder="Color"></textarea>
            </div>
        `
        $("#titulo_nota").html("Editar Nota");
        $("#form_titulo").html(form_title);
        $("#form_color").html(form_color);
        $("#descripcion").html(form_descripcion);

        $("#editar_nota").css("display", "none");
        $("#eliminar_nota").css("display", "none");


        $("#actualizar").css("display", "block");
        $("#fecha").css("display", "none");




        $("#cancelar").click(function() {
            $("#editar_nota").css("display", "block");
            $("#eliminar_nota").css("display", "block");


            $("#actualizar").css("display", "none");

        });

    });
});


function eliminarNota() {
    window.location.href = "?c=nota&m=delete&id=" + $("#id_nota").val();
}