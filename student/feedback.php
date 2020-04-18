<?php
error_reporting(-1);

if (isset($_POST['feedback'])) {
  $q1 = mysqli_real_escape_string($conn, $_POST['q1']);
  $q2 = mysqli_real_escape_string($conn, $_POST['q2']);
  $q3 = mysqli_real_escape_string($conn, $_POST['q3']);
  $q4 = mysqli_real_escape_string($conn, $_POST['q4']);
  $q5 = mysqli_real_escape_string($conn, $_POST['q5']);
  $q6 = mysqli_real_escape_string($conn, $_POST['q6']);
  $q7 = mysqli_real_escape_string($conn, $_POST['q7']);
  $q8 = mysqli_real_escape_string($conn, $_POST['q8']);
  $facultyname=mysqli_real_escape_string($conn,$_POST['faculty_id']);
  $facultyname = htmlspecialchars($facultyname);
  $ff=$GLOBALS['facultyname'];

  $subject_detail = $conn->prepare("select * from subject where faculty_id=? and division=? and depname=? and sem=?");
  $subject_detail->bind_param("ssss",$ff,$divv,$dep,$ssem);
  $subject_detail->execute();
  $subject_query = $subject_detail->get_result();
  if ($subject_query->num_rows) {
    while ($rowww = $subject_query->fetch_assoc()) {
    $subject_name=$rowww['id'];
    $subject_id=$GLOBALS['subject_name'];
  }
}
  $check_stu_feed = $conn->prepare("select * from feedback where student_id=? and faculty_id=?");
  $check_stu_feed->bind_param("ss",$student_id,$ff);
  $check_stu_feed->execute();
  $r = $check_stu_feed->get_result();

  if ($r->num_rows == false) {
  $q1_p=($q1/5)*100;
  $q2_p=($q2/5)*100;
  $q3_p=($q3/5)*100;
  $q4_p=($q4/5)*100;
  $q5_p=($q5/5)*100;
  $q6_p=($q6/5)*100;
  $q7_p=($q7/5)*100;
  $q8_p=($q8/5)*100;

  $query = $conn->prepare("INSERT INTO feedback (student_id,faculty_id,subject_id,Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8)VALUES(?,?,?,?,?,?,?,?,?,?,?)");
  $query->bind_param("sssssssssss",$student_id,$ff,$subject_id,$q1_p,$q2_p,$q3_p,$q4_p,$q5_p,$q6_p,$q7_p,$q8_p);

    if ($query->execute()) {
    $msg="<div class='alert alert-success'><b>Feedback successfully submitted</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>Feedback not submitted</b></div>";
    }

  $check = $conn->prepare("select * from percent where faculty_id=? and subject_id=?");
  $check->bind_param("ss",$ff,$subject_id);
  $check->execute();
  $cr = $check->get_result();

    if ($cr->num_rows ==true) {
      $pt=$conn->prepare("select AVG(Q1) as q1,AVG(Q2) as q2, AVG(Q3) as q3, AVG(Q4) as q4, AVG(Q5) as q5, AVG(Q6) as q6, AVG(Q7) as q7, AVG(Q8) as q8  from feedback where faculty_id=? and subject_id=?");
      $pt->bind_param("ss",$ff,$subject_id);
      $pt->execute();
      $pt_dat = $pt->get_result();
      while ($pt_data = $pt_dat->fetch_assoc()) {
        $up_q1=$pt_data['q1'];
        $up_q2=$pt_data['q2'];
        $up_q3=$pt_data['q3'];
        $up_q4=$pt_data['q4'];
        $up_q5=$pt_data['q5'];
        $up_q6=$pt_data['q6'];
        $up_q7=$pt_data['q7'];
        $up_q8=$pt_data['q8'];
      }
    $update_fac = $conn->prepare("update percent set Q1=? ,Q2=? ,Q3=? ,Q4=? ,Q5=? ,Q6=? ,Q7=? ,Q8=? where faculty_id=? and subject_id=? ");
    $update_fac->bind_param("ssssssssss",$up_q1,$up_q2,$up_q3,$up_q4,$up_q5,$up_q6,$up_q7,$up_q8,$ff,$subject_id);
    $update_fac->execute();
    }else{
      $query_s = $conn->prepare("INSERT INTO percent (faculty_id,Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,subject_id)VALUES(?,?,?,?,?,?,?,?,?,?)");
      $query_s->bind_param("ssssssssss",$ff,$q1_p,$q2_p,$q3_p,$q4_p,$q5_p,$q6_p,$q7_p,$q8_p,$subject_id);
      $query_s->execute();
  }

}else
{
   echo "<script type='text/javascript'> alert('You have already given feedback to this faculty'); </script>";
}
}

 ?>
<div class="container">
  <hr>
    <h3 class="mt-3 text-center text-info">FEEDBACK FORM</h3>
    <hr>
<h4 class="">Please give your answer about the following question by circling the given grade on the scale:</h4>
<button type="button" style="font-size:7pt;color:white;background-color:green;border:2px solid #336600;padding:3px">Excellent 5</button>
<button type="button" style="font-size:7pt;color:white;background-color:Brown;border:2px solid #336600;padding:3px">very good 4</button>
<button type="button" style="font-size:7pt;color:white;background-color:blue;border:2px solid #336600;padding:3px">good 3</button>
<button type="button" style="font-size:7pt;color:white;background-color:Black;border:2px solid #336600;padding:3px"> poor 2</button>
<button type="button" style="font-size:7pt;color:white;background-color:red;border:2px solid #336600;padding:3px">fair 1</button>

 <form class="form-group mt-3" method="post" action="">
<table class="table table-bordered">
  <tr>
    <th>Select faculty:</th>
    <td>
      <select class="form-control" name="faculty_id">
      <?php
      $fac_query=$conn->prepare("select subject.faculty_id,fname from subject,faculty_reg where depname=? and sem=? and division=? and subject.faculty_id=faculty_reg.id and subject.faculty_id NOT IN (select faculty_id from feedback where student_id=?)");
      $fac_query->bind_param("ssss",$depname,$semester,$division,$student_id);
      $fac_query->execute();
      $rrr = $fac_query->get_result();
      if ($rrr->num_rows) {
        while ($row_fac_name = $rrr->fetch_assoc()) {
          $facultyid=$row_fac_name['faculty_id'];
           $facultyname=$row_fac_name['fname'];
          echo "<option value='".$facultyid."'>".$facultyname."</option>";
        }
      }else{
        echo "<script type='text/javascript'> alert('THANK YOU, You have given feedback to all faculty'); </script>";
        echo "<option>".'No faculty present'."</option>";
      }
      ?>
    </select>
    </td>
  </tr>
</table>
<div class="mt-3" >
   <?php include('../errors.php');
    echo @$msg;
    ?>
  <table class="mt-3 table table-bordered">

      <div class="row">
        <div class="col-md-6 col-sm-12">
          <td>Q.1] Subject Knowledge?</td>
        </div>
        <div class="col-md-6 col-sm-12">
          <td><input type="radio" name="q1" value="1" required>1</td>
        <td><input type="radio" name="q1" value="2">2</td>
        <td><input type="radio" name="q1" value="3">3</td>
        <td><input type="radio" name="q1" value="4">4</td>
        <td><input type="radio" name="q1" value="5">5</td>
        </div>
      </div>

    <tr>
      <td>Q.2] Interaction with student?</td>
      <td><input type="radio" name="q2" value="1" required>1</td>
    <td><input type="radio" name="q2" value="2">2</td>
    <td><input type="radio" name="q2" value="3">3</td>
    <td><input type="radio" name="q2" value="4">4</td>
    <td><input type="radio" name="q2" value="5">5</td>
    </tr>
    <tr>
      <td>Q.3] Doubt Solving?</td>
      <td><input type="radio" name="q3" value="1" required>1</td>
    <td><input type="radio" name="q3" value="2">2</td>
    <td><input type="radio" name="q3" value="3">3</td>
    <td><input type="radio" name="q3" value="4">4</td>
    <td><input type="radio" name="q3" value="5">5</td>
    </tr>
    <tr>
      <td>Q.4] HandWriting of her/his work?</td>
      <td><input type="radio" name="q4" value="1" required>1</td>
    <td><input type="radio" name="q4" value="2">2</td>
    <td><input type="radio" name="q4" value="3">3</td>
    <td><input type="radio" name="q4" value="4">4</td>
    <td><input type="radio" name="q4" value="5">5</td>
    </tr>
    <tr>
      <td>Q.5] Communication?</td>
      <td><input type="radio" name="q5" value="1" required>1</td>
    <td><input type="radio" name="q5" value="2">2</td>
    <td><input type="radio" name="q5" value="3">3</td>
    <td><input type="radio" name="q5" value="4">4</td>
    <td><input type="radio" name="q5" value="5">5</td>
    </tr>
    <tr>
      <td>Q.6] Presenting submatter clearly/systematically?</td>
      <td><input type="radio" name="q6" value="1" required>1</td>
    <td><input type="radio" name="q6" value="2">2</td>
    <td><input type="radio" name="q6" value="3">3</td>
    <td><input type="radio" name="q6" value="4">4</td>
    <td><input type="radio" name="q6" value="5">5</td>
    </tr>
    <tr>
      <td>Q.7] Use of ICT tools?</td>
      <td><input type="radio" name="q7" value="1" required>1</td>
    <td><input type="radio" name="q7" value="2">2</td>
    <td><input type="radio" name="q7" value="3">3</td>
    <td><input type="radio" name="q7" value="4">4</td>
    <td><input type="radio" name="q7" value="5">5</td>
    </tr>
    <tr>
      <td>Q.8] Class Control?</td>
      <td><input type="radio" name="q8" value="1" required>1</td>
    <td><input type="radio" name="q8" value="2">2</td>
    <td><input type="radio" name="q8" value="3">3</td>
    <td><input type="radio" name="q8" value="4">4</td>
    <td><input type="radio" name="q8" value="5">5</td>
    </tr>
  </table>
</div>
<button class="btn btn-success mt-3 mb-3 float-right" type="submit" name="feedback">Submit</button>

</form>
</div>
