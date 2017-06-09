<?php
$queries[] = "CREATE TABLE IF NOT EXISTS `easy_tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL,
  `table_name_display` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `meta` blob,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


global $wpdb;

foreach($queries as $q)
{
    $wpdb->query($q);
}