<?php
 
class Kraus_Test_Block_Adminhtml_Test_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('Test_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('Test')->__('News Information'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('Test')->__('Item Information'),
            'title'     => Mage::helper('Test')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('Test/adminhtml_<module>_edit_tab_form')->toHtml(),
        ));
       
        return parent::_beforeToHtml();
    }
}