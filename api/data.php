<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 29/07/14
 * Time: 15:10
 * http://learning1.lc/api/data.php?s=1&w=10&lat=51.823872&lng=-3.019166&lb=0&le=100
 */

header('Content-Type: application/json');
require("dbConf.php");


$data['status']     = 'OK';
$data['storeCode']  = $storeCode    = $_GET["s"];
$data['centerLat']  = $centerLat    = $_GET["lat"];
$data['centerLng']  = $centerLng    = $_GET["lng"];
$data['withIn']     = $withIn       = $_GET["w"];

$limitBegain        = $_GET["lb"];
$limitEnd           = $_GET["le"];
$data['limit']      = array($limitBegain, $limitEnd);

$mile = TRUE;
$radius = ($mile) ? 3959 : 6371;

//$centerLat = 51.823872;
//$centerLng = -3.019166; //    WHERE store_code='$storeCode'  id, lat, lng, branch_name, unique_name,

$query = "SELECT *, ( $radius * acos(
cos( radians($centerLat) )
* cos( radians( lat ) )
* cos( radians( lng ) - radians($centerLng) )
+ sin( radians($centerLat) )
* sin( radians( lat ) ) ) ) AS distance FROM
storelocator_branch_list HAVING distance < $withIn ORDER BY distance LIMIT $limitBegain , $limitEnd";

try{
    $result = mysqli_query($con, $query );
}catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}

$array = NULL;
while($row = mysqli_fetch_array($result)) {
    $array[] = array (
        'id'            => $row['id'],
        'geo'           => array( $row['lat'], $row['lng']),
        'name'          => $row['branch_name'],
        'unique_name'   => $row['unique_name'],
        'infowindow'    => 'test data'
    );
//    $array[] = $row;
}


$data['records']    = sizeof($array);
$data['places']     = $array;


echo json_encode($data);