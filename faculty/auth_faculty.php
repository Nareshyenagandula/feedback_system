<?php
if(!isset($_SESSION["email"])){
header("Location:../index.php?info=faculty_login");
exit(); }
?>