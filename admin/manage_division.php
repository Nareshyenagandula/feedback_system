
<div class="container">
	<form class="form-group float-left mt-3" method="post" action="">
		<input type="text" name="name" class="form-control" placeholder="SEARCH DIVISION">
	</form>
</div>

<div class="container">

<?php
require('../db.php');

if (isset($_POST['name'])) {
	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$name = htmlspecialchars($name);
	if ($name!="") {

	$que = mysqli_query($conn,"select * from division where CONCAT(`name`,`depname`) LIKE '%".$name."%'");
	if(mysqli_num_rows($que) > 0){

		echo "<table class='table table-bordered  table-hover mt-3'>";
		echo "<tr>";
		echo "<th>Division</th>";
		echo "<th>Department</th>";
		echo "<th>Update</th>";
		echo "<th>Delete</th>";
		echo "</tr>";

	while($row=mysqli_fetch_array($que))
	{
		echo "<tr>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['depname']."</td>";
		echo "<td><a href='index.php?id=$row[id]&info=update_division'><i class='fas fa-pencil-alt'></i></a></td>";
		echo  "<td><a href='#'  onclick='deletes($row[id])'><i class='fas fa-trash-alt'></i></a></td>";
		echo "</tr>";

	}
	echo "</table>";
}else{
	echo "<script type='text/javascript'>
	alert('Division is not found');
</script>";
}
}else {
	echo "<script type='text/javascript'> alert('Empty Input'); </script>";
}
}
?>
</div>

<script type="text/javascript">
function deletes(id)
{
	a=confirm('Are You Sure To Remove This Record ?')
	 if(a)
     {
        window.location.href='delete_division.php?id='+id;
     }
}
</script>
