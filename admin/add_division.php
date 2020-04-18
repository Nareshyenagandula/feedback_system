<?php
require('../db.php');
$errors = array();
if (isset($_POST['name'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $name = htmlspecialchars($name);
  $depname = mysqli_real_escape_string($conn, $_POST['depname']);
  $depname = htmlspecialchars($depname);
  if(strlen($name)>1)
      { array_push($errors, "<div class='alert alert-warning'><b>Enter valid Division</b></div>"); }

 $user_check_query = $conn->prepare("SELECT * FROM division WHERE name=? AND depname=?  LIMIT 1");
 $user_check_query->bind_param("ss",$name,$depname);
 $user_check_query->execute();
 $userr = $user_check_query->get_result();
 $user = $userr->fetch_assoc();

    if ($user['name'] === $name){
      if ($user['depname']===$depname) {
      array_push($errors, "<div class='alert alert-warning'><b>Division already exists</b></div>");
    }}

  if (count($errors) == 0) {
    $query = $conn->prepare("INSERT INTO division (name,depname)VALUES(?,?)");
    $query->bind_param("ss",$name,$depname);
    if ($query->execute()) {
    $msg="<div class='alert alert-success'><b>Division added successfully</b></div>";
    }else{
    $msg="<div color><b>Division not added</b></div>";
    }
  }
}
?>

<div class="container">
	<h3>ADD DIVISION</h3><hr>
	<form class="form-group" method="post" action="">

		<?php include('../errors.php');
    echo @$msg;
    ?>
    <div class="container">
      <label class="mt-3">Division Name:</label>
    <input type="text" name="name" class="form-control" required>
       <label class="mt-3">Department:</label>
    <select class="form-control" name="depname">
      <option>*Select department*</option>
      <option value="Humanity">Humanity</option>
      <option value="Computer">Computer</option>
      <option value="IT">IT</option>
      <option value="Civil">Civil</option>
      <option value="ETRX">ETRX</option>
      <option value="EXTC">EXTC</option>
    </select>
		<button class="btn btn-success mt-3" type="submit">ADD DIVISION</button>
	</div>
	</form>
</div>
