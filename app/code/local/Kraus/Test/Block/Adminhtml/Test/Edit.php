<?php
 
class Kraus_Test_Block_Adminhtml_Test_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'test';
        $this->_controller = 'adminhtml_test';
 
        $this->_updateButton('save', 'label', Mage::helper('Test')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('Test')->__('Delete Item'));
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('Test_data') && Mage::registry('Test_data')->getId() ) {
            return Mage::helper('Test')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('Test_data')->getTitle()));
        } else {
            return Mage::helper('Test')->__('Add Item');
        }
    }
}