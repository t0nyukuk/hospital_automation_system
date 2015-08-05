<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	session_start();
	//echo $_SESSION['uid'];
	echo check_login($mysqli);
	check_session();

?>

<form method="POST" action='includes/logout.php'>
	<input type="submit" name="logout"  value="Logout">
</form>