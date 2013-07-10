<?php
 
class Kraus_Test_Block_Adminhtml_Test_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
     /**
     * Init class
     */
    public function __construct()
    {  
        parent::__construct();
     
        $this->setId('kraus_test_test_form');
        $this->setTitle($this->__('test Information'));
    }  
     
    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {  
        $model = Mage::registry('kraus_test');
     
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));
     
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('checkout')->__('test Information'),
            'class'     => 'fieldset-wide',
        ));
     
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }  
     
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('checkout')->__('Name'),
            'title'     => Mage::helper('checkout')->__('Name'),
            'required'  => true,
        ));
        
         $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('checkout')->__('Email'),
            'title'     => Mage::helper('checkout')->__('Email'),
            'required'  => true,
        ));
         
         $fieldset->addField('telephone', 'text', array(
            'name'      => 'telephone',
            'label'     => Mage::helper('checkout')->__('Telephone'),
            'title'     => Mage::helper('checkout')->__('Telephone'),
            'required'  => true,
        ));
         
         $fieldset->addField('address', 'text', array(
            'name'      => 'address',
            'label'     => Mage::helper('checkout')->__('Address'),
            'title'     => Mage::helper('checkout')->__('Address'),
            'required'  => true,
        ));
     
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
     
        return parent::_prepareForm();
    }  
}