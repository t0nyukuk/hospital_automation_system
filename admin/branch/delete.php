<?php
	include_once '../../includes/functions.php';
	include_once '../../includes/db_connect.php';
	include_once '../admin_config.php';

	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		//echo "yanlis aq";
		header('Location: ../main.php');
	}

	$sql = "DELETE FROM branch WHERE id=".$_GET['id'];

	if ($mysqli->query($sql) === TRUE) {
	    //echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $mysqli->error;
	}

	$mysqli->close();

	header('Location: list.php');

?>