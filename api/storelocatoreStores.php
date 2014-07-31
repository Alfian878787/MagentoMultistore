<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 29/07/14
 * Time: 15:10
 * http://learning1.lc/api/storelocatoreStores.php?s=1&w=10&lat=51.823872&lng=-3.019166&lb=0&le=100$m=false
 */

header('Content-Type: application/json');
require("dbConf.php");


$data['status']     = 'OK';
$data['storeCode']  = $storeCode    = ($_GET["s"])      ? $_GET["s"]    : '0';
$data['centerLat']  = $centerLat    = ($_GET["lat"])    ? $_GET["lat"]  : 51.823872;
$data['centerLng']  = $centerLng    = ($_GET["lng"])    ? $_GET["lng"]  : -3.019166;
$data['withIn']     = $withIn       = ($_GET["w"])      ? $_GET["w"]    : 1000;
$data['mile']       = $mile         = ($_GET["m"])      ?  $_GET["m"]   : 'true';

$limitBegain        = ($_GET["lb"])      ? $_GET["lb"]    : 0;
$limitEnd           = ($_GET["le"])      ? $_GET["le"]    : 1000;
$data['limit']      = array($limitBegain, $limitEnd);

$radius = ($mile == 'true') ? 3959 : 6371;
$filterByStore = ($storeCode == 0) ?  NULL : "WHERE store_code='$storeCode'" ;

//$centerLat = 51.823872;
//$centerLng = -3.019166; //    WHERE store_code='$storeCode'  id, lat, lng, branch_name, unique_name,

$query = "SELECT *, ( $radius * acos(
cos( radians($centerLat) )
* cos( radians( lat ) )
* cos( radians( lng ) - radians($centerLng) )
+ sin( radians($centerLat) )
* sin( radians( lat ) ) ) ) AS distance FROM
storelocator_branch_list $filterByStore  HAVING distance < $withIn ORDER BY distance LIMIT $limitBegain , $limitEnd";

//$query = "SELECT * FROM storelocator_branch_list WHERE store_code='1'";
//$query = str_replace ("\r\n", '', $query);

try{
    $result = mysqli_query($con, $query );
}catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}

$array = NULL;
while($row = mysqli_fetch_array($result)) {
    $array[] = array (
        'id'            => $row['id'],
        'store_code'    => $row['store_code'],
        'geo'           => array( $row['lat'], $row['lng']),
        'name'          => $row['branch_name'],
        'unique_name'   => $row['unique_name'],
        'infowindow'    => 'test data'
    );
//    $array[] = $row;
}


$data['records']    = sizeof($array);
$data['query']      = $query;
$data['places']     = $array;


echo json_encode($data);