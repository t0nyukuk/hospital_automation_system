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

		$query = "SELECT id, name FROM branch";

		$result = mysqli_query($mysqli,$query)or die(mysqli_error());

		echo "<table border=1>";
		echo "<tr>";
			echo "<td>Branch Id</td>";
			echo "<td>Branch Name</td>";
			echo "<td></td>";
			echo "<td></td>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) {
		    $id = $row['id'];
		    $name = $row['name'];

		    echo "<tr>";
		    	echo "<td>";
		    	echo $id;
		    	echo "</td>";
		    	echo "<td>";
		    	echo $name;
		    	echo "</td>";
		    	echo '<td> <a href="edit.php?id='.$id.'&name='.$name.'">Edit</a> </td>';
		    	echo '<td> <a href="delete.php?id='.$id.'&name='.$name.'">Delete</a></td>';

		    echo "</tr>";
		    //echo "<tr><td style='width: 200px;'>".$date."</td><td style='width: 600px;'>".$comment."</td><td>".$amount."</td></tr>";
		}
		echo "</table>";
		echo "<a href='create.php' >Create New Branch</a>"

	?>
