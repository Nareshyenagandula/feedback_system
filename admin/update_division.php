<?php
require('../db.php');





if (isset($_REQUEST['name'])) {

  $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
   $depname = mysqli_real_escape_string($conn, $_REQUEST['depname']);


  $update_query="update division set name='$name',depname='$depname' where id='".$_GET['id']."'";
  $update_sql=mysqli_query($conn,$update_query);
  $err="<div class='alert alert-success'><b>Division Details updated</b></div>";
}
$con=mysqli_query($conn,"select * from division where id='".$_GET['id']."'");

$res=mysqli_fetch_assoc($con);



?>



<div class="container">
  <h3>UPDATE DIVISION</h3><hr>
  <form class="form-group" method="post" action="">

    <?php
    echo @$err;

    ?>
    <div class="container">
       <label class="mt-3">Division Name:</label>
    <input type="text" name="name" value="<?php echo @$res['name'];?>" class="form-control" required>
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
    <button class="btn btn-success mt-3" type="submit">UPDATE DIVISION</button>
  </div>
  </form>

</div>
