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

			if( $_GET['name']=="" || $_GET['birth_date']=="" || $_GET['service_begin_date']=="" || $_GET['branch']=="" ){
				echo "Some fields are missed.";
			}
			else{
			  $sql = "INSERT INTO doctor (name,birth_date,service_begin_date,branch_id)
				VALUES ('".$_GET['name']."','".$_GET['birth_date']."','".$_GET['service_begin_date']."','".$_GET['branch']."')";

				if ($mysqli->query($sql) === TRUE) {
				    //echo "New record created successfully";
				} else {
				    echo "Error: " . $sql . "<br>" . $mysqli->error;
				}
				$mysqli->close();
				header('Location: list.php');
			}
		}
	 	//echo $sql;
	}

	$query = "SELECT id, name FROM branch";

	$result = mysqli_query($mysqli,$query)or die(mysqli_error());



	echo '<form action="create.php" id="doctor_form">
			Id:<br>
			<input type="text" name="id" value="" readonly>
			<br>
			Doctor Name:<br>
			<input type="text" name="name" value="">
			<br>
			Birth Date:<br>
  		<input type="date" name="birth_date" value="'.$_GET['birth_date'].'">
			<br>
			Date of begin to service:<br>
  		<input type="date" name="service_begin_date" value="'.$_GET['service_begin_date'].'">
			<br>
			Branch:<br>
			';

	echo '<select name="branch" form="doctor_form">';

		while($row = mysqli_fetch_array($result)) {
		    $id = $row['id'];
		    $name = $row['name'];

		    echo "<option value=".$id.">".$name."</option>";

		    //echo "<tr><td style='width: 200px;'>".$date."</td><td style='width: 600px;'>".$comment."</td><td>".$amount."</td></tr>";
		}

		//	<option value="saab">Saab</option>
		//	<option value="opel">Opel</option>
		//	<option value="audi">Audi</option>

	echo '</select>';

	echo	'<br><br>
			<input type="submit" name="submit" value="create">
			<input type="submit" name="submit" value="cancel">
		</form>';
?>
