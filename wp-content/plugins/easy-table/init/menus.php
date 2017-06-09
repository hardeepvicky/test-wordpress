<?php
function appoinment_menu()
{
    require_once EasyTable::BASE_PATH . "/admin/Controller.php";
    
    $Menu = array(
        array(
            "page_title" => "Easy Table",
            "menu_title" => "Easy Table",
            "slug" => EasyTable::SLUG . "-table-summary",
            "function" => function ()
            {
                $controller = new Controller("tables/index", "main", "tables/index");
                $controller->run();
            },
            "submenu" => array(
                array(
                    "page_title" => "Add New Table",
                    "menu_title" => "Add New Table",
                    "slug" => EasyTable::SLUG . "-table-form",
                    "function" => function ()
                    {
                        $controller = new Controller("tables/form", "main", "tables/form");
                        $controller->run();
                    },
                )
            )
        )
    );
        
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
