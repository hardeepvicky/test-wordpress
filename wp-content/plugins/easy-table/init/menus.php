<?php
function appoinment_menu()
{
    require_once \EasyTable\Config::BASE_PATH . "/admin/controller.php";
    
    $Menu = array(
        array(
            "page_title" => "Easy Table",
            "menu_title" => "Easy Table",
            "slug" => \EasyTable\Config::SLUG . "-easy-tables-summary",
            "function" => function ()
            {
                $controller = new \EasyTable\Controller("easy-tables/index", "main", "easy-tables/index");
                $controller->run();
            },
            "submenu" => array(
                array(
                    "page_title" => "Add New Table",
                    "menu_title" => "Add New Table",
                    "slug" => \EasyTable\Config::SLUG . "-easy-tables-form",
                    "function" => function ()
                    {
                        $controller = new \EasyTable\Controller("easy-tables/form", "main", "easy-tables/form");
                        $controller->run();
                    },
                )
            )
        )
    );
                    
    $queryBuilder = new \EasyTable\QueryBuilder("easy_tables");

    global $wpdb;
    
    $q = $queryBuilder->setFields(["id", "table_name", "table_name_display"])
            ->setConditions(["is_completed" => 1])
            ->get();
    
    $records = \EasyTable\Util::objToArray($wpdb->get_results($q));
    
    foreach($records as $table)
    {
        $Menu[0]['submenu'][] = array(
            "page_title" => $table["table_name_display"],
            "menu_title" => $table["table_name_display"],
            "slug" => \EasyTable\Config::SLUG . "-" . $table["table_name"],
            "function" => function () use ($table)
            {
                $action = isset($_GET['action']) ? $_GET['action'] : "index";
                $controller = new \EasyTable\Controller("tables/$action", "main", "tables/$action");
                $controller->run(compact("table"));
            },
        );
    }
        
    foreach($Menu as $menu)
    {
        add_menu_page($menu["page_title"], $menu["menu_title"], 'manage_options', $menu["slug"], $menu["function"]);
        
        if (isset($menu['submenu']) && !empty($menu['submenu']))
        {
            foreach($menu['submenu'] as $submenu)
            {
                add_submenu_page($menu["slug"], $submenu['page_title'], $submenu['menu_title'], 'manage_options', $submenu['slug'], $submenu['function']);
            }
        }
    }
}

add_action('admin_menu', 'appoinment_menu');
