window.onload = function() {

        var mo = document.getElementsByClassName("muestra_nota");

        for (var i = 0; i < mo.length; i++) {
            var text = mo[i].value !== undefined ? mo[i].value : mo[i].textContent;
            if (text && text.length > 100) {
                var porcen = text.length * 0.5;
                mo[i].value = text.substr(0, parseInt(porcen)) + "...";
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
function decodeNotaValue(raw) {
    if (raw === null || raw === undefined) return "";
    try {
        var parsed = JSON.parse(raw);
        if (typeof parsed === "string") return parsed;
    } catch (e) { }
    return String(raw);
}

function setTextareaHTML(target, value, extraClass) {
    var $t = $(target);
    $t.empty();
    var ta = document.createElement("textarea");
    ta.className = "form-control text-peque border_none modal_nota" + (extraClass ? " " + extraClass : "");
    ta.disabled = true;
    ta.value = value == null ? "" : String(value);
    $t.append(ta);
}

function getNota(id) {
    $(document).ready(function() {

        var titulo = decodeNotaValue($("#titulo" + id).val());
        var descripcion = decodeNotaValue($("#descripcion" + id).val());
        var fecha = decodeNotaValue($("#fecha" + id).val());
        var color = decodeNotaValue($("#color" + id).val());
        $("#id_nota").attr("value", id);
        $("#titulo_nota").text(titulo);
        setTextareaHTML("#descripcion", descripcion, "modal_nota_view");

        $("#fecha").text(fecha);

        $("#form_titulo").empty();
        $("#form_color").empty();
        $("#titulo_n").attr("value", titulo);
        $("#descripcion_n").attr("value", descripcion);
        $("#fecha_n").attr("value", fecha);
        $("#color_n").attr("value", color);

        $("#editar_nota").css("display", "block");
        $("#eliminar_nota").css("display", "block");

        $("#fecha").css("display", "block");
        $("#actualizar").css("display", "none");


    });
}


$("#editar_nota").click(function() {
    $(document).ready(function() {


        var titulo = decodeNotaValue($("#titulo_n").val());
        var descripcion = decodeNotaValue($("#descripcion_n").val());
        let color = decodeNotaValue($("#color_n").val());
        $("#form_titulo").empty();
        var labelTitulo = document.createElement("small");
        labelTitulo.className = "text-muted";
        labelTitulo.textContent = "Actualiza el titulo";
        var taTitulo = document.createElement("textarea");
        taTitulo.rows = 1;
        taTitulo.className = "form-control text-peque size_title";
        taTitulo.name = "new_titulo";
        taTitulo.value = titulo;
        $("#form_titulo").append(labelTitulo).append(taTitulo);

        $("#descripcion").empty();
        var labelDesc = document.createElement("small");
        labelDesc.className = "text-muted";
        labelDesc.textContent = "Actualiza la descripcion";
        var taDesc = document.createElement("textarea");
        taDesc.className = "form-control text-peque size_content";
        taDesc.name = "nueva_descripcion";
        taDesc.value = descripcion;
        $("#descripcion").append(labelDesc).append(taDesc);

        $("#form_color").empty();
        var colorGroup = document.createElement("div");
        colorGroup.className = "form-group";
        var labelColor = document.createElement("small");
        labelColor.textContent = "Establece un color";
        var inputColor = document.createElement("input");
        inputColor.type = "color";
        inputColor.className = "form-control text-peque";
        inputColor.name = "color";
        inputColor.value = color ? color : "#ffffff";
        colorGroup.appendChild(labelColor);
        colorGroup.appendChild(inputColor);
        $("#form_color").append(colorGroup);

        $("#titulo_nota").text("Editar Nota");

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