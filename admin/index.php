<?php
include("auth.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online Feedback System - ADMIN</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>
<body>

	<nav class="navbar navbar-expand-md bg-secondary navbar-dark sticky-top col-lg-12 col-md-12">
		<div class="container">
  <a class="navbar-brand" href="index.php">ADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
   </div>
   <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?info=change_password"><i class="fas fa-key"></i>change password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>logout</a>
      </li>
    </ul>
   </div>
</nav>

<div class="row">
  <div class="col-lg-2 col-md-4 col-sm-12">
    <div id="accordion">

    <div class="list-group">
			<div class="list-group-item">
        <a class="collapsed nav-link text-dark" href="index.php?info=feedback">
        <i class="fas fa-user-alt"></i>Analysis</a>
      </div>
      <div class="list-group-item">
        <a class="collapsed nav-link text-dark" data-toggle="collapse" href="#collapseTwo">
        <i class="fas fa-user-alt"></i>Faculty</a>
      </div>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
          <div class="list-group-item"><a href="index.php?info=add_faculty" class="text-dark"><i class="fas fa-plus"></i>Add Faculty</a></div>
          <div class="list-group-item"><a href="index.php?info=manage_faculty" class="text-dark"><i class="fas fa-eye"></i>Manage Faculty</a></div>
          <div class="list-group-item"><a href="#" onclick="facdelet()" class="text-dark"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete All Faculty</a></div>
      </div>

      <div class="list-group-item">
        <a class="collapsed nav-link text-dark" data-toggle="collapse" href="#collapseThree">
          <i class="fas fa-user-graduate"></i>Student
        </a>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="list-group-item">
          <a href="index.php?info=add_student" class="text-dark"><i class="fas fa-plus"></i>Add student</a>
        </div>
        <div class="list-group-item">
          <a href="index.php?info=manage_student" class="text-dark"><i class="fas fa-eye"></i>Manage student</a>
        </div>

      </div>
         <div class="list-group-item">
        <a class="collapsed nav-link text-dark" data-toggle="collapse" href="#collapsefive">
        <i class="fas fa-book"></i>Subject</a>
      </div>
      <div id="collapsefive" class="collapse" data-parent="#accordion">
          <div class="list-group-item"><a href="index.php?info=add_subject" class="text-dark"><i class="fas fa-plus"></i>Add Subject</a></div>
          <div class="list-group-item"><a href="index.php?info=manage_subject" class="text-dark"><i class="fas fa-eye"></i>Manage Subject</a></div>
        </div>

         <div class="list-group-item">
        <a class="collapsed nav-link text-dark" data-toggle="collapse" href="#collapsesix">
        <i class="fas fa-users"></i>Division</a>
      </div>
      <div id="collapsesix" class="collapse" data-parent="#accordion">
          <div class="list-group-item"><a href="index.php?info=add_division" class="text-dark"><i class="fas fa-plus"></i>Add Division</a></div>
          <div class="list-group-item"><a href="index.php?info=manage_division" class="text-dark"><i class="fas fa-eye"></i>Manage Division</a></div>
        </div>

    </div>
    <div class="list-group-item">
        <a href="#" onclick="delet()"  class="nav-link text-dark"><p class="text-danger"><b>Erase all data</b></p></a>
      </div>

</div>
  </div>

  <div class="col-lg-10 col-md-8 col-sm-12">
   <?php

@$info=$_GET['info'];
if ($info!=="") {
             if ($info=="add_faculty") {
             include('add_faculty.php');
                }
             else if($info=="add_student")
             {
             include('addstudent.php');
             }
             elseif ($info=="manage_student") {
               include ('manage_student.php');
             }elseif ($info=="add_feedback") {
               include ('add_feedback.php');
             }elseif ($info=="manage_feedback") {
               include ('manage_feedback.php');
             }elseif ($info=="add_subject") {
               include ('add_subject.php');
             }elseif ($info=="manage_subject") {
               include ('manage_subject.php');
             }elseif ($info=="add_division") {
               include ('add_division.php');
             }elseif ($info=="manage_division") {
               include ('manage_division.php');
             }elseif ($info=="manage_faculty") {
               include ('manage_faculty.php');
             }elseif ($info=="update_student") {
               include ('update_student.php');
             }elseif ($info=="delete_student") {
               include ('delete_student.php');
             }elseif ($info=="update_faculty") {
               include ('update_faculty.php');
             }elseif ($info=="delete_faculty") {
               include ('delete_faculty.php');
             }elseif ($info=="update_subject") {
               include ('update_subject.php');
             }elseif ($info=="delete_subject") {
               include ('delete_subject.php');
             }elseif ($info=="update_division") {
               include ('update_division.php');
             }elseif ($info=="delete_division") {
               include ('delete_division.php');
             }elseif ($info=="change_password") {
               include ('change_password.php');
             }elseif ($info=="upload_fac") {
               include ('upload_fac.php');
             }elseif ($info=="upload_stu") {
               include ('upload_stu.php');
             }elseif ($info=="feedback") {
               include ('feedback.php');
             }elseif ($info=="delete_database") {
               include ('delete_database.php');
             }elseif ($info=="delete_all_fac") {
               include ('deleteallfaculty.php');
             }elseif ($info=="delete_all_stu") {
               include ('deleteallstu.php');
             }elseif ($info=="update_student_all") {
               include ('update_student_all.php');
             }
                      }

?>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
function delet()
{
  a=confirm('Are You Sure To Remove all the Record ?')
   if(a)
     {
        window.location.href='index.php?info=delete_database';
     }
}

function facdelet()
{
  a=confirm('Are You Sure To Remove all the Record ?')
   if(a)
     {
        window.location.href='index.php?info=delete_all_fac';
     }
}
</script>
