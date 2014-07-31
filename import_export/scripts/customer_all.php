<?php

die('Remove me ....');
require_once("../../shell/abstract.php");
require_once('../Importlib/parsecsv.lib.php');
require_once("Functions.php");
Functions::safeMode(1,  __FILE__, __LINE__ );


class Customer_All extends Mage_Shell_Abstract{
	public function run() {
        $customers = Mage::getModel("customer/customer")->getCollection();
        echo $totalCustomer =  "\n Total Customer :: " . sizeof($customers). "\n\n";
        foreach ($customers as $customer) {
            echo "\n".$customer->getId().$customer->getEmail();
        }
        echo $totalCustomer;
    }
}
$import = new Customer_All();
$import->run();
