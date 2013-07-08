<?php
 
class Kraus_Test_Block_Adminhtml_Test extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_Test';
        $this->_blockGroup = 'Test';
        $this->_headerText = Mage::helper('Test')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('Test')->__('Add Item');
        parent::__construct();
    }
}