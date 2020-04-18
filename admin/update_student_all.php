<?php
require('../db.php');

$first_year = 'first year';
$second_year = 'second year';
$third_year = 'third year';
$final_year = 'final year';

$sem_1 = 'I';
$sem_2 = 'II';
$sem_3 = 'III';
$sem_4 = 'IV';
$sem_5 = 'V';
$sem_6 = 'VI';
$sem_7 = 'VII';
$sem_8 = 'VIII';

$student_all = $conn->prepare("select * from s_reg");
$student_all->execute();
$check = $student_all->get_result();
if ($check->num_rows > 0) {
  $update_sem_7 = $conn->prepare("update s_reg set semester='VIII' where year=? AND semester=?");
  $update_sem_7->bind_param("ss",$final_year,$sem_7);
  $update_sem_7->execute();

  $update_sem_6 = $conn->prepare("update s_reg set semester='VII',year='final year' where year=? AND semester=?");
  $update_sem_6->bind_param("ss",$third_year,$sem_6);
  $update_sem_6->execute();

  $update_sem_5 = $conn->prepare("update s_reg set semester='VI' where year=? AND semester=?");
  $update_sem_5->bind_param("ss",$third_year,$sem_5);
  $update_sem_5->execute();

  $update_sem_4 = $conn->prepare("update s_reg set semester='V',year='third year' where year=? AND semester=?");
  $update_sem_4->bind_param("ss",$second_year,$sem_4);
  $update_sem_4->execute();

  $update_sem_3 = $conn->prepare("update s_reg set semester='IV' where year=? AND semester=?");
  $update_sem_3->bind_param("ss",$second_year,$sem_3);
  $update_sem_3->execute();

  $update_sem_2 = $conn->prepare("update s_reg set semester='III',year='second year' where year=? AND semester=?");
  $update_sem_2->bind_param("ss",$first_year,$sem_2);
  $update_sem_2->execute();

  $update_sem_1 = $conn->prepare("update s_reg set semester='II' where year=? AND semester=?");
  $update_sem_1->bind_param("ss",$first_year,$sem_1);
  $update_sem_1->execute();


   echo "<script type='text/javascript'> alert('Updated successfully'); </script>";

}else {
   echo "<script type='text/javascript'> alert('Not updated'); </script>";
}

 ?>
