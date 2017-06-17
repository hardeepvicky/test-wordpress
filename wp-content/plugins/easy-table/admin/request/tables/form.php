<?php

require_once dirname(__FILE__) . "/before.php";

$id = isset($params["id"]) ? $params["id"] : null;

if ($_POST && isset($_POST['data'][$select_table]['id']) && $_POST['data'][$select_table]['id'])
{
    $id = $_POST['data'][$select_table]['id'];
}

if ($_POST)
{
    $_POST['data'][$select_table]['id'] = easy_table_save_data($select_table, $_POST['data'], $id);
}