<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 30/07/14
 * Time: 12:51
 */

$username = "root";
$password = "";
$database = "learning2";

$con=mysqli_connect("localhost",$username,$password,$database);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
