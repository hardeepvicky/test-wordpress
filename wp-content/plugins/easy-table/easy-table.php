<?php
/*
Plugin Name: Easy Table
Description: A basic plugin lets you create seprate table and crud operation for table
Version:     1.0
Plugin URI:  http://www.techformation.co.in/
Author:      Hardeep Singh
Author URI:  http://www.techformation.co.in/
License:     GPL v2 or later

Copyright 2009-2017 Hardeep Singh

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
define("EASY_TABLE_BASE_PATH", dirname(__FILE__));
define("EASY_TABLE_NAME", 'easy-table');
define("EASY_TABLE_URL",  plugins_url(EASY_TABLE_NAME));
define("EASY_TABLE_SLUG", 'easy-table');

require_once EASY_TABLE_BASE_PATH . "/init/run.php"; //main executive function


//registering hooks
register_activation_hook( __FILE__, 'easy_table_activate' );
register_deactivation_hook( __FILE__, 'easy_table_deactivate' );
register_uninstall_hook(__FILE__, 'easy_table_uninstall');

function easy_table_activate()
{
    require_once EASY_TABLE_BASE_PATH . "/activate/run.php";
}

function easy_table_deactivate()
{
    
}

function easy_table_uninstall()
{
    require_once EASY_TABLE_BASE_PATH . "/uninstall.php";
}

