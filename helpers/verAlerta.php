<?php

function showMessage($message, $type)
{
  // Have in account there is another componenf for legacy code
    if (isset($_SESSION[$message])):
    $script = '
        <script>
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
              const fromPhpKey = "' . $type . '"
                 toastr[dict[fromPhpKey] ?? fromPhpKey]("' . $_SESSION[$message] . '");
             });

          </script>';
    echo $script;
        unset($_SESSION[$message]);
    endif;
}
