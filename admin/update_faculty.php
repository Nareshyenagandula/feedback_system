<?php
require('../db.php');





if (isset($_REQUEST['email'])) {

  $name = mysqli_real_escape_string($conn, $_REQUEST['fname']);
  $designation = mysqli_real_escape_string($conn, $_REQUEST['designation']);
  $mobileno = mysqli_real_escape_string($conn, $_REQUEST['mobileno']);
   $email = mysqli_real_escape_string($conn, $_REQUEST['email']);


  $update_query="update faculty_reg set fname='$name',designation='$designation',mobileno='$mobileno',email='$email'  where id='".$_GET['id']."'";
  $update_sql=mysqli_query($conn,$update_query);
  $err="<div class='alert alert-success'><b>Faculty Details updated</b></div>";
}
$con=mysqli_query($conn,"select * from faculty_reg where id='".$_GET['id']."'");

$res=mysqli_fetch_assoc($con);  



?>



<div class="container">
  <form class="form-group" method="post" action="">
    <h3 class="mt-3">UPDATE FACULTY</h3><hr>
    <?php 
    echo @$err;

    ?>

  <div class="container">


    <label class="mt-3">Name:</label>
    <input type="text"  name="fname" value="<?php echo @$res['fname'];?>" class="form-control" required>

   <label class="mt-3">Designation:</label>
              <input type="text"  name="designation" value="<?php echo @$res['designation'];?>" class="form-control" required>

   
    <label class="mt-3">Mobile Number:</label>
       <input type="text" class="form-control" value="<?php echo @$res['mobileno'];?>" name="mobileno"  required>

   <label class="mt-3">Email :</label>
              <input type="email" value="<?php echo @$res['email'];?>"  name="email" class="form-control" required>

    <button class="btn btn-success mt-3" type="submit">UPDATE FACULTY</button>
    
   </div>
  </form>
</div>