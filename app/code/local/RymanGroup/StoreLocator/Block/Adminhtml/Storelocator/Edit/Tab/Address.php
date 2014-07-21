<?php
class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("storelocator_form", array("legend"=>Mage::helper("storelocator")->__("Store information")));


					
						$fieldset->addField("address1", "text", array(
						"label" => Mage::helper("storelocator")->__("Address Line 1"),
						"name" => "address1",
						));
					
						$fieldset->addField("address2", "text", array(
						"label" => Mage::helper("storelocator")->__("Address Line 2"),
						"name" => "address2",
						));
					
						$fieldset->addField("town", "text", array(
						"label" => Mage::helper("storelocator")->__("Town"),
						"name" => "town",
						));
					
						$fieldset->addField("city", "text", array(
						"label" => Mage::helper("storelocator")->__("City"),
						"name" => "city",
						));
					
						$fieldset->addField("county", "text", array(
						"label" => Mage::helper("storelocator")->__("County"),
						"name" => "county",
						));
					
						$fieldset->addField("country", "text", array(
						"label" => Mage::helper("storelocator")->__("Country"),
						"name" => "country",
						));
					
						$fieldset->addField("postcode", "text", array(
						"label" => Mage::helper("storelocator")->__("Postcode"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "postcode",
						));
					
						$fieldset->addField("direction", "textarea", array(
						"label" => Mage::helper("storelocator")->__("Direction"),
						"name" => "direction",
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
