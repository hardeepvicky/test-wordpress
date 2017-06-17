<?php

require_once dirname(__FILE__) . "/before.php";

$easy_table_query = new \EasyTable\QueryBuilder($select_table);

$records = easy_table_get_data($easy_table_query);