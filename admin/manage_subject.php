<div class="container">
	<form class="form-group float-left my-3 " method="post" action="">
		<input type="text" name="subject_name" class="form-control" placeholder="SEARCH SUBJECT">
	</form>
</div>

<div class="container">
<?php
require('../db.php');

if (isset($_POST['subject_name'])) {
	$subject_name=mysqli_real_escape_string($conn,$_POST['subject_name']);
	$subject_name=htmlspecialchars($subject_name);
	if ($subject_name!="") {
	$que=mysqli_query($conn,"select * from subject where CONCAT(`sem`,`depname`,`subject_name`) LIKE '%".$subject_name."%'");
	if(mysqli_num_rows($que) > 0){
		echo "<table class='table table-bordered  table-hover mt-3'>";
		echo "<tr>";
		echo "<th>Subject Name</th>";
		echo "<th>Faculty ID</th>";
		echo "<th>Department</th>";
		echo "<th>Semester</th>";
		echo "<th>Division</th>";
		echo "<th>Update</th>";
		echo "<th>Delete</th>";
		echo "</tr>";

	while($row=mysqli_fetch_array($que))
	{
		$ff=$row['faculty_id'];
		$fac_q=mysqli_query($conn,"select fname from faculty_reg where id='$ff'");
		$fac_qq=mysqli_fetch_array($fac_q);
		echo "<tr>";
		echo "<td>".$row['subject_name']."</td>";
		echo "<td>".$fac_qq['fname']."</td>";
		echo "<td>".$row['depname']."</td>";
		echo "<td>".$row['sem']."</td>";
		echo "<td>".$row['division']."</td>";
		echo "<td><a href='index.php?id=$row[id]&info=update_subject'><i class='fas fa-pencil-alt'></i></a></td>";
		echo  "<td><a href='#'  onclick='deletes($row[id])'><i class='fas fa-trash-alt'></i></a></td>";
		echo "</tr>";

	}
	echo "</table>";
}else{
	echo "<script type='text/javascript'>
	alert('subject is not found');
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
        window.location.href='delete_subject.php?id='+id;
     }
}
</script>
