<?php require_once "helpers/obtener_Fechas.php"; ?>
<?php require_once "views/template/dashboard/errorHandler.php" ?>

<?php showMessage("success-insert-tarea", "success"); ?>
<?php showMessage("error-insert-tarea", "danger"); ?>
<style>
    .order-task {
        border-radius: 10px;
        margin: 2px 0;
        padding: 1px;
    }

    .active-action {
        background-color: #ccc;
        border-radius: 10px;
        margin: 2px 0;
        padding: 5px;
        animation: activeText;
        animation-duration: 1.5s;
        animation-iteration-count: infinite;
    }

    @keyframes activeText {
        0% {
            background-color: #ccc;
        }

        50% {
            background-color: #fff;
        }

        100% {
            background-color: #ccc;
        }
    }
</style>
<form class="mb-2 mt-n2" method="post">
    <input type="hidden" name="c" value="cronograma">
    <input type="hidden" id="update-tarea-cronograma" name="m" value="createTareaCronograma">
    <input type="hidden" name="idcronograma" id="idcronograma" value="<?php echo $_GET["id"] ?>">
    <input type="hidden" id="idtarea" name="idtarea">
    <input type="hidden" name="meridiano" value="pm">
    <div class="row">
        <div class="col-sm-12 col-md-2 ">
            <select id="hora" class="section-option   d-inline " name="hora">

            </select>
            <select id="minuto" class="section-option d-inline" name="minuto">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>

            </select>
            <span class="h6 float-right logo_peque mr-3 mt-2"><?php echo $titulo->titulo ?></span>
        </div>
        <div class="col-sm-12 col-md-10 d-inline margen">
            <input id="descripcion" type="text" required class="form-control d-inline  width-form-add-task" name="contenido-tarea" placeholder="Escribe tu tarea?">
            <button id="btn-update-task" type="submit" class="btn btn-success float-right "><i class="fas fa-plus"></i></button>
        </div>
    </div>

</form>

<div class="mt-1 mb-3">
    <div class="border mb-2 pr-0 pl-0 pt-3 pb-0 ">
        <div class="text-center   ">
            <h5>Tus Tareas de hoy
                <a class="float-right mr-4" id="actions_publication" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v small"></i></a>
                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="#actions_publication">
                    <h6 class="dropdown-header">Opciones</h6>
                    <a class="dropdown-item small" onclick="javascript:return confirm('¿Estas seguro de eliminar todas tus tareas?')" href="?c=cronograma&m=eliminarTareasCronograma&idcronograma=<?php echo $_GET["id"] ?>"><i class="fas fa-trash"></i> Vaciar tareas </a>
                    <a class="dropdown-item small" onclick="javascript:return confirm('¿Estas seguro de reiniciar todas tus tareas?')" href="?c=cronograma&m=reiniciarTareasCronograma&idcronograma=<?php echo $_GET["id"] ?>"><i class="fas fa-redo-alt"></i> Reiniciar </a>
                </div>
            </h5>
        </div>
        <div class="card-body">
            <div class="mt-n3">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <?php if (count($response) == 0) { ?><div class=text-center>No hay contenido por mostrar</div><?php } ?>
                        <?php for ($i = 0; $i < count($response); $i++) : ?>
                            <?php if ($i != 0): ?>
                                <hr class="my-0 mx-5 ">
                            <?php endif; ?>
                            <?php $minuto = ($response[$i]->minuto == 0) ? "00" : $response[$i]->minuto; ?>
                            <?php $time = $response[$i]->hora . " : " . $minuto; ?>

                            <?php $check = ($response[$i]->estado == 1) ? "checked" : ""; ?>
                            <div id="task-id-<?php echo $response[$i]->id_tarea_cronograma_PK ?>" class="row order-task ">
                                <div class="col-10" style="margin-top:2px;">
                                    <span class="custom-control ml-n2 mr-n2 custom-switch d-inline">
                                        <input type="checkbox" <?php echo $check; ?> ide="<?php echo $response[$i]->id_tarea_cronograma_PK; ?>" class="custom-control-input checkbox" id="check<?php echo $i; ?>">
                                        <label class="custom-control-label" for="check<?php echo $i; ?>"></label>
                                    </span>
                                    <?php if ($check === "checked") : ?>
                                        <s><i>
                                                <span class="text-muted"> <?php echo $time; ?> </span>&bull; <span><?php echo $response[$i]->descripcion; ?></span>
                                            </i></s>
                                    <?php else : ?>
                                        <span class="text-muted"> <?php echo $time; ?> </span>&bull; <span><?php echo $response[$i]->descripcion; ?></span>

                                    <?php endif; ?>
                                </div>
                                <div class="col-2 align-self-center mx-auto mr-n3 align-right">
                                    <a href="" class="float-right  text-dark" id="settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="#settings">
                                        <h6 class="dropdown-header">Opciones</h6>
                                        <input type="hidden" id="<?php echo $i; ?>id-cronograma" value="<?php echo $_GET["id"] ?>">
                                        <input type="hidden" id="<?php echo $i; ?>id-tarea-cronograma" value="<?php echo $response[$i]->id_tarea_cronograma_PK ?>">
                                        <input type="hidden" id="<?php echo $i; ?>hora" value="<?php echo $response[$i]->hora ?>">
                                        <input type="hidden" id="<?php echo $i; ?>minuto" value="<?php echo $response[$i]->minuto ?>">
                                        <input type="hidden" id="<?php echo $i; ?>meridiano" value="<?php echo $response[$i]->meridiano ?>">
                                        <input type="hidden" id="<?php echo $i; ?>descripcion" value="<?php echo $response[$i]->descripcion ?>">
                                        <a class="dropdown-item small update-task" id="update-task-<?php echo $i; ?>" ide="<?php echo $i; ?>" href=""><i class="fas fa-edit"></i> Editar </a>
                                        <a class="dropdown-item small" onclick="javascript:return confirm('¿Estas seguro de eliminar esta tarea?')" href="?c=cronograma&m=eliminarTareaCronograma&idtarea=<?php echo $response[$i]->id_tarea_cronograma_PK; ?>&idcronograma=<?php echo $_GET["id"] ?>"><i class="fas fa-redo-alt"></i> Eliminar </a>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        renderTimeSelect();
        let http = new XMLHttpRequest(),
            url = new URLSearchParams(location.search);
        http.addEventListener("load", (event) => {
            let {
                data,
                titulo
            } = JSON.parse(event.currentTarget.responseText);
            activeAlarms(data, titulo.titulo);
        });
        http.open("GET", `?c=cronograma&m=getTareasJSON&id=${url.get("id")}`)
        http.send(null);

    });

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

    function renderNotificationSound(title, description) {
        window.audio = document.createElement("audio")
        window.audio.src = "assets/audio/rington-mario-bros.mp3";
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
        } else {
            Notification.requestPermission((permiso) => {
                if (permiso === "granted") {
                    notification = new Notification(title, options);
                    window.audio.play();
                    notification.addEventListener("click", closeNotification);
                    notification.addEventListener("close", closeNotification);
                }
            });
        }
    }

    function closeNotification(event) {
        event.currentTarget.close()
        audio.pause();
        elemTaskId.classList.remove("active-action")

    }

    function activeAlarms(data, title) {
        setInterval(() => {
            let currentDate = new Date();
            let dateTask = new Date();
            data.forEach((elem) => {
                let {
                    id_tarea_cronograma_PK,
                    descripcion,
                    hora,
                    minuto
                } = elem;
                dateTask.setHours(hora, minuto, 0);
                if (dateTask.getTime() == currentDate.getTime()) {
                    renderNotificationSound(descripcion, "Tienes un deber!");
                    window.elemTaskId = document.querySelector(`#task-id-${id_tarea_cronograma_PK}`);
                    elemTaskId.classList.add("active-action")
                }
            });
        }, 1000)
    }
</script>