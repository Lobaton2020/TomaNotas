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
        t.innerHTML = " - Semana " + weekNumber+" - <small>"+ parseInt(weekNumber * 100 / 52) + "%</small>";
    } catch (err) {
        console.log("[ERROR_SET_WEEK_NUMBER]", err)
    }

}

function requestHttp(method, url) {
    return new Promise(resolve => {

        let http = new XMLHttpRequest();
        http.addEventListener("load", async (event) => {
            return resolve(JSON.parse(event.currentTarget.responseText));
        });
        http.open(method, url)
        http.send(null);
    })
}

function renderTimeSelect() {
    let element = document.querySelector("#hora");
    for (let i = 0; i <= 24; i++) {
        let number = i,
            option = document.createElement("option");
        option.value = number;
        option.textContent = number;
        if (i === 12) {
            option.selected = "on";

        }
        element.appendChild(option);
    }
}
function textToSpeech(text) {
    return new Promise((resolve) => {
        const voices = window.speechSynthesis.getVoices();
        const voice = voices.findIndex(voice => voice.lang === 'en-HK');
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.voice = voices[voice + 1];
        utterance.addEventListener('end', () => resolve(true))
        window.speechSynthesis.speak(utterance);
    })

}
function renderNotificationSound(title, description) {
    let notification;
    let options = {
        "body": description,
        "icon": "assets/img/logo.png"
    };
    if (Notification.permission === "granted") {
        notification = new Notification(title, options)
        window.audio.play();
        notification.addEventListener("click", closeNotification);
        notification.addEventListener("close", closeNotification);
        setTimeout(closeNotification, 60 * 1000)
    } else {
        Notification.requestPermission((permiso) => {
            if (permiso === "granted") {
                notification = new Notification(title, options);
                window.audio.play();
                notification.addEventListener("click", closeNotification);
                notification.addEventListener("close", closeNotification);
                setTimeout(closeNotification, 60 * 1000)
            }
        });
    }
}

function closeNotification(event) {
    try {
        event?.currentTarget?.close()
    } catch (err) {
        console.error("ERROR_EVENTO_DESENCADENADO", err)
    }
    audio.pause();
    elemTaskId.classList.remove("active-action")

}

async function activeAlarms(data, title, username) {
    let currentDate = new Date();
    let dateTask = new Date();
    if (localStorage.getItem("isDebug")) {
        console.log("+1")
    }
    for (const elem of data) {
        let {
            id_tarea_cronograma_PK,
            descripcion,
            hora,
            minuto
        } = elem;
        dateTask.setHours(hora, minuto, 0);
        if (localStorage.getItem("isDebug")) {
            console.log(dateTask.getTime() == currentDate.getTime(), dateTask.getTime(), currentDate.getTime())
        }
        if (dateTask.getTime() == currentDate.getTime()) {
            await textToSpeech(`
                Hi ${username}.
                You have a task: ${descripcion}`
            )
            renderNotificationSound(descripcion, "Tienes un deber!");
            window.elemTaskId = document.querySelector(`#task-id-${id_tarea_cronograma_PK}`);
            elemTaskId.classList.add("active-action")
            elemTaskId.addEventListener("click", closeNotification)
        }
    }
}

const initialize = async () => {
    window.audio = document.createElement("audio")
    window.audio.src = "assets/audio/rington-mario-bros.mp3";
    window.audio.volume = 0.4;
    window.audio.loop = true
    setWeekNumber();
    renderTimeSelect();
    textToSpeech("");
    const url_backend = '?c=project&format=json&status=1';
    $.get(url_backend, (data) => {
        const string = data.reduce((acc, act) => `<option ${act.name.toLowerCase().includes("default") ? "selected":""} value="${act.id}">${act.name}</option>` + acc, '')
        $("#project_id").html(`<option value="">None</option>${string}`)
    })

    const url = new URLSearchParams(location.search)
    let { username, data, titulo } = await requestHttp("GET", `?c=cronograma&m=getTareasJSON&id=${url.get("id")}`)
    setInterval(() => activeAlarms(data, titulo.titulo, username), 1000);


}

function handleClickInitMoveTask(e) {
    $('[name="id_cronograma_fuente"]').val(e.target.dataset.id_cronograma_fuente)
    $('[name="id_tarea"]').val(e.target.dataset.id_tarea)
    $("#move-task-to-other-cronograma").modal("show")
}
function handleChangeCronograma(e) {
    $('[name="id_cronograma_destino"]').val(e.target.value)
}
document.addEventListener("DOMContentLoaded", initialize)
