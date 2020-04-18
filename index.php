<!DOCTYPE html>
<html>
<head>
	<title>feedback</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-md bg-secondary navbar-dark col-lg-12 col-md-12">
    <div class="container">
        <a class="navbar-brand" href="index.php">ONLINE FEEDBACK SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
      </div>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item mr-3">
        <a class="nav-link" href="index.php?info=faculty_login"><b>Faculty</b></a>
</li>
<li class="nav-item mr-3">
        <a class="nav-link" href="index.php?info=admin_login"><b>Admin</b></a>
</li>
<li class="nav-item mr-3">
        <a class="nav-link" href="index.php?info=student_login"><b>Student</b></a>
    </li>
    </ul>
  </div>
</nav>


<?php
@$info=$_GET['info'];
          if($info!="")
          {
            if($info=="student_login")
             {
             include('student_login.php');
             }
              else if($info=="faculty_login")
             {
             include('faculty_login.php');
             }
             elseif ($info=="admin_login") {
               include('admin_login.php');
          }
          }
?>
</body>
</html>
