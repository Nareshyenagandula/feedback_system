<?php
require('../db.php');

	$info=$_GET['id'];
	$delete = $conn->prepare("delete from s_reg where id=?");
	$delete->bind_param("s",$info);
	$delete->execute();
	header("location:index.php?info=manage_student");
?>
