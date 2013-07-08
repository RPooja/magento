<?php

class Kraus_Test_IndexController extends Mage_Core_Controller_Front_Action
{
    const XML_PATH_EMAIL_RECIPIENT  = 'test/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'test/email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'test/email/email_template';
    const XML_PATH_ENABLED          = 'test/test/enabled';

    public function preDispatch()
    {
        parent::preDispatch();

        if( !Mage::getStoreConfigFlag(self::XML_PATH_ENABLED) ) {
            $this->norouteAction();
        }
    }

    public function indexAction()
    {

	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Page title"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("Registration form", array(
                "label" => $this->__("Registration form"),
                "title" => $this->__("Registration form")
		   ));

      $this->renderLayout(); 
    }

    public function postAction()
    {
        $post = $this->getRequest()->getPost();
        if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                }

                if (Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    throw new Exception();
                }
				
				if(isset($post['telephone'])){
					$tele = trim($post['telephone']);
				}else{
					$tele = '';
				}
				
				
				$model = Mage::getModel('test/test');
				$model->setGuestName(trim($post['name']));
				$model->setGuestEmail(trim($post['email']));
				$model->setGuestTelephone($tele);
				$model->setGuestComments(trim($post['comment']));
				
				$model->save();		
					
				$mailTemplate = Mage::getModel('core/email_template');
				/* @var $mailTemplate Mage_Core_Model_Email_Template */
				$mailTemplate->setDesignConfig(array('area' => 'frontend'))
					->setReplyTo($post['email'])
					->sendTransactional(
						Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
						Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
						Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
						null,
						array('data' => $postObject)
					);

				if (!$mailTemplate->getSentSuccess()) {
					throw new Exception();
				}

				$translate->setTranslateInline(true);	
				Mage::getSingleton('customer/session')->addSuccess(Mage::helper('test')->__('Your enquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
				$this->_redirect('*/*/');

				return;
			
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addError(Mage::helper('test')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }

        } else {
            $this->_redirect('*/*/');
        }
    }

}
