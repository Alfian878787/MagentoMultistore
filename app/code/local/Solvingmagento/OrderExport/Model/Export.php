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
        $dirPath = Mage::getBaseDir('var') . DS . 'export';

        //if the export directory does not exist, create it
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
        }

        $data = $order->getData();

        $xml = new SimpleXMLElement('<root/>');

        $callback =
            function ($value, $key) use (&$xml, &$callback) {
                if ($value instanceof Varien_Object && is_array($value->getData())) {
                    $value = $value->getData();
                }
                if (is_array($value)) {
                    array_walk_recursive($value, $callback);
                }
                $xml->addChild($key, serialize($value));
            };

        array_walk_recursive($data, $callback);

        file_put_contents(
            $dirPath. DS .$order->getIncrementId().'.xml',
            $xml->asXML()
        );

        return true;
    }
}