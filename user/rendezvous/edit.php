<?php
	include_once '../../includes/functions.php';
	include_once '../../includes/db_connect.php';
	include_once '../user_config.php';

	date_default_timezone_set('Europe/Istanbul');

	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		//echo "yanlis aq";
		header('Location: ../main.php');
	}

	if(isset($_GET['submit'])) 
	{ 
		if($_GET['submit']=='save')
		{
			$tmp = date( "Y-m-d H:i:s", strtotime($_GET['time']) );
			//echo $tmp;
			if( $_GET['id']=="" || $_GET['time']=="" || $_GET['doctor_id']=="" ){
				echo "Some fields are missed.";
			}
			else{
				$rend_time = date( "Y-m-d H:i:s", strtotime($_GET['time']) );
				$sql = "UPDATE rendezvous SET 
				time='".$rend_time."',
				doctor_id='". $_GET['doctor_id'] ."'
				WHERE id=".$_GET['id'];

				//echo $sql;

			    //$sql = "INSERT INTO doctor (name,age,yearsOfServices,branch_id)
				//VALUES ('".$_GET['name']."','".$_GET['age']."','".$_GET['yearsOfServices']."','".$_GET['branch']."')";
				if ($mysqli->query($sql) === TRUE) {
				    //echo "New record created successfully";
				} else {
				    echo "Error: " . $sql . "<br>" . $mysqli->error;
				}
				$mysqli->close();
				header('Location: list.php');
			}
		}
		else{
			header('Location: list.php');
		}
	 	//echo $sql;
	}

	$query = "SELECT id, name FROM doctor";

	$result = mysqli_query($mysqli,$query)or die(mysqli_error());

	$time = date( "Y-m-d\TH:i:s", strtotime($_GET['time']) );

	echo '<form action="edit.php" id="rendezvous_form">
			Id:<br>
			<input type="text" name="id" value="'.$_GET['id'].'" readonly>
			<br>
			Date and Time:<br>
			<input type="datetime-local" name="time" value="'.$time.'" >
			<br>
			Doctor:<br>';

	echo '<select name="doctor_id" form="rendezvous_form">';
		
		while($row = mysqli_fetch_array($result)) {
		    $id = $row['id'];
		    $name = $row['name'];

		    if( $id != $_GET['doctor_id'] )
		    	echo "<option value=".$id.">".$name."</option>";
		    else
		    	echo "<option selected='selected' value=".$id.">".$name."</option>";

		} 
	
	echo '</select>';

	echo	'<br><br>
			<input type="submit" name="submit" value="save">
			<input type="submit" name="submit" value="cancel">
		</form>';
?>