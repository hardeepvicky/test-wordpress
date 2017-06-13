<?php

if (!function_exists ('debug'))
{
    function debug($data)
    {
        $bt = debug_backtrace();
        $caller = array_shift($bt);

        echo "<pre>";
        echo "<b>" . $caller["file"] . " : " . $caller["line"] . "</b><br/>";
        print_r($data);
        echo "</pre>";
    }
}