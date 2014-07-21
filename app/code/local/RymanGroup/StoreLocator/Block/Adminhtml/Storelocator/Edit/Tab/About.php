<?php
class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Edit_Tab_About extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("storelocator_form", array("legend"=>Mage::helper("storelocator")->__("Store information")));

						$fieldset->addField("map_branch_img", "text", array(
						"label" => Mage::helper("storelocator")->__("Map Branch Image"),
						"name" => "map_branch_img",
						));
					
						$fieldset->addField("banner", "text", array(
						"label" => Mage::helper("storelocator")->__("Store Banner"),
						"name" => "banner",
						));
					
						$fieldset->addField("branch_title", "text", array(
						"label" => Mage::helper("storelocator")->__("About Branch:"),
						"name" => "branch_title",
						));
					
						$fieldset->addField("branch_description", "textarea", array(
						"label" => Mage::helper("storelocator")->__("Branch Description"),
						"name" => "branch_description",
						));
					
						$fieldset->addField("location_title", "text", array(
						"label" => Mage::helper("storelocator")->__("About Location"),
						"name" => "location_title",
						));
					
						$fieldset->addField("location_description", "textarea", array(
						"label" => Mage::helper("storelocator")->__("Location Description"),
						"name" => "location_description",
						));
					
						$fieldset->addField("near_us_title", "text", array(
						"label" => Mage::helper("storelocator")->__("Whats Near Us, Title"),
						"name" => "near_us_title",
						));
					
						$fieldset->addField("near_us_description", "textarea", array(
						"label" => Mage::helper("storelocator")->__("Near Us Description"),
						"name" => "near_us_description",
						));
					
						$fieldset->addField("aside_img", "text", array(
						"label" => Mage::helper("storelocator")->__("Aside Image"),
						"name" => "aside_img",
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
