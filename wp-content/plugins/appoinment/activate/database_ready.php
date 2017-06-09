<?php

$queries[] = "DROP TABLE IF EXISTS `appoinment_details`";

$queries[] = "CREATE TABLE `appoinment_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `datetime` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

$queries[] = "DROP TABLE IF EXISTS `appoinment_customers`;";
        
$queries[] = "CREATE TABLE `appoinment_customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        


global $wpdb;

foreach($queries as $q)
{
    $wpdb->query($q);
}
