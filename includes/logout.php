<?php
	
	include_once 'db_connect.php';
	include_once 'functions.php';
	
	session_destroy();

	//echo 111;
	//echo $_SESSION['uid'];
	header('Location: ../main.php');

?>