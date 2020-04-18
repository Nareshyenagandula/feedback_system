<?php
session_start();
require('db.php');

$errors = array();

if (isset($_POST['email'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $email = htmlspecialchars($email);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $pwd = htmlspecialchars($pwd);
  $pwd = md5($pwd);

  if (empty($email)) {
    array_push($errors, "<div class='alert alert-warning'><b>Email is required</b></div>");
  }
  if (empty($pwd)) {
    array_push($errors, "<div class='alert alert-warning'><b>Password is required</b></div>");
  }
  if (count($errors) == 0) {
    $query = $conn->prepare("SELECT * FROM s_reg WHERE email= ?  AND pwd= ? ");
    $query->bind_param("ss",$email,$pwd);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows == 1) {
      $_SESSION['email'] = $email;
      header("location:student/index.php");
    }else{
        array_push($errors, "<div class='alert alert-warning'><b>Wrong email/password combination</b></div>");
    }
  }
}
?>

<div class="row">
	<div class="col-md-4 col-sm-12" ></div>
	<div class="col-md-4 col-sm-12" >
		<div class="container">
		<h3 class="lead mt-4 text-info"><b>STUDENT LOGIN</b></h3>
		<form class="form-group mt-2 text-center" method="post" action="" >
			 <?php include('errors.php'); ?>
			<input type="email" name="email" class="form-control mt-2" placeholder="EMAIL ID" required>
			<input type="password" name="pwd" class="form-control mt-2" placeholder="PASSWORD" required>
			<button class="btn btn-info mt-2" type="submit">Login</button>
		</form>
	</div>
	</div>
    <div class="col-md-4 col-sm-12" ></div>
 </div>
