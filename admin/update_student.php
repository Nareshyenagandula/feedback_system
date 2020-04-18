<?php
require('../db.php');





if (isset($_POST['email'])) {

  $fname = mysqli_real_escape_string($conn, $_REQUEST['fname']);
  $depname = mysqli_real_escape_string($conn, $_REQUEST['depname']);
  $year=mysqli_real_escape_string($conn,$_REQUEST['year']);
  $sem=mysqli_real_escape_string($conn,$_REQUEST['sem']);
  $division=mysqli_real_escape_string($conn,$_REQUEST['division']);
  $rollno=mysqli_real_escape_string($conn,$_REQUEST['rollno']);
  $mobileno = mysqli_real_escape_string($conn, $_REQUEST['mobileno']);
  $email = mysqli_real_escape_string($conn, $_REQUEST['email']);



  $update_query="update s_reg set fname='$fname',depname='$depname',year='$year',semester='$sem',division='$division',mobileno='$mobileno',email='$email',rollno='$rollno' where id='".$_GET['id']."'";
  $update_sql=mysqli_query($conn,$update_query);
  $err="<div class='alert alert-success'><b>Student Details updated</b></div>";
}
$con=mysqli_query($conn,"select * from s_reg where id='".$_GET['id']."'");

$res=mysqli_fetch_assoc($con);  


?>



<div class="container">
  <form class="form-group" method="post" action="">
    <h3 class="mt-3">UPDATE STUDENT</h3><hr>
    <?php 
    echo @$err;

    ?>

   <div class="container">
    <label class="mt-3">Name:</label>
    <input type="text" name="fname" value="<?php echo @$res['fname'];?>" class="form-control" required>
    <label class="mt-3">Department:</label>
   <select class="form-control" name="depname">
      <option value="Computer"
      <?php
      if ($res['depname']=='Computer') {
        echo "selected";
      }
      ?>
      >Computer</option>
      <option value="IT"
      <?php
      if ($res['depname']=='IT') {
        echo "selected";
      }
      ?>
      >IT</option>
      <option value="Civil"
      <?php
      if ($res['depname']=='Civil') {
        echo "selected";
      }
      ?>
      >Civil</option>
      <option value="ETRX"
      <?php
      if ($res['depname']=='ETRX') {
        echo "selected";
      }
      ?>
      >ETRX</option>
      <option value="EXTC"
      <?php
      if ($res['depname']=='EXTC') {
        echo "selected";
      }
      ?>
      >EXTC</option>
    </select>
    <label class="mt-3">Year:</label>
    <select class="form-control" name="year">
       <option value="first year"
       <?php
      if ($res['year']=="first year") {
        echo "selected";
      }
      ?>
       >First Year</option>
      <option value="second year"
      <?php
      if ($res['year']=="second year") {
        echo "selected";
      }
      ?>
      >Second Year</option>
      <option value="third year"
       <?php
      if ($res['year']=="third year") {
        echo "selected";
      }
      ?>
      >Third Year</option>
      <option value="final year"
       <?php
      if ($res['year']=='final year') {
        echo "selected";
      }
      ?>
      >Final Year</option>
    </select>
      <label class="mt-3">Semester:</label>
    <select class="form-control" name="sem">
       <option value="I"
       <?php
       if ($res['semester']=='I') {
         echo "selected";
       }
       ?>
       >I</option>
      <option value="II"
       <?php
       if ($res['semester']=='II') {
         echo "selected";
       }
       ?>
      >II</option>
      <option value="III"
       <?php
       if ($res['semester']=='III') {
         echo "selected";
       }
       ?>
      >III</option>
      <option value="IV"
       <?php
       if ($res['semester']=='IV') {
         echo "selected";
       }
       ?>
      >IV</option>
      <option value="V"
       <?php
       if ($res['semester']=='V') {
         echo "selected";
       }
       ?>
      >V</option>
      <option value="VI"
       <?php
       if ($res['semester']=='VI') {
         echo "selected";
       }
       ?>
      >VI</option>
      <option value="VII" <?php
       if ($res['semester']=='VII') {
         echo "selected";
       }
       ?>
      >VII</option>
      <option value="VIII"
       <?php
       if ($res['semester']=='VIII') {
         echo "selected";
       }
       ?>
      >VIII</option>
    </select>
    <label class="mt-3">Div:</label>
    <select class="form-control" value="<?php echo @$res['division'];?>" name="division">
    	 <?php
      $div_query="select * from division";
      $div_sql=mysqli_query($conn,$div_query);
      $div_rowcount=mysqli_num_rows($div_sql);
      for ($i=1; $i <=$div_rowcount ; $i++) { 
        $div_row=mysqli_fetch_assoc($div_sql);
      ?>
      <option value="<?php echo $div_row['name']  ?>"
        <?php
        if ($res['division']==$div_row['name']) {
          echo "selected";
        }

        ?>
        ><?php echo $div_row['name']  ?></option>
      <?php
    }
    ?>

    </select>
    <label class="mt-3">Mobile No:</label>
    <input type="text" name="mobileno" value="<?php echo @$res['mobileno'];?>" class="form-control" required>
    <label class="mt-3">Email Id:</label>
    <input type="email" name="email" value="<?php echo @$res['email'];?>" class="form-control" required>
    <label class="mt-3">Roll No:</label>
    <input type="text" name="rollno" value="<?php echo @$res['rollno'];?>" class="form-control" required>
    <button class="btn btn-success mt-3" type="submit">UPDATE STUDENT</button>
    
   </div>
  </form>
</div>