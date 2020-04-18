<?php include('Student_details.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Feedback System - STUDENT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>
<body>

	<nav class="navbar navbar-expand-md bg-info navbar-dark sticky-top col-lg-12 col-md-12 shadow-sm">
		<div class="container">
  <a class="navbar-brand" href="index.php">WELCOME, <?php  echo strtoupper($fname);  ?></a>
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

<div class="container">
  <div class="form-inline mb-md-3">
         <div class="form-control mt-md-3">
      Department: <?php echo ($depname);  ?>
		</div><hr>
         <div class="form-control mt-md-3">
      Year: <?php echo ($year);  ?>
		</div><hr>

         <div class="form-control mt-md-3">
      Division: <?php echo ($division);  ?>
		</div><hr>
         <div class="form-control mt-md-3">
      Semester: <?php echo ($semester);  ?>
		</div><hr>
  </div>
</div>

<div class="container">
  <div>
   <?php include('feedback.php'); ?>
  </div>
</div>




<?php
if (isset($_POST['update_password'])) {
   $op = mysqli_real_escape_string($conn, $_POST['oldpwd']);
	 $op  = htmlspecialchars($op);
   $np = mysqli_real_escape_string($conn, $_POST['newpwd']);
	 $np = htmlspecialchars($np);
   $cp=mysqli_real_escape_string($conn,$_POST['cpwd']);
	 $cp = htmlspecialchars($cp);
	 $cpp= md5($cp);
   $opp=md5($op);

     $pass_query = $conn->prepare("select pwd from s_reg where email=?");
     $pass_query->bind_param("s",$session);
     $pass_query->execute();
     $result = $pass_query->get_result();
		 if ($result->num_rows) {
		 		 while ($row = $result->fetch_assoc()) {
		 	$p=$row['pwd'];
		 }
	 }
  if($opp!=$p)
    {
   echo "<script type='text/javascript'> alert('You have Entered wrong password'); </script>";
    }

  elseif($np!=$cp)
    {
    echo "<script type='text/javascript'> alert('New password and confirm password must be same'); </script>";
    }
  else
  {
		$up_query = $conn->prepare("update s_reg set pwd=? where email=?");
		$up_query->bind_param("ss",$cpp,$session);
		$up_query->execute();
    echo "<script type='text/javascript'> alert('Password have been Changed successfully'); </script>";
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

</body></html>
