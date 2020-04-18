<?php

require('../db.php');
$errors = array(); 

  if (isset($_REQUEST['upload'])) {
    $ok = true;
    $filename = $_FILES['file']['tmp_name'];
    $file = fopen($filename, "r");
    $count=0;
                                      
while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
{   

     $user_check_query_ex = "SELECT * FROM faculty_reg WHERE email='$emapData[3]' LIMIT 1";
  $result_ex = mysqli_query($conn, $user_check_query_ex);
  $user_ex = mysqli_fetch_assoc($result_ex);
  
  if ($user_ex) { 
    if ($user_ex['email'] === $emapData[3]) {
      array_push($errors, "<div class='alert alert-warning'><b>Email already exists</b>-> ".$emapData[3]."</div>");
    }
  }

$count++;

    if (count($errors) == 0 && $count>1){                                 
      $sql = "INSERT into faculty_reg(fname,designation,mobileno,email,pwd) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','".md5($emapData[4])."')";
      $sql_check=mysqli_query($conn,$sql);
    }                                            
    
  }}
?>
<div>
  <?php include('../errors.php');  ?>
</div>