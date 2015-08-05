<?php
	include_once '../../includes/functions.php';
	include_once '../../includes/db_connect.php';
	include_once '../admin_config.php';

	if( !check_login( $mysqli ) || !check_page_type($page_type) ){
		//echo "yanlis aq";
		header('Location: ../main.php');
	}

?>

<a href = "../main.php" > Go Main Page </a>

	<?php

		$query = "SELECT d.id, d.name, d.birth_date, d.service_begin_date, b.name AS branch_name, b.id AS branch_id FROM branch b INNER JOIN doctor d ON b.id = d.branch_id";

		//$query = "SELECT id, name, branch_id, age,yearsOfServices FROM doctor";

		$result = mysqli_query($mysqli,$query)or die(mysqli_error($mysqli));

		echo "<table border=1>";

		echo "<tr>";
			echo "<td>Doctor Id</td>";
			echo "<td>Name</td>";
			echo "<td>Birth Date</td>";
			echo "<td>Service Begin Date</td>";
			echo "<td>Branch Name</td>";
			echo "<td></td>";
			echo "<td></td>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) {
		    $id = $row['id'];
		    $name = $row['name'];
		    $birth_date = $row['birth_date'];
		    $service_begin_date = $row['service_begin_date'];
		    $branch_name = $row['branch_name'];
		    $branch_id = $row['branch_id'];

		    echo "<tr>";
		    	echo "<td>".$id."</td>";
		    	echo "<td>".$name."</td>";
		    	echo "<td>".$birth_date."</td>";
		    	echo "<td>".$service_begin_date."</td>";
		    	echo "<td>".$branch_name."</td>";
		    	echo '<td> <a href="edit.php?id='.$id.
		    								'&name='.$name.
		    								'&birth_date='.$birth_date.
		    								'&service_begin_date='.$service_begin_date.
		    								'&branch='.$branch_id.
		    								' ">Edit</a> </td>';
		    	echo '<td> <a href="delete.php?id='.$id.'">Delete</a></td>';
		    echo "</tr>";
		    //echo "<tr><td style='width: 200px;'>".$date."</td><td style='width: 600px;'>".$comment."</td><td>".$amount."</td></tr>";
		}
		echo "</table>";
		echo "<a href='create.php' >Create New Doctor</a>"

	?>
