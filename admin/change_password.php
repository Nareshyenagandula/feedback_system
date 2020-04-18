<?php
require('../db.php');
if (isset($_POST['oldpwd'])) {

  $op = mysqli_real_escape_string($conn, $_POST['oldpwd']);
  $op = htmlspecialchars($op);
  $np = mysqli_real_escape_string($conn, $_POST['newpwd']);
  $np = htmlspecialchars($np);
  $cp=mysqli_real_escape_string($conn,$_POST['cpwd']);
  $cp = htmlspecialchars($cp);
  $opp=md5($op);
  $cpp=md5($cp);

  $query = $conn->prepare("select pwd from admin");
  $query->execute();
  $re = $query->get_result();
  $res = $re->fetch_assoc();

  $p=$res['pwd'];
  if ($opp!=$p) {
      $err="<div class='alert alert-warning mt-3'><b>You Enterd wrong old password</b></div>";
  }
 elseif($np!=$cp)
        {
        $err="<div class='alert alert-warning mt-3'><b>New Password and confirm password must be same</b></div>";
        }
    else
    {
      $upd = $conn->prepare("update admin set pwd=?");
      $upd->bind_param("s",$cpp);
      if ($upd->execute()) {
      $err="<div class='alert alert-success mt-3'><b>Password have been Changed successfully !!</b></div>";
    }else {
      $err="<div class='alert alert-success'><b>Unsuccessfully !!</b></div>";
    }
    }
  }
?>

<div class="container">
    <form class="form-group" method="post" action="">
        <?php
        echo  @$err;
        ?><br>
         <label class="mt-2">OLD PASSWORD:</label>
         <input type="password" name="oldpwd" class="form-control" required>
         <label class="mt-2">NEW PASSWORD:</label>
         <input type="password" name="newpwd" class="form-control" required>
         <label class="mt-2">CONFIRM PASSWORD:</label>
         <input type="password" name="cpwd" class="form-control" required>
         <button class="btn btn-success mt-2" type="submit" name="update_password">SUBMIT</button>
       </form>
</div>
