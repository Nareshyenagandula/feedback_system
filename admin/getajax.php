<?php
require('../db.php');

$depname=$_GET["depname"];
$sql_query = $conn->prepare("select name from division where depname=?");
$sql_query->bind_param("s",$depname);
$sql_query->execute();
$result_q = $sql_query->get_result();
while ($row_ajax = $result_q->fetch_assoc()) {
	$divisionname=$row_ajax['name'];
	echo "<option value='".$divisionname."'>";
	 echo $divisionname;
	 echo "</option>";
}
?>
