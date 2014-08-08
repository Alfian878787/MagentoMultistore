<?php
class RymanGroup_StoreLocator_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction(){
		if($this->getRequest()->isPost()){
			$address  = $this->getRequest()->getPost('address');
		}
		$this->loadLayout();
		$this->_initLayoutMessages('customer/session');
        $this->renderLayout();
	}

	public function detailsAction(){
		$this->loadLayout();
        $this->renderLayout();
	}

    /*
     *  Sample URL :: http://learning1.lc/index.php/storelocator/index/customurl
     *
     */
	public function customurlAction(){
        die('I live only once !!! Ha Ha Ha !!! <br />File :: '. __FILE__ .'<br /> Line :: '. __LINE__ );
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $query = "SELECT * FROM storelocator_branch_list";
        $result =  $readConnection->fetchAll($query);

        foreach ($result as $row){
            $url_rewrite    = Mage::getModel('core/url_rewrite');
            $_data = array(
                'url_rewrite_id'    => NULL,
                'store_id'          => $row['store_code'],
                'id_path'           => 'storelocator/index/details/name/'.$row['unique_name'],
                'request_path'      => $row['unique_name'],
                'target_path'       => 'storelocator/index/details/name/'.$row['unique_name'],
                'is_system'         => 0
            );
            $url_rewrite->addData($_data);
            $url_rewrite->save();
            print_r($url_rewrite);
        }
	}
}