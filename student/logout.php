<?php
session_start();
if (session_destroy()) {
	unset($_SESSION['email']);
	header("location:../index.php?info=student_login");
}
?>