<?php
class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("storelocator_form", array("legend"=>Mage::helper("storelocator")->__("Store information")));

				
						$fieldset->addField("store_code", "text", array(
						"label" => Mage::helper("storelocator")->__("Store Code"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "store_code",
						));
					
						$fieldset->addField("branch_code", "text", array(
						"label" => Mage::helper("storelocator")->__("Branch Code"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "branch_code",
						));
					
						$fieldset->addField("branch_name", "text", array(
						"label" => Mage::helper("storelocator")->__("Branch Name"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "branch_name",
						));
					
						$fieldset->addField("email1", "text", array(
						"label" => Mage::helper("storelocator")->__("Email "),					
						"class" => "required-entry",
						"required" => true,
						"name" => "email1",
						));
					
						$fieldset->addField("telephone1", "text", array(
						"label" => Mage::helper("storelocator")->__("Telephone 1"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "telephone1",
						));
					
						$fieldset->addField("telephone2", "text", array(
						"label" => Mage::helper("storelocator")->__("Telephone 2"),
						"name" => "telephone2",
						));
					
						$fieldset->addField("fax", "text", array(
						"label" => Mage::helper("storelocator")->__("Fax"),
						"name" => "fax",
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
