<?php
session_start();
include('auth_student.php');
require('../db.php');

$errors = array();
$session = $_SESSION['email'];

$student_details = $conn->prepare("SELECT id, fname, depname,year,semester,division,mobileno,rollno FROM s_reg where email=?");
$student_details->bind_param("s",$session);
$student_details->execute();
$result = $student_details->get_result();
if ($result->num_rows) {
  while ($row = $result->fetch_assoc()) {
    $id=$row["id"];
    $student_id=$GLOBALS['id'];
    $fname=$row["fname"];
    $depname=$row["depname"];
    $dep=$GLOBALS['depname'];
    $year=$row["year"];
    $division=$row["division"];
    $divv=$GLOBALS['division'];
    $mobileno=$row["mobileno"];
    $rollno=$row["rollno"];
    $rolln=$GLOBALS["rollno"];
    $semester=$row["semester"];
    $ssem=$GLOBALS['semester'];
  }
}
?>
