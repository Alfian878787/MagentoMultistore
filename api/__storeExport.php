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

//$query = "SELECT * FROM storelocator_branches";
//
//try{
//    $result = mysqli_query($con, $query );
//}catch(Exception $e) {
//    echo 'Message: ' .$e->getMessage();
//}
//$username = "root";
//$password = "";
//$database = "";

$mysqli = new mysqli("localhost", "root", "", "learning2");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = "SELECT * FROM storelocator_branches";
$result = $mysqli->query($query);

while($row = $result->fetch_array())
{
    $rows[] = $row;
}

//foreach($rows as $row)
//{
//    echo $row['branch_name'];
//}




echo json_encode($rows);