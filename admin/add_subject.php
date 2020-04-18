<?php
require('../db.php');
$errors = array();
if (isset($_POST['subject_name'])) {

  $faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_name']);
  $faculty_name = htmlspecialchars($faculty_name);
  $depname = mysqli_real_escape_string($conn, $_POST['depname']);
  $depname = htmlspecialchars($depname);
  $semester = mysqli_real_escape_string($conn, $_POST['sem']);
  $semester = htmlspecialchars($semester);
  $subject = mysqli_real_escape_string($conn, $_POST['subject_name']);
  $subject = htmlspecialchars($subject);
  $division = mysqli_real_escape_string($conn, $_POST['division']);
  $division = htmlspecialchars($division);

  $user_check_query = $conn->prepare("SELECT * FROM subject WHERE faculty_id=? AND depname=? AND sem=? AND subject_name=? and division=? LIMIT 1");
  $user_check_query->bind_param("sssss",$faculty_name,$depname,$semester,$subject,$division);
  $user_check_query->execute();
  $userr= $user_check_query->get_result();
  $user = $userr->fetch_assoc();

    if ($user['faculty_id'] === $faculty_name){
    	if($user['depname'] === $depname){
    		if($user['sem'] === $semester) {
          if ($user['subject_name']===$subject) {
            if ($user['division']===$division) {

      array_push($errors, "<div class='alert alert-warning'><b>Subject already exists</b></div>");
    }}}}}

  if (count($errors) == 0) {
    $query = $conn->prepare("INSERT INTO subject (faculty_id,depname,sem,subject_name,division)VALUES(?,?,?,?,?)");
    $query->bind_param("sssss",$faculty_name,$depname,$semester,$subject,$division);
    if ($query->execute()) {
    $msg="<div class='alert alert-success'><b>subject added successfully</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>subject not added</b></div>";
      echo mysqli_error($conn);
    }
  }
}

?>
<div class="container">
	<h3 class="mt-3">ADD SUBJECT</h3><hr>

	<form class="form-group" method="post" action="">
		 <?php include('../errors.php');
    echo @$msg;

    ?>
    <div class="container">
      <label class="mt-3">Subject Name:</label>
    <input type="text" name="subject_name" class="form-control" required>

		<label class="mt-3">Faculty:</label>
		<select class="form-control" name="faculty_name">
      <?php
      $student_query="select * from faculty_reg";
      $student_sql=mysqli_query($conn,$student_query);
      while ($row=mysqli_fetch_array($student_sql)) {

      echo "<option value='".$row['id']."'>".$row['fname']."</option>";    }
      ?>
    </select>
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
		<button class="btn btn-success mt-3" type="submit">ADD SUBJECT</button>
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
