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
            $object = "El Cronograma o la tarea";
            break;
        case "project":
            $object = "El Proyecto";
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

        case "A010":
            $msg = " se ha copiado exitosamente.";
            $type = "success";
            break;

        case "A011":
            $msg = " se ha movido exitosamente.";
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

    <script>
        // Have in account there is another componenf for legacy code
         document.addEventListener("DOMContentLoaded",()=>{
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-left",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
              const dict = {
                "danger":"error",
                "primary":"info"
              }
              const fromPhpKey = "<?= $type ?>"
                 toastr[dict[fromPhpKey] ?? fromPhpKey]("<?= $object . $msg ?>");
                 });
                    </script>

    <?php
}

?>
