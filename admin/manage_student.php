<div class="container-fluid mt-4">
		<button type="submit" class="btn btn-secondary btn-round" name="update" onclick="update_all()">Update All</button>
		<button type="submit" name="button" class="btn btn-secondary btn-round" onclick="studelet()">Delete All</button>
</div>

<div class="container-fluid table-responsive mt-3">
	<table id="data" class="table table-bordered table-sm" >
		<thead class="thead-light">
			<th>Name</th>
			<th>Department</th>
			<th>Year</th>
			<th>Semester</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Division</th>
			<th>Roll No</th>
			<th>Update</th>
			<th>Delete</th>
		</thead>
		<tbody>
			<?php
			require('../db.php');
			$que = $conn->prepare("select * from s_reg");
			$que->execute();
			$qq = $que->get_result();
			if ($qq->num_rows) {
				while ($row = $qq->fetch_assoc()) {
					echo "<tr>";
					echo "<td>".$row['fname']."</td>";
					echo "<td>".$row['depname']."</td>";
					echo "<td>".$row['year']."</td>";
					echo "<td>".$row['semester']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td>".$row['mobileno']."</td>";
					echo "<td>".$row['division']."</td>";
					echo "<td>".$row['rollno']."</td>";
					echo "<td><a href='index.php?id=$row[id]&info=update_student'><i class='fas fa-pencil-alt'></i></a></td>";
					echo  "<td><a href='#'  onclick='deletes($row[id])'><i class='fas fa-trash-alt'></i></a></td>";
					echo "</tr>";
				}
			}else {
				echo "<script type='text/javascript'> alert('Student record is not present'); </script>";
			}
	?>
		</tbody>
	</table>
</div>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
    $('#data').DataTable();
} );
</script>

<script type="text/javascript">
function deletes(id)
{
	a=confirm('Are You Sure To Remove This Record ?')
	 if(a)
     {
        window.location.href='delete_student.php?id='+id;
     }
}
function update_all()
{
  a=confirm('Are You Sure To update all the Record ?')
   if(a)
     {
        window.location.href='index.php?info=update_student_all';
     }
}
function studelet()
{
  a=confirm('Are You Sure To Remove all the Record ?')
   if(a)
     {
        window.location.href='index.php?info=delete_all_stu';
     }
}
</script>
