<?php
 
class Kraus_Test_Block_Adminhtml_Test_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
     /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'test'; //pay attention here
        $this->_controller = 'adminhtml_test';
        $this->_mode = 'edit';
        
       parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Test'));
        $this->_updateButton('delete', 'label', $this->__('Delete Test'));
    } 
     
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {  
         if( Mage::registry('kraus_test')&&Mage::registry('kraus_test')->getId())
         {
              return 'Editer la reference '.$this->htmlEscape(
              Mage::registry('kraus_test')->getTitle()).'<br />';
         }
         else
         {
             return 'Add a contact';
         }

      
    }  
}