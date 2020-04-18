<?php
require('../db.php');





if (isset($_REQUEST['subject_name'])) {

  $faculty_name = mysqli_real_escape_string($conn, $_REQUEST['faculty_name']);
  $depname = mysqli_real_escape_string($conn, $_REQUEST['depname']);
  $semester = mysqli_real_escape_string($conn, $_REQUEST['sem']);
  $subject = mysqli_real_escape_string($conn, $_REQUEST['subject_name']);
  $division = mysqli_real_escape_string($conn, $_REQUEST['division']);


  $update_query="update subject set faculty_id='$faculty_name',depname='$depname',sem='$semester',subject_name='$subject',division='$division' where id='".$_GET['id']."'";
  $update_sql=mysqli_query($conn,$update_query);
  $err="<div class='alert alert-success'><b>Subject Details updated</b></div>";
}
$con=mysqli_query($conn,"select * from subject where id='".$_GET['id']."'");

$ress=mysqli_fetch_assoc($con);



?>



<div class="container">
  <h3 class="mt-3">UPDATE SUBJECT</h3><hr>

  <form class="form-group" method="post" action="">
     <?php
    echo @$err;

    ?>
    <div class="container">
      <label class="mt-3">Subject Name:</label>
    <input type="text" name="subject_name" value="<?php echo @$ress['subject_name'];?>" class="form-control" required>

    <label class="mt-3">Faculty:</label>
    <select class="form-control" name="faculty_name">
       <?php
      $fac_query="select * from faculty_reg";
      $fac_sql=mysqli_query($conn,$fac_query);
      $fac_rowcount=mysqli_num_rows($fac_sql);
      for ($i=1; $i <=$fac_rowcount ; $i++) {
        $fac_row=mysqli_fetch_assoc($fac_sql);
      ?>
      <option value="<?php echo $fac_row['id']  ?>"
        <?php
        if ($ress['faculty_id']==$fac_row['id']) {
          echo "selected";
        }

        ?>

        ><?php echo $fac_row['fname']  ?></option>
      <?php
    }
    ?>
    </select>
  <label class="mt-3">Department:</label>
    <select class="form-control" name="depname">
      <option value="Computer"
      <?php
      if ($ress['depname']=='Computer') {
        echo "selected";
      }
      ?>
      >Computer</option>
      <option value="IT"
      <?php
      if ($ress['depname']=='IT') {
        echo "selected";
      }
      ?>
      >IT</option>
      <option value="Civil"
      <?php
      if ($ress['depname']=='Civil') {
        echo "selected";
      }
      ?>
      >Civil</option>
      <option value="ETRX"
      <?php
      if ($ress['depname']=='ETRX') {
        echo "selected";
      }
      ?>
      >ETRX</option>
      <option value="EXTC"
      <?php
      if ($ress['depname']=='EXTC') {
        echo "selected";
      }
      ?>
      >EXTC</option>
    </select>
    </select>
     <label class="mt-3">Semester:</label>
     <select class="form-control" name="sem">
       <option value="I"
       <?php
       if ($ress['sem']=='I') {
         echo "selected";
       }
       ?>
       >I</option>
      <option value="II"
       <?php
       if ($ress['sem']=='II') {
         echo "selected";
       }
       ?>
      >II</option>
      <option value="III"
       <?php
       if ($ress['sem']=='III') {
         echo "selected";
       }
       ?>
      >III</option>
      <option value="IV"
       <?php
       if ($ress['sem']=='IV') {
         echo "selected";
       }
       ?>
      >IV</option>
      <option value="V"
       <?php
       if ($ress['sem']=='V') {
         echo "selected";
       }
       ?>
      >V</option>
      <option value="VI"
       <?php
       if ($ress['sem']=='VI') {
         echo "selected";
       }
       ?>
      >VI</option>
      <option value="VII" <?php
       if ($ress['sem']=='VII') {
         echo "selected";
       }
       ?>
      >VII</option>
      <option value="VIII"
       <?php
       if ($ress['sem']=='VIII') {
         echo "selected";
       }
       ?>
      >VIII</option>
    </select>

     <label class="mt-3">Division:</label>
    <select class="form-control" name="division">
       <?php
      $div_query="select * from division";
      $div_sql=mysqli_query($conn,$div_query);
      $div_rowcount=mysqli_num_rows($div_sql);
      for ($i=1; $i <=$div_rowcount ; $i++) {
        $div_row=mysqli_fetch_assoc($div_sql);
      ?>
      <option value="<?php echo $div_row['name']  ?>"
        <?php
        if ($ress['division']==$div_row['name']) {
          echo "selected";
        }

        ?>
        ><?php echo $div_row['name']  ?></option>
      <?php
    }
    ?>
    </select>
    <button class="btn btn-success mt-3" type="submit">UPDATE SUBJECT</button>
  </div>
  </form>
</div>
