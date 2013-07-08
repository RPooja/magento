<?php

class Kraus_Test_Model_Mysql4_Test extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
    	
        $this->_init('test/test', 'id'); // regis_id -> your table's primary key
        
        
    }
}