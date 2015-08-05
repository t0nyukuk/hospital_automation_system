<?php

	include_once 'includes/functions.php';
	include_once 'includes/db_connect.php';

	$query = "SELECT e.id,
					p.name AS name,
					p.lastname AS lastname,
					p.email AS email,
					e.time,
					d.name AS doctor_name,
					d.id AS doctor_id
					FROM email e
						INNER JOIN doctor d ON e.doctor_id = d.id
							JOIN members p ON p.id = e.patient_id
							ORDER BY time ASC";

	$result = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

		echo "<b>Future Rendezvous</b>";
		echo "<table border=1>";
		while($row = mysqli_fetch_array($result)) {
		    $id = $row['id'];
		    $time = $row['time'];
		    $doctor_name = $row['doctor_name'];
		    $doctor_id = $row['doctor_id'];
		    $name = $row['name'];
				$lastname = $row['lastname'];
		    $email = $row['email'];

		    echo "<tr>";
		    	echo "<td>".$id."</td>";
		    	echo "<td>".$time."</td>";
		    	echo "<td>".$username."</td>";
		    	echo "<td>".$email."</td>";
		    	echo "<td>".$doctor_name."</td>";
		    	echo "<td>".$doctor_id."</td>";
		    echo "</tr>";

	    	$sql = "DELETE FROM email WHERE id=".$id;

			$to      = $email;
			$subject = 'New Rendezvous';
			$message = 'Dear ' .$name. ' ' . $lastname . '
You have just added a new rendezvous with '.$doctor_name.' and in '.$time;
			//$headers = 'From: @gmail.com' . "\r\n" .
			//    'Reply-To: yhkalayci@gmail.com' . "\r\n" .
			//    'X-Mailer: PHP/' . phpversion();

			echo $to;
			echo $subject;
			echo $message;
			echo $headers;

			$tmp = mail($to, $subject, $message, $headers);
			echo "<br><br>".$tmp;

			if ($mysqli->query($sql) === TRUE) {
			    //echo "Record deleted successfully";
			} else {
			    echo "Error deleting record: " . $mysqli->error;
			}

		}

		echo "</table>";

?>
