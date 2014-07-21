<?php
class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Edit_Tab_HoursHoliday extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("hours_holiday", array("legend"=>Mage::helper("storelocator")->__("Holiday Hours")));

				
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

						$fieldset->addField("holiday_date", "text", array(
						"label" => Mage::helper("storelocator")->__("Holiday Date"),
						"class" => "required-entry",
						"required" => true,
						"name" => "holiday_date",
						));

						$fieldset->addField("holiday_name", "text", array(
						"label" => Mage::helper("storelocator")->__("Name Of The Holiday"),
						"class" => "required-entry",
						"required" => true,
						"name" => "holiday_name",
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
