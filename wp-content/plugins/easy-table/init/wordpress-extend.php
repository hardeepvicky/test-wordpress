<?php
namespace EasyTable;

use EasyTable\Util as Util;

class WPExtend
{
    public $DB;
    public static $Cache = array();
    
    public function __construct()
    {
        global $wpdb;
        $this->DB = &$wpdb;
    }
    
    public function save($table, $data, $id)
    {
        if ($id)
        {
            $result = $this->DB->get_results("SELECT count(*) as c FROM $table WHERE id=$id");
            if (!$result || $result[0]->c == 0)
            {
                $id = NULL;
            }
        }
        
        if ($id)
        {
            $this->DB->update($table, $data, array("id" => $id));
        }
        else
        {
            $this->DB->insert($table, $data);
        }
    }
    
    public function getTableList()
    {
        $data = Util::objToArray($this->DB->get_results("show tables;"));
        
        $list = array();
        foreach($data as $obj)
        {
            $name = reset($obj);
            if ($name == "easy_tables")
            {
                
            }
            else if (strpos($name, "easy_table") !== false)
            {
                $list[] = $name;
            }
        }
        
        return $list;
    }
    
    public function getFieldList($table)
    {
        $db_name = $this->DB->dbname;
        $data = $this->DB->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . $db_name . "' AND TABLE_NAME = '" . $table . "';");
        
        if (!$data)
        {
            return false;
        }
        
        $data = Util::objToArray($data);
        
        $list = array();
        
        foreach($data as $field)
        {
            $list[] = $field["COLUMN_NAME"];
        }
        
        return $list;
    }
}