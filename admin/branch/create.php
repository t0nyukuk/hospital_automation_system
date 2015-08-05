<?php
	include_once '../../includes/functions.php';
	include_once '../../includes/db_connect.php';
	include_once '../admin_config.php';

	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		//echo "yanlis aq";
		header('Location: ../main.php');
	}

	if(isset($_GET['submit'])) 
	{ 
		if($_GET['submit']=='create')
		{
		    $sql = "INSERT INTO branch (name)
			VALUES ('".$_GET['name']."')";

			if ($mysqli->query($sql) === TRUE) {
			    //echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $mysqli->error;
			}
		}
		$mysqli->close();
		header('Location: list.php');
	 	//echo $sql;
	}

	echo '<form action="create.php">
			Id:<br>
			<input type="text" name="id" value="" readonly>
			<br>
			Branch Name:<br>
			<input type="text" name="name" value="">
			<br><br>
			<input type="submit" name="submit" value="create">
			<input type="submit" name="submit" value="cancel">
		</form>';
?>