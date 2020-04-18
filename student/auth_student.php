<?php
if(!isset($_SESSION["email"])){
header("Location:../index.php?info=student_login");
exit(); }
?>
