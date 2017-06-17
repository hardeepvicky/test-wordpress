<?php

$select_table = $params["table"]['table_name'];

$easy_table_query = new \EasyTable\QueryBuilder("easy_tables");

$fields = easy_table_get_fields($select_table);
$relations = easy_table_get_relation_ships($select_table);

$parent_options_list = array();

if (isset($relations["parent"]) && $relations["parent"])
{
    foreach($relations["parent"] as $key_field => $parents)
    {
        $query = new \EasyTable\QueryBuilder($parents[0]["relation_table"]);
        
        $fields[$key_field]["select"]['options'] = easy_table_get_data_list($select_table, $query);
    }
}