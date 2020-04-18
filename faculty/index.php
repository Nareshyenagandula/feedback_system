<?php
session_start();

include('auth_faculty.php');
require('../db.php');
$errors = array();
$session=$_SESSION['email'];

$query="select * from faculty_reg where email='$session'";
$sql=mysqli_query($conn,$query);

$row=mysqli_fetch_array($sql);
$name=$row['id'];
$fac_n=$row['fname'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online Feedback System - FACULTY</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>
<body>

	<nav class="navbar navbar-expand-md bg-info navbar-dark sticky-top col-lg-12 col-md-12">
    <div class="container">
      <a class="navbar-brand" href="#">WELCOME,   <?php echo strtoupper($fac_n);   ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-key"></i>change password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>logout</a>
        </li>
      </ul>
    </div>
  </nav>


<div>
	<?php
    include('feedback.php');
	?>
</div>

<?php
if (isset($_REQUEST['update_password'])) {
 $op = mysqli_real_escape_string($conn, $_REQUEST['oldpwd']);
 $np = mysqli_real_escape_string($conn, $_REQUEST['newpwd']);
 $cp=mysqli_real_escape_string($conn,$_REQUEST['cpwd']);
 $opp=md5($op);

$pass_query="select pwd from faculty_reg where email='$session'";
$pass_sql=mysqli_query($conn,$pass_query);

$row=mysqli_fetch_array($pass_sql);
    $p=$row['pwd'];
  if($opp!=$p)
    {
   echo "<script type='text/javascript'> alert('You entered wrong password'); </script>";
    }

  elseif($np!=$cp)
    {
      echo "<script type='text/javascript'> alert('New password and confirm password must be same'); </script>";
    }
  else
  {
    mysqli_query($conn,"update faculty_reg set pwd='".md5($cp)."' where email='$session'");
   echo "<script type='text/javascript'> alert('Password changed successfully'); </script>";
  }
  }
?>
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="dialog">
    <div class="modal-content">
      <div class="modal-body">
       <form class="form-group" method="post" action="">
         <label class="mt-2">OLD PASSWORD:</label>
         <input type="password" name="oldpwd" class="form-control" required>
         <label class="mt-2">NEW PASSWORD:</label>
         <input type="password" name="newpwd" class="form-control" required>
         <label class="mt-2">CONFIRM PASSWORD:</label>
         <input type="password" name="cpwd" class="form-control" required>
         <button class="btn btn-success mt-2" type="submit" name="update_password">SUBMIT</button>
       </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
