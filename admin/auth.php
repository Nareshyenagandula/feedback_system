<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location:../index.php?info=admin_login");
exit(); }
?>