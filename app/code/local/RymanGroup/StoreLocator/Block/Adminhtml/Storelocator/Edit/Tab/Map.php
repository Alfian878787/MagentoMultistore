<?php
class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Edit_Tab_Map extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("storelocator_form", array("legend"=>Mage::helper("storelocator")->__("Store information")));
					
						$fieldset->addField("lat", "text", array(
						"label" => Mage::helper("storelocator")->__("Latitude"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "lat",
						));
					
						$fieldset->addField("lng", "text", array(
						"label" => Mage::helper("storelocator")->__("Longitude"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "lng",
						));
					
						$fieldset->addField("map_zoom_list_page", "text", array(
						"label" => Mage::helper("storelocator")->__("Map Zoom List Page"),
						"name" => "map_zoom_list_page",
						));
					
						$fieldset->addField("map_zoom_branch_page", "text", array(
						"label" => Mage::helper("storelocator")->__("Map Zoom Branch Details Page"),
						"name" => "map_zoom_branch_page",
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
