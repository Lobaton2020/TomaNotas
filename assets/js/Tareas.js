// NO USAR JQUERY AQUI, PODRIAN HABER PROBLEMAS POR UNA FUNCION QUE SE HA CREADO, ES LA SEGUNDA
document.getElementById("texto").onkeyup = function() {
    document.querySelector("#caracteres").innerHTML = 100 - this.value.length;
    if (this.value.length == 100) {
        alert("Stop!");
    }
};

function $(d) {
    return document.querySelector(d);
}

function detalleTarea(id) {
    var m = "";
    if ($("#estado" + id).value == 1) {
        m =
            "<span class='border border-success text-success rounded p-2'>Tarea hecha!</span>";
    } else {
        m =
            "<span class='border border-danger text-danger rounded p-2'>Tarea por hacer!</span>";
    }
    $("#descripcion_m").innerHTML = $("#descripcion" + id).value;
    $("#estado_m").innerHTML = m;
    $("#fecha_m").innerHTML =
        getFecha($("#fecha" + id).value) + " " + getTime($("#hora" + id).value);
    $("#btn-elim").setAttribute("href", "?c=tarea&m=delete&id=" + id);
}

function habilitarEdicion(id) {
    var selector = $("#editbox" + id);
    selector.style.display = "block";
    $("#act" + id).style.display = "block";

    selector.onkeyup = function() {
        document.querySelector("#show_num" + id).innerHTML =
            100 - this.value.length < 10 ?
            "0" + (100 - this.value.length) :
            100 - this.value.length;
        if (this.value.length >= 100) {
            alert("Stop!");
        }
        var tes = document.querySelector("#num_char" + id);
        if (this.value.length > 0) {
            tes.removeAttribute("disabled");
        } else {
            tes.setAttribute("disabled", "on");
        }
    };
}

function checkinTarea(id) {
    var estado = null;
    if ($("#estado" + id).value == 1) {
        estado = 0;
    } else {
        estado = 1;
    }

    window.location.href = "?c=tarea&m=updateEstado&id=" + id + "&e=" + estado;
}

function getFecha(fecha) {
    var fecha = fecha.split("-");
    var array = new Array(
        "",
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    );
    var numSinCero = parseInt(fecha[1]);

    return array[numSinCero] + " " + fecha[2] + " del " + fecha[0];
}

function getTime(time) {
    var time = time.split(":");
    var array = [];
    array["00"] = "12 am";
    array["01"] = "1 am";
    array["02"] = "2 am";
    array["03"] = "3 am";
    array["04"] = "4 am";
    array["05"] = "5 am";
    array["06"] = "6 am";
    array["07"] = "7 am";
    array["08"] = "8 am";
    array["09"] = "9 am";
    array["10"] = "10 am";
    array["11"] = "11 am";
    array["12"] = "12 pm";
    array["13"] = "1 pm";
    array["14"] = "2 pm";
    array["15"] = "3 pm";
    array["16"] = "4 pm";
    array["17"] = "5 pm";
    array["18"] = "6 pm";
    array["19"] = "7 pm";
    array["20"] = "8 pm";
    array["21"] = "9 pm";
    array["22"] = "10 pm";
    array["23"] = "11 pm";

    if (array[time[0]] === "1 pm" || array[time[0]] === "1 am") {
        return "A la " + array[time[0]];
    } else {
        return "A las " + array[time[0]];
    }
}

var ajax_req = function() {
    if (ajax.readyState == 4) {
        if (ajax.status == 200) {
            var x = JSON.parse(ajax.responseText);
            $("#numTareas").innerHTML =
                x[1] > 1 ?
                x[1] + " tareas restantes para hoy de " + x[0] + "." :
                x[1] + " tarea restante para hoy de " + x[0] + ".";
        }
    }
};

// uso de ajax para traer el numero de tareas

var ajax = new XMLHttpRequest();
ajax.open("GET", "?c=tarea&m=numTask_ax");
ajax.onreadystatechange = ajax_req;
ajax.send();

window.onload = function() {
    setTimeout(function() {
        $(document).ready(function() {
            $("#alert").alert("close");
        });
    }, 5000);
};