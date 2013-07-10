<?php

class Kraus_Test_Adminhtml_TestController extends Mage_Adminhtml_Controller_Action {

    //enable ACL for module
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('kraus/test'); //this enable acl
    }

    public function indexAction() {
        // Let's call our initAction method which will set some basic params for each action
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('test/adminhtml_test');
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }

    public function newAction() {
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }

    public function editAction() {
        $this->_initAction();

        // Get id if available
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('test/test'); //wrong

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This test no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getName() : $this->__('New Test'));
        $data = Mage::getSingleton('adminhtml/session')->getTestData(true);

        if (!empty($data)) {
            $model->setData($data);


            /** ways set data into model:
             * $model->setData($array); - $array=array('db_field_name'=>'field_value',..);
             * $model->setDbFieldName($value); - set db_field_name $value
             * in last when oyu setting vvalue to model _ not writing but next character will be capital
             */
        }

        Mage::register('kraus_test', $model);

        $this->_initAction()
                ->_addBreadcrumb($id ? $this->__('Edit Test') : $this->__('New Test'), $id ? $this->__('Edit Test') : $this->__('New Test'))
                ->_addContent($this->getLayout()->createBlock('test/adminhtml_test_edit')->setData('action', $this->getUrl('*/*/save')))
                ->renderLayout();
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('test/test');

                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $webIds = $this->getRequest()->getParam('test');
        if (!is_array($webIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($webIds as $Id) {
                    $web = Mage::getModel('test/test')->load($Id);
                    $web->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($Ids)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function saveAction() {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('test/test');
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The test has been saved.'));
                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this test.'));
            }

            Mage::getSingleton('adminhtml/session')->setTestData($postData);
            $this->_redirectReferer();
        }
    }

    public function messageAction() {
        $data = Mage::getModel('kraus_test/test')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction() {
        $this->loadLayout()
                // Make the active menu match the menu config nodes (without 'children' inbetween)
                ->_setActiveMenu('sales/kraus_test_test')
                ->_title($this->__('Sales'))->_title($this->__('Test'))
                ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
                ->_addBreadcrumb($this->__('Test'), $this->__('Test'));

        return $this;
    }

}