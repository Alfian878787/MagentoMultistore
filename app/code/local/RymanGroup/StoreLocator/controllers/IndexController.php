<?php
class RymanGroup_StoreLocator_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction(){
		if($this->getRequest()->isPost()){
			$address  = $this->getRequest()->getPost('address');
		}
		$this->loadLayout();
		$this->_initLayoutMessages('customer/session');
        $this->renderLayout();
	}

	public function detailsAction(){
		$this->loadLayout();
        $this->renderLayout();
	}
}