<?php

/**
 * Obtiene la URL base dinámicamente según el dominio actual
 * @return string URL base completa con protocolo y dominio
 */
function getBaseUrl()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    
    return $protocol . '://' . $host . $path . '/';
}