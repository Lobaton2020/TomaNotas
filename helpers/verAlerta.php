<?php

function showMessage($message, $type)
{
    if (isset($_SESSION[$message])):
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show " id="alert"  role="alert">';
        echo $_SESSION[$message];
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';

        unset($_SESSION[$message]);
    endif;
}
