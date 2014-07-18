<?php
class RymanGroup_StoreLocator_Adminhtml_StorelocatorbackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Store Locator "));
	   $this->renderLayout();
    }
}