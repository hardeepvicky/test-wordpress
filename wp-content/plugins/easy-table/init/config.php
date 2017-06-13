<?php
namespace EasyTable;

class Config
{
    const VERSION = "1.0";
    const SLUG = EASY_TABLE_SLUG;
    const BASE_PATH = EASY_TABLE_BASE_PATH;
    
    const BASE_URL = EASY_TABLE_URL;
    const PUBLIC_URL = self::BASE_URL . "/public";
    const CSS_URL = self::BASE_URL . "/public/css";
    const JS_URL = self::BASE_URL . "/public/js";
    
    const RELATION_HAVE_PARENT = "parent";
    const RELATION_HAVE_CHILDREN = "children";
    
    public static $table_realtions = array(
        self::RELATION_HAVE_CHILDREN => "Have Parent",
        self::RELATION_HAVE_CHILDREN => "Have Children",
    );
    
    public static function getTableList()
    {
        global $wpdb;
        $data = self::objToArray($wpdb->get_results("show tables;"));
        
        $list = array();
        foreach($data as $obj)
        {
            $name = reset($obj);
            if (strpos($name, "wp_") === false)
            {
                $list[] = $name;
            }
        }
        
        return $list;
    }
}