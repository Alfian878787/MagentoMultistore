<?php

class RymanGroup_StoreLocator_Block_Adminhtml_Storelocator_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("storelocatorGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("storelocator/storelocator")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("storelocator")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("store_code", array(
				"header" => Mage::helper("storelocator")->__("Store Code"),
				"index" => "store_code",
				));
				$this->addColumn("branch_code", array(
				"header" => Mage::helper("storelocator")->__("Branch Code"),
				"index" => "branch_code",
				));
				$this->addColumn("branch_name", array(
				"header" => Mage::helper("storelocator")->__("Branch Name"),
				"index" => "branch_name",
				));
				$this->addColumn("email1", array(
				"header" => Mage::helper("storelocator")->__("Email "),
				"index" => "email1",
				));
				$this->addColumn("telephone1", array(
				"header" => Mage::helper("storelocator")->__("Telephone 1"),
				"index" => "telephone1",
				));
				$this->addColumn("telephone2", array(
				"header" => Mage::helper("storelocator")->__("Telephone 2"),
				"index" => "telephone2",
				));
				$this->addColumn("fax", array(
				"header" => Mage::helper("storelocator")->__("Fax"),
				"index" => "fax",
				));
				$this->addColumn("address1", array(
				"header" => Mage::helper("storelocator")->__("Address Line 1"),
				"index" => "address1",
				));
				$this->addColumn("address2", array(
				"header" => Mage::helper("storelocator")->__("Address Line 2"),
				"index" => "address2",
				));
				$this->addColumn("town", array(
				"header" => Mage::helper("storelocator")->__("Town"),
				"index" => "town",
				));
				$this->addColumn("city", array(
				"header" => Mage::helper("storelocator")->__("City"),
				"index" => "city",
				));
				$this->addColumn("county", array(
				"header" => Mage::helper("storelocator")->__("County"),
				"index" => "county",
				));
				$this->addColumn("country", array(
				"header" => Mage::helper("storelocator")->__("Country"),
				"index" => "country",
				));
				$this->addColumn("postcode", array(
				"header" => Mage::helper("storelocator")->__("Postcode"),
				"index" => "postcode",
				));
				$this->addColumn("lat", array(
				"header" => Mage::helper("storelocator")->__("Latitude"),
				"index" => "lat",
				));
				$this->addColumn("lng", array(
				"header" => Mage::helper("storelocator")->__("Longitude"),
				"index" => "lng",
				));
				$this->addColumn("map_zoom_list_page", array(
				"header" => Mage::helper("storelocator")->__("Map Zoom List Page"),
				"index" => "map_zoom_list_page",
				));
				$this->addColumn("map_zoom_branch_page", array(
				"header" => Mage::helper("storelocator")->__("Map Zoom Branch Details Page"),
				"index" => "map_zoom_branch_page",
				));
				$this->addColumn("map_branch_img", array(
				"header" => Mage::helper("storelocator")->__("Map Branch Image"),
				"index" => "map_branch_img",
				));
				$this->addColumn("banner", array(
				"header" => Mage::helper("storelocator")->__("Store Banner"),
				"index" => "banner",
				));
				$this->addColumn("branch_title", array(
				"header" => Mage::helper("storelocator")->__("About Branch:"),
				"index" => "branch_title",
				));
				$this->addColumn("location_title", array(
				"header" => Mage::helper("storelocator")->__("About Location"),
				"index" => "location_title",
				));
				$this->addColumn("near_us_title", array(
				"header" => Mage::helper("storelocator")->__("Whats Near Us, Title"),
				"index" => "near_us_title",
				));
				$this->addColumn("aside_img", array(
				"header" => Mage::helper("storelocator")->__("Aside Image"),
				"index" => "aside_img",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_storelocator', array(
					 'label'=> Mage::helper('storelocator')->__('Remove Storelocator'),
					 'url'  => $this->getUrl('*/adminhtml_storelocator/massRemove'),
					 'confirm' => Mage::helper('storelocator')->__('Are you sure?')
				));
			return $this;
		}
			

}