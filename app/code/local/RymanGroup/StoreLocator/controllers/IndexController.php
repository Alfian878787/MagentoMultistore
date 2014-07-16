<?php
class RymanGroup_StoreLocator_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction(){
		if($this->getRequest()->isPost()){
			$address  = $this->getRequest()->getPost('address');
//			$dhl            = $this->getRequest()->getPost('dhl');
//			$copy           = $this->getRequest()->getPost('copy');
//			$scan           = $this->getRequest()->getPost('scan');
//			$int2 = $this->getRequest()->getPost('int2');
//			$result = $int1 * $int2;
            Mage::getSingleton('core/session')->setMySessionVariable($address);

//  $myValue  =  Mage::getSingleton(‘core/session’)->getMySessionVariable();
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