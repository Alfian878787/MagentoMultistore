<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 10/04/14
 * Time: 14:50
 */

class Solvingmagento_OrderExport_Model_Observer
{
    /**
     * Exports an order after it is placed
     *
     * @param Varien_Event_Observer $observer observer object
     *
     * @return boolean
     */
    public function exportOrder(Varien_Event_Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        Mage::getModel('solvingmagento_orderexport/export')
            ->exportOrder($order);

        return true;

    }
}