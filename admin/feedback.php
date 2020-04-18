
<?php
require('../db.php');
if (isset($_POST['graph'])) {
	 $depname = mysqli_real_escape_string($conn, $_POST['depname']);
  $sem=mysqli_real_escape_string($conn,$_POST['sem']);
    @$div=mysqli_real_escape_string($conn,$_POST['division']);

  $query = "SELECT faculty_reg.fname,Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,division FROM percent,subject,faculty_reg where subject.depname='$depname' and subject.sem='$sem' and subject.division='$div' and subject.faculty_id=faculty_reg.id and subject.id=percent.subject_id and subject.faculty_id=percent.faculty_id";
  $result = mysqli_query($conn, $query);
  $chart_data = '';
  if (mysqli_num_rows($result)>0) {

while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ faculty_name:'".$row["fname"]."',Q1:".$row["Q1"].", Q2:".$row["Q2"].", Q3:".$row["Q3"].", Q4:".$row["Q4"].", Q5:".$row["Q5"].", Q6:".$row["Q6"].", Q7:".$row["Q7"].", Q8:".$row["Q8"]."}, ";
}}else{
  echo "<script type='text/javascript'>
  alert('Feedback for such department and semester is not given yet');
</script>";
}
$chart_data = substr($chart_data, 0, -2);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>
<body>
	<div class="container">
    <div class="row mt-3">
      <div class="col-md-7 col-sm-12">
        <form class="form-inline mt-3" method="post" action="">
          <select class="form-control" name="depname" onchange="change_depname()" id="depname_id">
             <option>select department</option>
                   <option value="Computer">Computer</option>
                    <option value="IT">IT</option>
                   <option value="Civil">Civil</option>
                    <option value="ETRX">ETRX</option>
                   <option value="EXTC">EXTC</option>
          </select>
          <select class="form-control ml-3" name="sem">
          <option>select semester</option>
          <option value="I">I</option>
          <option value="II">II</option>
          <option value="III">III</option>
          <option value="IV">IV</option>
          <option value="V">V</option>
          <option value="VI">VI</option>
          <option value="VII">VII</option>
          <option value="VIII">VIII</option>
          </select>
          <select class="form-control ml-3" name="division" id="div"></select>
          <button class="btn btn-secondary ml-3" type="submit" name="graph">Search</button>
        </form>
      </div>
			<div class="col-md-3 col-sm-12">
				<form class="form-inline mt-3" action="excel.php" method="POST">
					<button type="submit" class="btn btn-secondary btn-round" name="export">Download Excel</button>
				</form>
			</div>
    </div>
	</div>


	<div class="row">
   <div class="col-lg-12 col-md-11 col-sm-8">
     <div class="mt-3" id="chart" style="width: 100%;"></div>
   </div>
  </div>
  <script type="text/javascript">
  function change_depname() {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","getajax.php?depname="+document.getElementById("depname_id").value,false);
    xmlhttp.send(null);
    document.getElementById("div").innerHTML=xmlhttp.responseText;
  }
</script>
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'faculty_name',
 ykeys:['Q1', 'Q2', 'Q3','Q4','Q5','Q6','Q7','Q8'],
 labels:['Q1', 'Q2', 'Q3','Q4','Q5','Q6','Q7','Q8'],
 hideHover:'auto',
});
</script>
</body>
</html>
