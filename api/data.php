<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 29/07/14
 * Time: 15:10
 * http://learning1.lc/api/data.php?lat=51.823872&lng=-3.019166&w=10
 */

header('Content-Type: application/json');
require("dbConf.php");


$withIn = $_GET["w"];
$mile = TRUE;
$radius = ($mile) ? 3959 : 6371;
$limit = 50;

//$centerLat = 51.823872;
//$centerLng = -3.019166;

$centerLat = $_GET["lat"];
$centerLng = $_GET["lng"];

$query = "SELECT *, ( $radius * acos(
cos( radians($centerLat) )
* cos( radians( lat ) )
* cos( radians( lng ) - radians($centerLng) )
+ sin( radians($centerLat) )
* sin( radians( lat ) ) ) ) AS distance FROM
storelocator_branch_list HAVING distance < $withIn ORDER BY distance LIMIT 0 , $limit";

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
}

$data['status'] = 'OK';
$data['places'] = $array;


echo json_encode($data);