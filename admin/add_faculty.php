<?php

require('../db.php');

$errors = array();
if (isset($_POST['email'])) {
  $name = mysqli_real_escape_string($conn, $_POST['fname']);
  $designation = mysqli_real_escape_string($conn, $_POST['designation']);
  $designation = htmlspecialchars($designation);
  $mobileno = mysqli_real_escape_string($conn, $_POST['mobileno']);
  $mobileno = htmlspecialchars($mobileno);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $email = htmlspecialchars($email);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $pwd = htmlspecialchars($pwd);
  $pwd = md5($pwd);

    if(strlen($mobileno)<10 || strlen($mobileno)>10)
     { array_push($errors, "<div class='alert alert-warning'><b>Mobile number must be 10 digit</b></div>"); }

  $user_check_query = $conn->prepare("SELECT * FROM faculty_reg WHERE email=? LIMIT 1");
  $user_check_query->bind_param("s",$email);
  $user_check_query->execute();
  $userr = $user_check_query->get_result();
  $user = $userr->fetch_assoc();

    if ($user['email'] === $email) {
      array_push($errors, "<div class='alert alert-warning'><b>Email already exists</b></div>");
    }

  if (count($errors) == 0) {
    $query = $conn->prepare("INSERT INTO faculty_reg (fname,designation,mobileno,email,pwd)VALUES(?,?,?,?,?)");
    $query->bind_param("sssss",$name,$designation,$mobileno,$email,$pwd);
    if ($query->execute()) {
    $msg="<div class='alert alert-success'><b>Faculty added successfully</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>Faculty not added</b></div>";
    }
  }
}
?>

<div class="container">
<div class="float-right">
 <form method="post" action="index.php?info=upload_fac" enctype="multipart/form-data" class="form-group">
  <input type="file" name="file" accept=".csv" required>
<button type="submit" name="upload" value="upload">Upload</button>
 </form>
</div>

  <form class="form-group" method="post" action="">
    <h3 class="mt-3">ADD FACULTY</h3><hr>
    <?php include('../errors.php');
    echo @$msg;
    ?>
   <div class="container">
    <label class="mt-3">Name:</label>
    <input type="text"  name="fname" class="form-control" required>
   <label class="mt-3">Designation:</label>
              <input type="text"  name="designation" class="form-control" required>
    <label class="mt-3">Mobile Number:</label>
       <input type="text" class="form-control" name="mobileno"  required>
   <label class="mt-3">Email Id :</label>
              <input type="email"   name="email" class="form-control" required>
   <label class="mt-3">Password :</label>
              <input type="password"   name="pwd" class="form-control" required>
    <button class="btn btn-success mt-3" type="submit">ADD FACULTY</button>
   </div>
  </form>
</div>
