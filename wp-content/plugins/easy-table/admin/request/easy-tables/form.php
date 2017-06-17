<?php
/* 
 * Created 13-06-2017
 */

$steps = array( "Choose Table", "Set Table Relation", "Set Fields", "General Setting");

$id = isset($params["id"]) ? $params["id"] : null;
$step = isset($params["step"]) ? $params["step"] : 0;

if ($_POST && isset($_POST['data']['id']) && $_POST['data']['id'])
{
    $id = $_POST['data']['id'];
}

$database_record = null;
if ($id)
{
    $queryBuilder = new \EasyTable\QueryBuilder("easy_tables");

    $database_record = \EasyTable\Util::objToArray($wpExtend->DB->get_results($queryBuilder->setConditions(["id" => $id])->get()));
    if ($database_record)
    {
        $database_record = \EasyTable\Util::objToArray($database_record[0]);
    }
    else
    {
        throw new Exception("Easy Table Invalid id - $id");
    }
}


if ($_POST)
{
    $data = $_POST;
    if (isset($data['data']['id']) && $data['data']['id'])
    {
        $id = $data['data']['id'];
    }
    
    unset($data['data']['step']);
    
    if ($step == 0)
    {
        $wpExtend->save("easy_tables", $data['data'], $id);
        
        if (!$id)
        {
            $id = $wpExtend->DB->insert_id;
        }
        
        $url = \EasyTable\Config::plugin_admin_url(array("page" => \EasyTable\Config::SLUG . "-easy-tables-form", "id" => $id, "step" => 1 ));
        wp_redirect($url);
    }
    else if ($step == 1)
    {
        if (isset($data["data"]["relation_meta"]["{{id}}"]))
        {
            unset($data["data"]["relation_meta"]["{{id}}"]);
        }
        
        if ($data["data"]["relation_meta"])
        {
            $data["data"]["relation_meta"] = json_encode($data["data"]["relation_meta"]);
        }
        
        $wpExtend->save("easy_tables", $data['data'], $id);
        
        $Session->writeFlash("success", "Data Saved successfully");
        
        wp_redirect(\EasyTable\Config::plugin_admin_url(array("page" => \EasyTable\Config::SLUG . "-easy-tables-form", "id" => $id, "step" => 3)) );
        
    }
    else if ($step == 2)
    {
        foreach($data["data"]["field_meta"] as $field => $meta)
        {
            if (isset($meta["dropdown_options"]["{id}"]))
            {
                unset($data["data"]["field_meta"][$field]["dropdown_options"]["{id}"]);
            }
        }
        $data["data"]["field_meta"] = json_encode($data["data"]["field_meta"]);
        
        $wpExtend->save("easy_tables", $data['data'], $id);
        
        wp_redirect(\EasyTable\Config::plugin_admin_url(array("page" => \EasyTable\Config::SLUG . "-easy-tables-form", "id" => $id, "step" => 2)) );
    }
    else if ($step == 3)
    {
        if ($data["data"]["general_meta"])
        {
            $data["data"]["general_meta"] = json_encode($data["data"]["general_meta"]);
        }
        
        $data["data"]["is_completed"] = 1;
        
        $wpExtend->save("easy_tables", $data['data'], $id);
        
        $Session->writeFlash("success", "Data Saved successfully");
        
        wp_redirect(\EasyTable\Config::plugin_admin_url(array("page" => \EasyTable\Config::SLUG . "-easy-tables-form", "id" => $id, "step" => 3)) );
    }
}
else
{
    $_POST["data"] = $database_record;
    
    switch($step)
    {
        case 1 : 
            $_POST["data"]['relation_meta'] = \EasyTable\Util::objToArray(json_decode($database_record['relation_meta']));            
        break;
    
        case 2 : 
            $_POST["data"]['field_meta'] = \EasyTable\Util::objToArray(json_decode($database_record['field_meta']));
        break;
    
        case 3 : 
            $_POST["data"]['general_meta'] = \EasyTable\Util::objToArray(json_decode($database_record['general_meta']));
        break;
    }
}

$table_realtions = \EasyTable\Config::$table_realtions;
$field_types = \EasyTable\Config::$field_types;

$table_list = $table_fields =  $selected_table_fields = array();
$selected_table = "";

foreach($wpExtend->getTableList() as $table)
{
    $table_list[$table] = $table;
}

if (isset($_POST["data"]['table_name']))
{
    $selected_table = $_POST["data"]['table_name'];
}
else if (isset($database_record['table_name']))
{
    $selected_table = $database_record['table_name'];   
}

switch($step)
{
    case 1:
        foreach($table_list as $table)
        {
            foreach($wpExtend->getFieldList($table) as $field)
            {
                $table_fields[$table][$field] = $field;
            }
        }
        
        if ($selected_table)
        {
            $selected_table_fields = $table_fields[$selected_table];
        }
    break;
    
    case 3 : 
        if ($selected_table)
        {
            foreach($wpExtend->getFieldList($selected_table) as $field)
            {
                $selected_table_fields[$field] = $field;
            }
        }
    break;
}



