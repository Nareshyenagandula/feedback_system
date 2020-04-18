<?php
require('../db.php');

$email="";
$errors = array();
if (isset($_POST['student'])) {

  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $fname = htmlspecialchars($fname);
  $depname = mysqli_real_escape_string($conn, $_POST['depname']);
  $depname = htmlspecialchars($depname);
  $year=mysqli_real_escape_string($conn,$_POST['year']);
  $year = htmlspecialchars($year);
  $sem=mysqli_real_escape_string($conn,$_POST['sem']);
  $sem = htmlspecialchars($sem);
  $division=mysqli_real_escape_string($conn,$_POST['division']);
  $division = htmlspecialchars($division);
  $rollno=mysqli_real_escape_string($conn,$_POST['rollno']);
  $rollno = htmlspecialchars($rollno);
  $mobileno = mysqli_real_escape_string($conn, $_POST['mobileno']);
  $mobileno = htmlspecialchars($mobileno);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $email = htmlspecialchars($email);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
  $pwd = htmlspecialchars($pwd);
  $pwdd = md5($pwd);

 if(strlen($mobileno)<10 || strlen($mobileno)>10)
     { array_push($errors, "<div class='alert alert-warning'><b>Mobile number must be 10 digit</b></div>"); }

     $user_check_query = $conn->prepare("SELECT * FROM s_reg WHERE email=?  LIMIT 1");
     $user_check_query->bind_param("s",$email);
     $user_check_query->execute();
     $userr= $user_check_query->get_result();
     $user = $userr->fetch_assoc();

    if ($user['email'] === $email) {
      array_push($errors, "<div class='alert alert-warning'><b>Email already exists</b></div>");
    }

  if (count($errors) == 0) {
    $query = $conn->prepare("INSERT INTO s_reg (fname,depname,year,semester,division,mobileno,email,rollno,pwd)VALUES(?,?,?,?,?,?,?,?,?)");
    $query->bind_param("sssssssss",$fname,$depname,$year,$sem,$division,$mobileno,$email,$rollno,$pwdd);

    if ($query->execute()) {
    $msg="<div class='alert alert-success'><b>Student added successfully</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>Student not added</b></div>";
      echo mysqli_error($conn);
    }
  }
}
?>
<div class="container">
  <div class="float-right">
 <form method="post" action="index.php?info=upload_stu" enctype="multipart/form-data" class="form-group">
  <input type="file" name="file" accept=".csv" required >
  <button type="submit" name="upload" value="upload">Upload</button>
 </form>
</div>
  <form class="form-group" method="post" action="">
    <h3 class="mt-3">ADD STUDENT</h3><hr>
    <?php include('../errors.php');
    echo @$msg;
    ?>
   <div class="container">
    <label class="mt-3">Name:</label>
    <input type="text" name="fname" class="form-control" required>
    <label class="mt-3">Department:</label>
    <select class="form-control" name="depname" onchange="change_depname()" id="depname_id">
      <option>*select department*</option>
      <option value="Humanity">Humanity</option>
    	<option value="Computer">Computer</option>
    	<option value="IT">IT</option>
    	<option value="Civil">Civil</option>
    	<option value="ETRX">ETRX</option>
    	<option value="EXTC">EXTC</option>
    </select>
    <label class="mt-3">Year:</label>
    <select class="form-control" name="year" id="year_id">
      <option>*select year*</option>
    	<option value="first year">First Year</option>
    	<option value="second year">Second Year</option>
    	<option value="third year">Third Year</option>
    	<option value="final year">Final Year</option>
    </select>
    <label class="mt-3">Semester:</label>
    <select class="form-control" name="sem">
      <option>*select semester*</option>
      <option value="I">I</option>
      <option value="II">II</option>
      <option value="III">III</option>
      <option value="IV">IV</option>
      <option value="V">V</option>
      <option value="VI">VI</option>
      <option value="VII">VII</option>
      <option value="VIII">VIII</option>
    </select>
    <label class="mt-3">Div:</label>
    <select class="form-control" name="division" id="div">

    </select>

    <label class="mt-3">Mobile No:</label>
    <input type="text" name="mobileno" class="form-control" required>
    <label class="mt-3">Email Id:</label>
    <input type="email" name="email" class="form-control" required>
    <label class="mt-3">Roll No:</label>
    <input type="text" name="rollno" class="form-control" required>
    <label class="mt-3">Password:</label>
    <input type="password" name="pwd" class="form-control" required>
     </div>
    <button class="btn btn-success mt-3" type="submit" name="student">ADD STUDENT</button>

   </div>
  </form>
</div>
<script type="text/javascript">
  function change_depname() {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","getajax.php?depname="+document.getElementById("depname_id").value,false);
    xmlhttp.send(null);
    document.getElementById("div").innerHTML=xmlhttp.responseText;
  }
</script>
