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

function easy_table_get_list($data, $key, $value)
{
    if (!is_array($data) || empty($data))
    {
        return array();
    }
    
    $list = array();
    
    foreach($data as $record)
    {
        if (isset($record[$key]) && isset($record[$value]))
        {
            $list[$record[$key]] = $record[$value];
        }
    }
    
    return $list;
}