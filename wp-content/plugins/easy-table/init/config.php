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
    
    const FIELD_TYPE_IMAGE = "image";
    
    public static $table_realtions = array(
        self::RELATION_HAVE_PARENT => "Have Parent",
        self::RELATION_HAVE_CHILDREN => "Have Children",
    );
    
    public static $field_types = array(
        "text" => "Text Or Number",
        "select" => "Dropdown",
        "checkbox" => "Checkbox",
        "image" => "Image",
        "file" => "File",
    );
    
    public static function plugin_admin_url($params)
    {
        $url = "/wp-admin/admin.php?";
        
        $list = array();
        foreach($params as $k => $v)
        {
            $list[] = $k . "=" . $v;
        }
        
        return $url . implode("&", $list);
    }
}