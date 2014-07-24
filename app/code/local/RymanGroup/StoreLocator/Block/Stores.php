<?php
/**
 * MGT-Commerce GmbH
 * http://www.mgt-commerce.com
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@mgt-commerce.com so we can send you a copy immediately.
 *
 * @category    Mgt
 * @package     Mgt_Base
 * @author      Stefan Wieczorek <stefan.wieczorek@mgt-commerce.com>
 * @copyright   Copyright (c) 2012 (http://www.mgt-commerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class RymanGroup_StoreLocator_Block_Stores extends Mage_Core_Block_Template
{
    /*
     * Enable disable test mode
     *
     * TRUE     Log data
     * FALSE    Does not lod data
     * @access  private
     */
    private $_testMode = TRUE;

    /*
     * File to store logs
     *
     * @datatype    string
     * @access      private
     */
    private $_logFile = 'storeLocator.log';

    public function getStores($address=NULL) {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $address = str_replace(' ', '',$address);
        $address =($address)? $address : 'Empty Address' ;
        $this->logData($address, 'Address Check', FALSE);  // DEBUG



        if(empty ($address)){
            $query = 'SELECT * FROM storelocator_branch_list' ;// . $resource->getTableName('catalog/product');
            return $readConnection->fetchAll($query);
        }else {
            $center = $this->getLatLng($address);

            $centerLat = floatval($center['lat']); // 51.677; //
            $centerLng = floatval($center['lng']); //-0.606; //

            $this->logData($centerLat.'/'.$centerLng, 'Center Check ', FALSE);  // DEBUG

            $withIn = 300;
            $mile = TRUE;
            $maxStore = 20;
            $radius = ($mile) ? 3959 : 6371;


            $query = "SELECT *, ( $radius * acos(
cos( radians($centerLat) )
* cos( radians( lat ) )
* cos( radians( lng ) - radians($centerLng) )
+ sin( radians($centerLat) )
* sin( radians( lat ) ) ) ) AS distance FROM
storelocator_branch_list HAVING distance < $withIn ORDER BY distance LIMIT 0 , $maxStore";

            $result = $readConnection->fetchAll($query);
            return $result;
        }
    }

    public function getLatLng($address){
        $url ="http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";
        $data = @file_get_contents($url);
        $data = json_decode($data );
        $center['lat'] = $data->results[0]->geometry->bounds->northeast->lat;
        $center['lng'] = $data->results[0]->geometry->bounds->northeast->lng;
        $this->logData($center, 'Center', TRUE);  // Debug
        return $center;
    }

    public function getStoreDetails($store_id=1) {

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $query = "SELECT * FROM storelocator_branches where id=".$store_id ;// . $resource->getTableName('catalog/product');
        $result =  $readConnection->fetchAll($query);
        $data['store_details'] = $result[0];

        $query = "SELECT day, from_, to_ FROM  storelocator_hours_opening WHERE (branch_id=". $store_id ." AND active=1) ORDER BY  sn ASC";// . $resource->getTableName('catalog/product');
        $data['hours'] =  $readConnection->fetchAll($query);

        $query = "SELECT id, service_name FROM  storelocator_services_store_details WHERE (branch_id=". $store_id ." AND active=1)";// . $resource->getTableName('catalog/product');
        $data['services']  =  $readConnection->fetchAll($query);

        $query = "SELECT holiday_date, holiday_name, from_, to_ FROM  storelocator_hours_holiday WHERE (branch_id=". $store_id ." AND active=1)";// . $resource->getTableName('catalog/product');
        $data['holiday'] =  $readConnection->fetchAll($query);

        $query = "SELECT branch_name, unique_name FROM   storelocator_near_by_details WHERE (branch_id=". $store_id ." AND active=1)";// . $resource->getTableName('catalog/product');
        $data['near_by'] =  $readConnection->fetchAll($query);

        return $data;
    }

    public function numToMin($min){
        $mn = $min%60;
        $hour   = ($min - $mn )/60;
        $ampm   = ($hour < 12 )? 'AM' : 'PM';
        $hour   = ($hour < 12 )? $hour : $hour-12;
        $hour   = ($hour < 10 ) ? '0'.$hour : $hour;
        $mn     = ($mn < 10 ) ? '0'.$mn : $mn;
        return $hour.':'.$mn.$ampm;
    }

    public function logData($data, $name='DATA', $array=TRUE){
        if($this->_testMode == FALSE) {return FALSE;}
        $log  = "\n===================Begaining of $name ========================\n";
        $log .= ($array) ? print_r($data, true) : $data;
        $log .= "\n===================      End of $name ========================\n";
        Mage::log($log, null,$this->_logFile);

        return TRUE;
    }
}