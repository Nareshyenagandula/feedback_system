<?php

$host="localhost";
$username="root";
$password="";
$dbname="miniproject";

$conn= mysqli_connect($host,$username,$password,$dbname);
if (!$conn) {
	echo "not connected";
	

}
?>
