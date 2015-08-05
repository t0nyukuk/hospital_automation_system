<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	include_once 'admin_config.php';

	session_start();
	//echo "admin page";
	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		//echo "yanlis aq";
		header('Location: ../main.php');
	}
	//echo $_SESSION['uid'];
	//check_session();

?>

Admin Main Page

<form method="POST" action='branch/list.php'>
	<input type="submit" name="branch_list"  value="List All Branches">
</form>

<form method="POST" action='doctor/list.php'>
	<input type="submit" name="doctor_list"  value="List All Doctors">
</form>

<form method="POST" action='../includes/logout.php'>
	<input type="submit" name="logout"  value="Logout">
</form>
