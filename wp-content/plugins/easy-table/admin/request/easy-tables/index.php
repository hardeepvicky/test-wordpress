<?php
global $wpdb;

$queryBuilder = new \EasyTable\QueryBuilder("easy_tables");

$records = \EasyTable\Util::objToArray($wpExtend->DB->get_results($queryBuilder->setFields(["id", "table_name", "table_name_display", "description"])->get()));