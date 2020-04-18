<?php
require('../db.php');
$delete = $conn->prepare("delete from faculty_reg");
$delete->execute();
?>
