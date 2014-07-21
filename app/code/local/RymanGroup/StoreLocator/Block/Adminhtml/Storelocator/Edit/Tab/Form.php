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
