<?php
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	include_once 'user_config.php';

	session_start();
	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		header('Location: ../main.php');
	}
	//echo $_SESSION['uid'];
	//echo check_login($mysqli);
	//check_session();

?>

User Main Page

<form method="POST" action='rendezvous/list.php'>
	<input type="submit" name="rendezvous_list"  value="List All Rendezvous">
</form>

<form method="POST" action='../includes/logout.php'>
	<input type="submit" name="logout"  value="Logout">
</form>