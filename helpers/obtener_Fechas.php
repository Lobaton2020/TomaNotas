<?php
function getDatenota($fecha)
{
        $date = new DateTime($fecha);

        $mes = [
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Sertiembre",
                10 => "Octubre",
                11 => "Noviembre",
                12 => "Diciembre"
        ];

        $string_formato = $date->format("l") . " " . $date->format("j") . " de " . $mes[$date->format("n")] . " " . " del " . $date->format("Y");

        return $string_formato;
}

function getDatelink($fecha)
{

        $date = new DateTime($fecha);

        $mes = [
                1 => "Ene",
                2 => "Feb",
                3 => "Mar",
                4 => "Abr",
                5 => "May",
                6 => "Jun",
                7 => "Jul",
                8 => "Ago",
                9 => "Sep",
                10 => "Oct",
                11 => "Nov",
                12 => "Dic"
        ];

        $string_formato = $mes[$date->format("n")] . " " . $date->format("j") . " del " . $date->format("Y");

        return $string_formato;
}

function getDatetime($fecha)
{

        $date = new DateTime($fecha);

        $mes = [
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Sertiembre",
                10 => "Octubre",
                11 => "Noviembre",
                12 => "Diciembre"
        ];

        $string_formato = $date->format("j") . " de " . $mes[$date->format("n")] . " del " . $date->format("Y");

        return $string_formato;
}

function getDatetime_login_history($fecha, $hora)
{

        $date = new DateTime($fecha);
        $time = new DateTime($hora);

        $mes = [
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Sertiembre",
                10 => "Octubre",
                11 => "Noviembre",
                12 => "Diciembre"
        ];


        $string_formato = " " . $date->format("j") . " " . $mes[$date->format("n")] . " <b>" . $date->format("Y") .
                "</b> a las  <b>" . $time->format("g") .
                ":" . $time->format("i") . " " . $time->format("a") . "</b>";

        return $string_formato;
}

?>