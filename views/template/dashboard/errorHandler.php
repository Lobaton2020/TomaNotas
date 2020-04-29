<?php
if (isset($_REQUEST["c"]) && !empty($_REQUEST["cod"])) {
    switch ($_REQUEST["c"]) {
        case "auth":
            $object = "El Usuario ";
            break;

        case "link":
            $object = "El Link";
            break;

        case "archivo":
            $object = "El Archívo";
            break;

        case "nota":
            $object = "La Nota";
            break;

        case "usuario":
            $object = "El usuario";
            break;

        case "tarea":
            $object = "La tarea";
            break;
        case "cronograma":
            $object = "El Cronograma";
            break;

        default;
            $object = "";
    }

//   revision de que tipo es
    switch ($_REQUEST["cod"]) {
        case "A001":
            $msg = "se ha guardado exitosamente.";
            $type = "success";
            break;

        case "A002":
            $msg = "se ha actualizado exitosamente.";
            $type = "success";
            break;

        case "A003":
            $msg = "se ha eliminado exitosamente.";
            $type = "primary";
            break;

        case "A004":
            $msg = "El ó los archivos han sido guardados.";
            $type = "success";
            break;

        case "A005":
            $msg = "Sesion cerrada con exito.";
            $type = "primary";
            break;

        case "A006":
            $msg = "Revisa tu correo.<br><small> -Mira el la seccion de spam-<br> (esto puede tardar unos minutos)</small>";
            $type = "success";
            break;

        case "A007":
            $msg = " se ha dejado de compartir exitosamente.";
            $type = "success";
            break;

        case "A008":
            $msg = " se ha compartido correctamente.";
            $type = "success";
            break;

        case "A009":
            $msg = "Reporte enviado exitosamente.";
            $type = "success";
            break;

        case "E001":
            $msg = "no se ha guardado.";
            $type = "danger";
            break;

        case "E002":
            $msg = "no se ha actualizado.";
            $type = "danger";
            break;

        case "E003":
            $msg = "no se ha eliminado.";
            $type = "danger";

            break;
        case "E004":
            $msg = ", existen campos vacíos.";
            $type = "danger";
            break;

        case "E005":
            $msg = "Lo sentimos, hubo un error inesperado.";
            $type = "danger";
            break;

        case "E006":
            $msg = "La URL del Link ya existe.";
            $type = "danger";
            break;

        case "E007":
            $msg = "Tus archivos pesan más de 15 MB";
            $type = "danger";
            break;

        case "E008":
            $msg = "Error de autenticacion.";
            $type = "danger";
            break;

        case "E009":
            $msg = "Correo no encontrado.";
            $type = "danger";
            break;

        case "E010":
            $msg = "Ocurrio un error inesperado.";
            $type = "danger";
            break;

        case "E011":
            $msg = "Existen campos vacios.";
            $type = "danger";
            break;

        default;
            $msg = "Comando no encontrado..";
    }
    ?>
<div id="alert" class="alert alert-<?php echo $type; ?> alert-dismissible fade show text-peque" role="alert">

     <?php
switch ($_REQUEST["cod"]) {
        case "E006";
            echo $msg;
            break;
        case "E007";
            echo $msg;
            break;
        case "A004";
            echo $msg;
            break;

        case "E005";
            echo $msg;
            break;

        case "A005";
            echo $msg;
            break;

        case "E008";
            echo $msg;
            break;

        case "E009";
            echo $msg;
            break;

        case "E010";
            echo $msg;
            break;

        case "A006";
            echo $msg;
            break;

        case "A009";
            echo $msg;
            break;

        case "E011";
            echo $msg;
            break;

        default;
            echo $object . " " . $msg;

    }
    ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

</div>


<?php
}

?>
