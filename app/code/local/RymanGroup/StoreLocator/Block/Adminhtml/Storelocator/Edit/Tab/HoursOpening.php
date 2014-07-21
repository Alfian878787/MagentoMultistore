<?php
class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Edit_Tab_HoursOpening extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("storelocator_form", array("legend"=>Mage::helper("storelocator")->__("Store information")));

				
						$fieldset->addField("active", "text", array(
						"label" => Mage::helper("storelocator")->__("Active"),
						"class" => "required-entry",
						"required" => true,
						"name" => "active",
						));
					
						$fieldset->addField("branch_id", "text", array(
						"label" => Mage::helper("storelocator")->__("Branch ID"),
						"class" => "required-entry",
						"required" => true,
						"name" => "branch_id",
						));
					
						$fieldset->addField("sn", "text", array(
						"label" => Mage::helper("storelocator")->__("Ordered"),
						"class" => "required-entry",
						"required" => true,
						"name" => "sn",
						));
					
						$fieldset->addField("from_", "text", array(
						"label" => Mage::helper("storelocator")->__("Opening / From "),
						"class" => "required-entry",
						"required" => true,
						"name" => "from_",
						));

						$fieldset->addField("to_", "text", array(
						"label" => Mage::helper("storelocator")->__("Closing / To "),
						"class" => "required-entry",
						"required" => true,
						"name" => "to_",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getStorelocatorData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getStorelocatorData());
					Mage::getSingleton("adminhtml/session")->setStorelocatorData(null);
				} 
				elseif(Mage::registry("storelocator_data")) {
				    $form->setValues(Mage::registry("storelocator_data")->getData());
				}
				return parent::_prepareForm();
		}
}
