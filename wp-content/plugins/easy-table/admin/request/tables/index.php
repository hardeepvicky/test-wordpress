<?php
global $wpdb;

$records = $wpdb->get_results( "SELECT * FROM easy_tables" );
