<?php
	include_once '../../includes/functions.php';
	include_once '../../includes/db_connect.php';
	include_once '../user_config.php';

	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		//echo "yanlis aq";
		header('Location: ../main.php');
	}

?>

<a href = "../main.php" > Go Main Page </a>
	<br><br>
	<?php

		/*$query = "SELECT r.id,
						r.time,
						d.name AS doctor_name,
						d.id AS doctor_id
						FROM rendezvous r
							INNER JOIN doctor d ON r.doctor_id = d.id
								JOIN members p ON p.id = r.patient_id
								WHERE p.id=".$_SESSION['uid']." AND r.time > now() ORDER BY time ASC";*/
		$query = "CALL FutureRendezvous(".$_SESSION['uid'].")";

		//$query = "SELECT id, name, branch_id, age,yearsOfServices FROM doctor";

		$result = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

		echo "<b>Future Rendezvous</b>";
		echo "<table border=1>";
		echo "<tr>";
			echo "<td>Rendezvous Id</td>";
			echo "<td>Date&Time</td>";
			echo "<td>Doctor Name</td>";
			echo "<td>Doctor Id</td>";
			echo "<td></td>";
			echo "<td></td>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) {
		    $id = $row['id'];
		    $time = $row['time'];
		    $doctor_name = $row['doctor_name'];
		    $doctor_id = $row['doctor_id'];

		    echo "<tr>";
		    	echo "<td>".$id."</td>";
		    	echo "<td>".$time."</td>";
		    	echo "<td>".$doctor_name."</td>";
		    	echo "<td>".$doctor_id."</td>";
		    	echo '<td> <a href="edit.php?id='.$id.
		    								'&time='.$time.
		    								'&doctor_id='.$doctor_id.
		    								' ">Edit</a> </td>';
		    	echo '<td> <a href="delete.php?id='.$id.'">Delete</a></td>';
		    echo "</tr>";
		    //echo "<tr><td style='width: 200px;'>".$date."</td><td style='width: 600px;'>".$comment."</td><td>".$amount."</td></tr>";
		}

		echo "</table>";
		echo "<a href='create.php' >Create New Rendezvous</a>";
		echo "<br><br>";

		/*$query = "SELECT r.id,
						r.time,
						d.name AS doctor_name,
						d.id AS doctor_id
						FROM rendezvous r
							INNER JOIN doctor d ON r.doctor_id = d.id
								JOIN members p ON p.id = r.patient_id
								WHERE p.id=".$_SESSION['uid']." AND r.time <= now() ORDER BY time ASC";*/

		$query = "CALL PastRendezvous(".$_SESSION['uid'].")";

		//$query = "SELECT id, name, branch_id, age,yearsOfServices FROM doctor";

		//mysqli_free_result($result);

		$mysqli->next_result();

		$result = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

		echo "<b>Past Rendezvous</b>";
		echo "<table border=1>";
		echo "<tr>";
			echo "<td>Rendezvous Id</td>";
			echo "<td>Date&Time</td>";
			echo "<td>Doctor Name</td>";
			echo "<td>Doctor Id</td>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) {
		    $id = $row['id'];
		    $time = $row['time'];
		    $doctor_name = $row['doctor_name'];
		    $doctor_id = $row['doctor_id'];

		    echo "<tr>";
		    	echo "<td>".$id."</td>";
		    	echo "<td>".$time."</td>";
		    	echo "<td>".$doctor_name."</td>";
		    	echo "<td>".$doctor_id."</td>";
		    	//echo '<td> <a href="edit.php?id='.$id.
		    	//							'&time='.$time.
		    	//							'&doctor_id='.$doctor_id.
		    	//							' ">Edit</a> </td>';
		    	//echo '<td> <a href="delete.php?id='.$id.'">Delete</a></td>';
		    echo "</tr>";
		    //echo "<tr><td style='width: 200px;'>".$date."</td><td style='width: 600px;'>".$comment."</td><td>".$amount."</td></tr>";
		}

		echo "</table>";

	?>
