<?php

class kraus_Test_Model_Mysql4_Contacts extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
    	
        $this->_init('test/test', 'regis_id'); // regis_id -> your table's primary key
        
        
    }
}