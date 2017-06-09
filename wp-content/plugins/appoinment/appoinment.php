<?php
/*
Plugin Name: Appoinment
Description: Appoinments Management
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

register_activation_hook( __FILE__, 'appoinment_activate' );
register_deactivation_hook( __FILE__, 'appoinment_deactivate' );
register_uninstall_hook(__FILE__, 'appoinment_uninstall');

define("APPOINMENT_BASE_PATH", dirname(__FILE__));
define("APPOINMENT_SLUG", 'appoinment-manager');

function appoinment_activate()
{
    require_once dirname(__FILE__) . "/activate/run.php";
}

function appoinment_deactivate()
{
    
}

function appoinment_uninstall()
{
    require_once dirname(__FILE__) . "/uninstall.php";
}

// following code will run every time 
require_once dirname(__FILE__) . "/init/menus.php";