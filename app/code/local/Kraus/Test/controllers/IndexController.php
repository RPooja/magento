<?php

class Kraus_Test_IndexController extends Mage_Core_Controller_Front_Action
{
    public function IndexAction() 
    {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Page title"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("page title", array(
                "label" => $this->__("Register Form"),
                "title" => $this->__("Register Form")
		   ));

      $this->renderLayout(); 
	  
    }
	
	   public function postAction() 
           {
				$model = Mage::getModel('test/test');
			/*
			$collection=$model->getCollection();
			foreach ($collection as $item ) {
			print_r($item->getData());
			}*/
				$name=$this->getRequest()->getParam('name'); // HEre i'm getting value from the Post 
				$model->setName(trim($name)); // here i saving it into the model
				//each value that you want get from the form you have to get first of all form post and after that set to model
				$email=$this->getRequest()->getParam('email');
				$model->setEmail(trim($email));
				$phone=$this->getRequest()->getParam('phone');
				$model->setTelephone($phone);
				$Address=$this->getRequest()->getParam('Address');
				$model->setAddress(trim($Address));
				
				$model->save();		
                die("We are at post action");
	}
}