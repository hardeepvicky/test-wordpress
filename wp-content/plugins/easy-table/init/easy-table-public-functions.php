<?php
/* 
 * created 16-june-2017
 * public function used in frontend as well as admin panel
 */
use EasyTable\QueryBuilder as EasyTableQueryBuilder;

$wpExtend = new \EasyTable\WPExtend();

$Session = new \EasyTable\Session("easy_table");
        

/**----------------- Data Functions -----------------*/

function easy_table_get_data($queryBuilder)
{
    if (!$queryBuilder instanceof EasyTableQueryBuilder)
    {
        throw new exception("Unknown first argument");
    }
    
    global $wpExtend;
    
    $record = $wpExtend->DB->get_results($queryBuilder->get());
    return \EasyTable\Util::objToArray($record);
}

function easy_table_get_data_by_id($table, $id)
{}

function easy_table_get_data_list($table, $queryBuilder)
{
    $setting = easy_table_get_setting($table);
    
    if ( !isset($setting['field']['list_key_field']) || !isset($setting['field']['list_value_field']))
    {
        return array();
    }
    
    return easy_table_get_list(easy_table_get_data($queryBuilder),  $setting['field']['list_key_field'], $setting['field']['list_value_field']);
}


function easy_table_save_data($table, $post, $id)
{
    global $wpExtend;
    global $Session;
    
    if ($id)
    {
        if (isset($post[$table]['created']))
        {
            $post[$table]['created'] = date("Y-m-d H:i:s");
        }
    }
    else
    {
        if (isset($post[$table]['modified']))
        {
            $post[$table]['modified'] = date("Y-m-d H:i:s");
        }
    }
    
    $wpExtend->save($table, $post[$table], $id);
        
    if (!$id)
    {
        $id = $wpExtend->DB->insert_id;
    }
    
    $Session->writeFlash("success", "Data Saved successfully");
    
    return $id;
}