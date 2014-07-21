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
				"label" => Mage::helper("storelocator")->__("General Info"),
				"title" => Mage::helper("storelocator")->__("Store Information"),
				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_form")->toHtml(),
				));
				$this->addTab("address", array(
				"label" => Mage::helper("storelocator")->__("Address"),
				"title" => Mage::helper("storelocator")->__("Store Information"),
				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_address")->toHtml(),
				));
				$this->addTab("about", array(
				"label" => Mage::helper("storelocator")->__("About"),
				"title" => Mage::helper("storelocator")->__("Store Information"),
				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_about")->toHtml(),
				));
				$this->addTab("map", array(
				"label" => Mage::helper("storelocator")->__("Map"),
				"title" => Mage::helper("storelocator")->__("Store Information"),
				"content" => $this->getLayout()->createBlock("storelocator/adminhtml_storelocator_edit_tab_map")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
