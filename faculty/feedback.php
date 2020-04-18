<div class="container">
  <?php echo @$error; ?>
</div>

<div class="container mt-3">
  <form class="form-inline" method="post" action="">
    <select class="form-control" name="sub">
      <?php
      $subject_name=mysqli_query($conn,"select * from subject where faculty_id='$name'");
      if (mysqli_num_rows($subject_name)>0) {
        while ($subject_detail=mysqli_fetch_array($subject_name)) {
          $sss=$subject_detail['subject_name'].'-'.$subject_detail['division'];
          echo "<option value='".$subject_detail['id']."'>".$subject_detail['subject_name']."-".$subject_detail['division']."</option>";
        }
      }else{
        echo "<option>".'No subject present'."</option>";
      }
      ?>
    </select>
    <button class="btn btn-info ml-3" type="submit" name="subject_search">Show</button>
  </form>
</div>

<?php
  if (isset($_REQUEST['subject_search'])) {
   $fac_sub_name = mysqli_real_escape_string($conn, $_REQUEST['sub']);
    $check_query=mysqli_query($conn,"select * from percent where faculty_id='$name' and subject_id='$fac_sub_name'");
    $count_query=mysqli_query($conn,"select id from feedback where faculty_id='$name'");
    $count_result=mysqli_num_rows($count_query);
      if (mysqli_num_rows($check_query)>0) {
       while ($percent_row=mysqli_fetch_array($check_query)) {
         $percent_q1=$percent_row['Q1'];
         $percent_q2=$percent_row['Q2'];
         $percent_q3=$percent_row['Q3'];
         $percent_q4=$percent_row['Q4'];
         $percent_q5=$percent_row['Q5'];
         $percent_q6=$percent_row['Q6'];
         $percent_q7=$percent_row['Q7'];
         $percent_q8=$percent_row['Q8'];
         $total_percent=($percent_q1+$percent_q2+$percent_q3+$percent_q4+$percent_q5+$percent_q6+$percent_q7+$percent_q8)/8;

         echo "<div class='container mt-3'>";
         echo "<div>";
         echo "Total no of students : <div class='badge badge-pill badge-primary'>",$count_result;
         echo "</div>";
         echo "</div>";
         echo "<table class='table table-bordered  table-hover mt-3'>";
         echo "<tr>";
         echo "<td>Subject Knowledge</td>";
         echo "<td>".$percent_q1."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>Interaction with student</td>";
         echo "<td>".$percent_q2."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>Doubt Solving</td>";
         echo "<td>".$percent_q3."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>HandWriting of her/his work</td>";
         echo "<td>".$percent_q4."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>Communication</td>";
         echo "<td>".$percent_q5."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>Presenting submatter clearly/systematically</td>";
         echo "<td>".$percent_q6."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>Use of ICT tools</td>";
         echo "<td>".$percent_q7."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td>Class Control</td>";
         echo "<td>".$percent_q8."%"."</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<th>OVERALL TOTAL</th>";
         echo "<th>".$total_percent."%"."</th>";
         echo "</tr>";
         echo "</table>";
         echo "</div>";
       }
      }else
      {
        echo "<div class='alert alert-warning mt-3'>FEEDBACK IS NOT GIVEN YET</div>";
      }
    }  
?>
</body>
</html>