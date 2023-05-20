<?php

function compararPorHoraMinuto($a, $b) {
    $a = (object)$a;
    $b = (object)$b;
    if ($a->hora < $b->hora) {
        return -1;
    } elseif ($a->hora > $b->hora) {
        return 1;
    }

    if ($a->minuto < $b->minuto) {
        return -1;
    } elseif ($a->minuto > $b->minuto) {
        return 1;
    }

    return 0;
}