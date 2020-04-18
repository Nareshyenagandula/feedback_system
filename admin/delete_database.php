<?php
require('../db.php');
$percent_delete_query=mysqli_query($conn,"delete from percent");

if ($percent_delete_query) {
	$feedback_delete_query=mysqli_query($conn,"delete from feedback");
}else{
	 echo "<script type='text/javascript'> alert('Database not deleted'); </script>";
}

if ($feedback_delete_query) {
	$subject_delete_query=mysqli_query($conn,"delete from subject");
}else{
	echo "<script type='text/javascript'> alert('Database not deleted'); </script>";
}

if ($subject_delete_query) {
	$faculty_delete_query=mysqli_query($conn,"delete from faculty_reg");
}else{
	echo "<script type='text/javascript'> alert('Database not deleted'); </script>";
}

if ($faculty_delete_query) {
	$student_delete_query=mysqli_query($conn,"delete from s_reg");
}else{
	echo "<script type='text/javascript'> alert('Database not deleted'); </script>";
}

if ($student_delete_query) {
	$division_delete_query=mysqli_query($conn,"delete from division");
}else{
	echo "<script type='text/javascript'> alert('Database not deleted'); </script>";
}

if ($division_delete_query) {
	echo "<script type='text/javascript'> alert('Database successfully deleted'); </script>";
}else{
	echo "<script type='text/javascript'> alert('Database not deleted'); </script>";
}

?>
