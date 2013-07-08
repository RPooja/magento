<?php

 $installer = $this;
 
$installer->startSetup();
 
$installer->run("
 
-- DROP TABLE IF EXISTS `regis_form` ;
CREATE TABLE `regis_form` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` int(20) NOT NULL,
  `comments` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 
INSERT INTO `regis_form` (name, email, telephone, comments) values ('Example 1', 'abc@gmail', '9876543213', 'abc');
 
");
 
$installer->endSetup();