<?php
 
class Kraus_Test_Block_Adminhtml_Test_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
     /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'kraus_test'; //pay attention here
        $this->_controller = 'adminhtml_test';
        $this->_mode = 'edit';

        $this->_addButton('save_and_continue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);
        $this->_updateButton('save', 'label', Mage::helper('test')->__('Save Example'));

       /*this is mode hard exmaple dont do it.
        *  $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }
 
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            } ";*/ 
    }
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
        if (Mage::registry('kraus_test')->getId()) {
            return $this->__('Edit Test');
        }  
        else {
            return $this->__('New Test');
        } 
        
  
    }  
}