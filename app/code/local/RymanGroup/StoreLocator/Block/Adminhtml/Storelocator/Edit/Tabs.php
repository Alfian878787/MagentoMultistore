<?php
class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("storelocator_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("storelocator")->__("Store Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("branches", array(
				"label" => Mage::helper("storelocator")->__("About This Store"),
				"title" => Mage::helper("storelocator")->__("Store Information"),
				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_form")->toHtml(),
				));
				$this->addTab("hours_opening", array(
				"label" => Mage::helper("storelocator")->__("Opening Hours"),
				"title" => Mage::helper("storelocator")->__("Store Information"),
				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_hoursopening")->toHtml(),
				));
//				$this->addTab("hours_holiday", array(
//				"label" => Mage::helper("storelocator")->__("Holiday Hours"),
//				"title" => Mage::helper("storelocator")->__("Store Information"),
//				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_hoursholiday")->toHtml(),
//				));
//				$this->addTab("near_by", array(
//				"label" => Mage::helper("storelocator")->__("Near By Stores"),
//				"title" => Mage::helper("storelocator")->__("Store Information"),
//				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_form")->toHtml(),
//				));
//				$this->addTab("services", array(
//				"label" => Mage::helper("storelocator")->__("Services"),
//				"title" => Mage::helper("storelocator")->__("Store Information"),
//				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_form")->toHtml(),
//				));
//				$this->addTab("services_store", array(
//				"label" => Mage::helper("storelocator")->__("Store Services"),
//				"title" => Mage::helper("storelocator")->__("Store Information"),
//				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_form")->toHtml(),
//				));
				return parent::_beforeToHtml();
		}

}
