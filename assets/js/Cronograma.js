// script del modlulo de cronogramas
if (document.getElementsByClassName("checkbox")) {
    setTimeout(function() {
        $(document).ready(function() {
            $("#alert").alert("close");
        });
    }, 5000);
    var checkboxList = document.getElementsByClassName("checkbox");
    for (i = 0; i < checkboxList.length; i++) {
        document
            .getElementById("check" + i)
            .addEventListener("change", function(e) {
                var id = this.getAttribute("ide");
                var checked = this.checked === true ? 1 : 0;
                var cronograma = document.getElementById("idcronograma").value;
                window.location.href =
                    "?c=cronograma&m=cambiarEstado&idcronograma=" +
                    cronograma +
                    "&idtarea=" +
                    id +
                    "&estado=" +
                    checked;
            });
    }

    var tasksList = document.getElementsByClassName("update-task");
    for (i = 0; i < tasksList.length; i++) {
        document
            .getElementById("update-task-" + i)
            .addEventListener("click", function(e) {
                var indice = this.getAttribute("ide");
                var idtarea = $("#" + indice + "id-tarea-cronograma").val();
                var idcronograma = $("#" + indice + "id-cronograma").val();
                var hora = $("#" + indice + "hora").val();
                var minuto = $("#" + indice + "minuto").val();
                var meridiano = $("#" + indice + "meridiano").val();
                var descripcion = $("#" + indice + "descripcion").val();
                var project_id = $("#" + indice + "project_id").val();
                minuto = minuto == 0 ? "00" : minuto;
                $("#update-tarea-cronograma").val("updateTareaCronograma");
                $("#idtarea").val(idtarea);
                $("#hora").val(hora);
                $("#minuto").val(minuto);
                $("#meridiano").val(meridiano);
                $("#descripcion").val(descripcion);
                $("#project_id").val(project_id);

                $("#btn-update-task")
                    .removeClass("btn-success")
                    .addClass("btn-warning")
                    .html("<i class='fas fa-edit'></i>");

                e.preventDefault();
            });
    }
}
if (document.getElementsByClassName("update-title")) {
    var titleList = document.getElementsByClassName("update-title");
    for (i = 0; i < titleList.length; i++) {
        document
            .getElementById("update-title-" + i)
            .addEventListener("click", function(e) {
                var idcronograma = this.getAttribute("ide");
                var titulo = this.getAttribute("title");
                let date = this.getAttribute("date")

                $("#titulo-modal").html("Actualiza el titulo");
                $("#update-title-cronograma").val("updateTitleCronograma");
                $("#idcronograma").val(idcronograma);
                $("#titulo").val(titulo);
                $("#date").val(date.split(" ").at(0));
                e.preventDefault();
            });
    }
}
function getWeekNumber(date) {
    const target = new Date(date);
    target.setHours(0, 0, 0);
    target.setDate(target.getDate() + 4 - (target.getDay() || 7));

    const yearStart = new Date(target.getFullYear(), 0, 1);
    const diff = (target - yearStart) / 86400000;
    const weekNumber = 1 + Math.floor(diff / 7);

    return weekNumber;
}

function setWeekNumber() {
    try {
        const today = new Date();
        const weekNumber = getWeekNumber(today);
        const t = document.querySelector("#week-number");
        t.textContent = " - Semana " + weekNumber;
    } catch (err) {
        console.log("[ERROR_SET_WEEK_NUMBER]", err)
    }

}

const initialize = () => {
    setWeekNumber();
    $.get('?c=project&format=json&status=1', (data) => {
        const string = data.reduce((acc, act) => `<option ${act.name.toLowerCase().includes("default") ? "selected":""} value="${act.id}">${act.name}</option>` + acc, '')
        $("#project_id").html(`<option value="">None</option>${string}`)
    })
}
document.addEventListener("DOMContentLoaded", initialize)