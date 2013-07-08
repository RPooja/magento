 <?php
 
class Kraus_Test_Block_Adminhtml_Test_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('Test_form', array('legend'=>Mage::helper('Test')->__('Item information')));
       
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('Test')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
 
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('Test')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('Test')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('Test')->__('Inactive'),
                ),
            ),
        ));
       
        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('Test')->__('Content'),
            'title'     => Mage::helper('Test')->__('Content'),
            'style'     => 'width:98%; height:400px;',
            'wysiwyg'   => false,
            'required'  => true,
        ));
       
        if ( Mage::getSingleton('adminhtml/session')->get<Module>Data() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->get<Module>Data());
            Mage::getSingleton('adminhtml/session')->set<Module>Data(null);
        } elseif ( Mage::registry('Test_data') ) {
            $form->setValues(Mage::registry('Test_data')->getData());
        }
        return parent::_prepareForm();
    }
}