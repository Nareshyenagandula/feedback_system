<?php
require('../db.php');
$excel='';
if (isset($_POST["export"])) {
	$sql_excel_query=mysqli_query($conn,"SELECT Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,fname,subject_name,division FROM percent,faculty_reg,subject where percent.faculty_id=faculty_reg.id and percent.subject_id=subject.id");
	if (mysqli_num_rows($sql_excel_query)>0) {
		$excel.='<table class="table" bordered="1">
		<tr>
		<td>Faculty Name</td>
		<td>Subject</td>
		<td>Division</td>
		<td>Q1</td>
		<td>Q2</td>
		<td>Q3</td>
		<td>Q4</td>
		<td>Q5</td>
		<td>Q6</td>
		<td>Q7</td>
		<td>Q8</td>
		</tr>';
		while ($row=mysqli_fetch_array($sql_excel_query)) {
			$excel.='<tr>
			<td>'.$row["fname"].'</td>
			<td>'.$row["subject_name"].'</td>
			<td>'.$row["division"].'</td>
			<td>'.$row["Q1"].'</td>
			<td>'.$row["Q2"].'</td>
			<td>'.$row["Q3"].'</td>
			<td>'.$row["Q4"].'</td>
			<td>'.$row["Q5"].'</td>
			<td>'.$row["Q6"].'</td>
			<td>'.$row["Q7"].'</td>
			<td>'.$row["Q8"].'</td>
			</tr>';
		}
		$excel.='</table>';
		header("content-Type: application/xls");
		header("content-Disposition:attachment; filename=feedback.xls");
		echo $excel;
	}
}
?>
