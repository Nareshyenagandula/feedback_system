<?php
require('../db.php');
$delete = $conn->prepare("delete from s_reg");
$delete->execute();
?>
