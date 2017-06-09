<?php
function appoinment_menu()
{
    $Menu = array(
        array(
            "page_title" => "Appoinment Manager",
            "menu_title" => "Appoinment Manager",
            "slug" => APPOINMENT_SLUG . "-details",
            "function" => function ()
            {
                require_once APPOINMENT_BASE_PATH . "/admin/appoinment_details/index.php";
            },
            "submenu" => array(
                array(
                    "page_title" => "Form",
                    "menu_title" => "Form",
                    "slug" => APPOINMENT_SLUG . "-details-form",
                    "function" => function ()
                    {
                        require_once APPOINMENT_BASE_PATH . "/admin/appoinment_details/form.php";
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
