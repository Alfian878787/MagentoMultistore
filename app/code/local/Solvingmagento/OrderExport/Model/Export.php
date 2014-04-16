<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 10/04/14
 * Time: 14:54
 */

class Solvingmagento_OrderExport_Model_Export
{

    /**
     * Generates an XML file from the order data and places it into
     * the var/export directory
     *
     * @param Mage_Sales_Model_Order $order order object
     *
     * @return boolean
     */
    public function exportOrder($order)
    {
        $StoreName = $order->getStoreName();
        $StoreName = preg_replace('/\s+/', '', $StoreName);
        $StoreName = str_replace('_', '', $StoreName);
        $StoreName = substr($StoreName, 0, 6);
//        Mage::log("##  $StoreName " );
        $dirPath = Mage::getBaseDir('var') . DS . 'order_xml' . DS . $StoreName;


        //if the export directory does not exist, create it
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
        }

        $data = $order->getData();
//        Mage::log( var_dump($data) );

        $xml = new SimpleXMLElement('<root/>');

        $callback =
            function ($value, $key) use (&$xml, &$callback) {
                if ($value instanceof Varien_Object && is_array($value->getData())) {
                    $value = $value->getData();
                }

                if (is_array($value)) {
                    array_walk_recursive($value, $callback);
                }
                Mage::log( $key, serialize($value) );
//                $StoreView = ($key == 'created_in') ? $value : 'UNKNOWN';
                $xml->addChild($key, (string)$value);
            };

        array_walk_recursive($data, $callback);

        file_put_contents(
            $dirPath. DS .$order->getIncrementId().'.xml',
            $xml->asXML()
        );


        return true;
    }
}