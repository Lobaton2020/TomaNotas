<?php
function if_null_then_0($item)
{
    if (!isset($item)) {
        return 0;
    }
    return $item;
}