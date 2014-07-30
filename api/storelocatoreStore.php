<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 29/07/14
 * Time: 15:10
 * http://learning1.lc/api/storelocatoreStore.php?s=abergavenny
 */

header('Content-Type: application/json');
require("dbConf.php");


$data['status']     = 'OK';
$data['unique_name']  = $uniqueName    = ($_GET["s"])      ? $_GET["s"]    : '0';

$query = "SELECT * FROM storelocator_branches WHERE unique_name='".$uniqueName."'";

try{
    $result = mysqli_query($con, $query );
}catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}


$array = NULL;
while($row = mysqli_fetch_array($result)) {
    $array[] = $row;
}

$data['store_details']     =   $array  ;

echo json_encode($data);


