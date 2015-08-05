<?php
	include_once '../../includes/db_connect.php';
	include_once '../../includes/functions.php';
	include_once '../admin_config.php';

	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		//echo "yanlis aq";
		header('Location: ../main.php');
	}
	
	if(isset($_GET['submit'])) 
	{ 
		if($_GET['submit']=='save')
		{
		    $name = $_GET['name'];
		    //echo $_GET['name'];
		 	$sql = "UPDATE branch SET name='".$_GET['name']."' WHERE id=".$_GET['id'];   
		 	if ($mysqli->query($sql) === TRUE) {
			    //echo "Record updated successfully";
			} else {
			    echo "Error updating record: " . $conn->error;
			}
		}
		$mysqli->close();
		header('Location: list.php');
	 	//echo $sql;
	}

	echo '<form action="edit.php">
			Id:<br>
			<input type="text" name="id" value="'.$_GET['id'].'" readonly>
			<br>
			Branch Name:<br>
			<input type="text" name="name" value="'.$_GET['name'].'">
			<br><br>
			<input type="submit" name="submit" value="save">
			<input type="submit" name="submit" value="cancel">
		</form>';
?>