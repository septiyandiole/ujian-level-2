<?php 
ob_start();

define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "ujian2");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) ;
$query = "SET NAMES utf8" ;
mysqli_query($connection, $query);

// if($connection) {

// echo "We are connected";

// }

?>