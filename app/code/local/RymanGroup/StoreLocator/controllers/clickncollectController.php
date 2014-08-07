<?php
class RymanGroup_StoreLocator_ClicknCollectController extends Mage_Core_Controller_Front_Action
{
	public function indexAction(){
		$this->loadLayout();
		$this->_initLayoutMessages('customer/session');
        $this->renderLayout();
	}
    /*
     *  SimpleCall      http://learning1.lc/index.php/storelocator/clickncollect/stores/
     *  AdvanceCall     http://learning1.lc/index.php/storelocator/clickncollect/store/name/woking
     *  @pram            name        unique_name from storelocator_branches table
     *
     *  @return         stores jSON Data.
     */
	public function storesAction(){
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $storeCode          = $this->getRequest()->getParam('s');
        $centerLat          = $this->getRequest()->getParam('lat');
        $centerLng          = $this->getRequest()->getParam('lng');
        $withIn             = $this->getRequest()->getParam('w');
        $mile               = $this->getRequest()->getParam('m');
        $startFrom          = $this->getRequest()->getParam('start');
        $numberOfRecords    = $this->getRequest()->getParam('rows');

        $data['status']             = 'OK';
        $data['storeCode']          = $storeCode        =  ($storeCode)         ? $storeCode        : '0';
        $data['centerLat']          = $centerLat        =  ($centerLat)         ? $centerLat        : 51.823872;
        $data['centerLng']          = $centerLng        =  ($centerLng)         ? $centerLng        : -3.019166;
        $data['withIn']             = $withIn           =  ($withIn)            ? $withIn           : 1000;
        $data['mile']               = $mile             =  ($mile)              ? $mile             : 'true';
        $data['startFrom']          = $startFrom        =  ($startFrom)         ? $startFrom        : 0;
        $data['numberOfRecords']    = $numberOfRecords  =  ($numberOfRecords)   ? $numberOfRecords  : 10;

        Mage::log( print_r($data, true) , null, 'storeLocator.txt');

        $radius = ($mile == 'true') ? 3959 : 6371;
        $filterByStore = ($storeCode == 0) ?  NULL : "WHERE store_code='$storeCode'" ;

        $query =  "SELECT *, ( $radius
* acos( cos( radians($centerLat) )
* cos( radians( lat ) )* cos( radians( lng )
- radians($centerLng) ) + sin( radians($centerLat) )
* sin( radians( lat ) ) ) ) AS distance
FROM storelocator_branch_list $filterByStore
HAVING distance < $withIn
ORDER BY distance
LIMIT $startFrom , $numberOfRecords";

//        $query = "SELECT * FROM storelocator_branch_list WHERE store_code='1'";

        $result =  $readConnection->fetchAll($query);
        $data['query']      = $query;
        $data['records']    = sizeof($result);
        $data['places']     = $result;

        header('Content-Type: application/json');
        echo json_encode($data);
	}
    /*
     *  SimpleCall      http://learning1.lc/index.php/storelocator/clickncollect/store/
     *  AdvanceCall     http://learning1.lc/index.php/storelocator/clickncollect/store/name/woking
     *  @pram            name        unique_name from storelocator_branches table
     *
     *  @return         store jSON Data.
     */
	public function storeAction(){
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $data['status']         = 'OK';
        $uniqueName = $this->getRequest()->getParam('name');
        $data['unique_name']  = $uniqueName    = ($uniqueName)      ? $uniqueName    : 'woking';


        $query = "SELECT * FROM storelocator_branches WHERE unique_name='".$uniqueName."'";
        $result =  $readConnection->fetchAll($query);
        $data['store_details']  = $result[0];

        header('Content-Type: application/json');
        echo json_encode($data);
	}
}