
<?php
require('../db.php');
if(isset($_POST['exl'])){
$query = mysqli_query($conn, 'select * from pfeedback'); // Get data from Database from demo table
 
 
    $delimiter = ",";
    $filename = "programfeedback" . date('Ymd') . ".csv"; // Create file name
     
    //create a file pointer
    $f = fopen('php://memory', 'w'); 
     
    //set column headers
    $fields = array('student_id', 'depname', 'Q1', 'Q2' , 'Q3' , 'Q4' , 'Q5' , 'Q6' , 'Q7');
    fputcsv($f, $fields, $delimiter);
     
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        
        $lineData = array($row['student_id'], $row['depname'], $row['Q1'], $row['Q2'], $row['Q3'], $row['Q4'], $row['Q5'], $row['Q6'], $row['Q7'],);
        fputcsv($f, $lineData, $delimiter);
    }
     
    //move back to beginning of file
    fseek($f, 0);
     
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
     
    //output all remaining data on a file pointer
    fpassthru($f);
}

if(isset($_POST['feedback'])){
$query = mysqli_query($conn, 'select * from percent'); // Get data from Database from demo table
 
 
    $delimiter = ",";
    $filename = "onlinefeedback" . date('Ymd') . ".csv"; // Create file name
     
    //create a file pointer
    $f = fopen('php://memory', 'w'); 
     
    //set column headers
    $fields = array('id', 'faculty_id', 'Q1', 'Q2' , 'Q3' , 'Q4' , 'Q5' , 'Q6' , 'Q7', 'Q8', 'subject_id');
    fputcsv($f, $fields, $delimiter);
     
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        
        $lineData = array($row['id'], $row['faculty_id'], $row['Q1'], $row['Q2'], $row['Q3'], $row['Q4'], $row['Q5'], $row['Q6'], $row['Q7'], $row['Q8'], $row['subject_id'],);
        fputcsv($f, $lineData, $delimiter);
    }
     
    //move back to beginning of file
    fseek($f, 0);
     
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
     
    //output all remaining data on a file pointer
    fpassthru($f);
}

if(isset($_POST['student'])){
$query = mysqli_query($conn, 'select * from s_reg'); // Get data from Database from demo table
 
 
    $delimiter = ",";
    $filename = "students" . date('Ymd') . ".csv"; // Create file name
     
    //create a file pointer
    $f = fopen('php://memory', 'w'); 
     
    //set column headers
    $fields = array('id', 'depname', 'year','Batch','semester', 'division', 'mobileno', 'email');
    fputcsv($f, $fields, $delimiter);
     
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        
        $lineData = array($row['id'], $row['depname'], $row['year'], $row['Batch'], $row['semester'], $row['division'], $row['mobileno'], $row['email']);
        fputcsv($f, $lineData, $delimiter);
    }
     
    //move back to beginning of file
    fseek($f, 0);
     
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
     
    //output all remaining data on a file pointer
    fpassthru($f);
}


if(isset($_POST['faculty'])){
$query = mysqli_query($conn, 'select * from faculty_reg'); // Get data from Database from demo table
 
 
    $delimiter = ",";
    $filename = "faculty" . date('Ymd') . ".csv"; // Create file name
     
    //create a file pointer
    $f = fopen('php://memory', 'w'); 
     
    //set column headers
    $fields = array('id', 'Name', 'branch','designation','mobile','email');
    fputcsv($f, $fields, $delimiter);
     
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        
        $lineData = array($row['id'], $row['fname'], $row['branch'], $row['designation'],$row['mobileno'],$row['email']);
        fputcsv($f, $lineData, $delimiter);
    }
     
    //move back to beginning of file
    fseek($f, 0);
     
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
     
    //output all remaining data on a file pointer
    fpassthru($f);
}

?>