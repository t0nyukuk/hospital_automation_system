<?php
	include_once 'functions.php';
	include_once 'db_connect.php';

	if( isset( $_POST['Submit'] ) && $_POST['Submit']=="Register" ){

		if( $_POST['name']=="" || $_POST['lastname']=="" || $_POST['email']=="" || $_POST['password']=="" )
		{
			echo "Some required fields are missing.";
		}
		else if( $_POST['password'] != $_POST['password2'] )
		{
			echo "Passwords does not match.";
		}
		else{

			$sql = "INSERT INTO members (name,lastname,email,password)
			VALUES ('".$_POST['name']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['password']."')";

			if ($mysqli->query($sql) === TRUE) {
					//echo "New record created successfully";
			} else {
					echo "Error: " . $sql . "<br>" . $mysqli->error;
			}
			$mysqli->close();

			header('Location: ../main.php');
		}

	}
	else if( isset( $_POST['Submit'] ) && $_POST['Submit']=="Cancel" ){
		header('Location: ../main.php');
	}

?>

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<form name="form1" method="post" action="register.php">
			<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
					<td colspan="3"><strong>Member Login </strong></td>
				</tr>
				<tr>
					<td width="78">Name</td>
					<td width="6">:</td>
					<td width="294"><input name="name" type="text" id="name"></td>
				</tr>
				<tr>
					<td width="78">Lastname</td>
					<td width="6">:</td>
					<td width="294"><input name="lastname" type="text" id="lastname"></td>
				</tr>
				<tr>
					<td width="78">Email</td>
					<td width="6">:</td>
					<td width="294"><input name="email" type="text" id="email"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input name="password" type="password" id="password"></td>
				</tr>
				<tr>
					<td>Rewrite Password</td>
					<td>:</td>
					<td><input name="password2" type="password" id="password2"></td>
				</tr>
			</table>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
					<td><input type="submit" name="Submit" value="Register"></td>
					<td><input type="submit" name="Submit" value="Cancel"></td>
				</tr>
			</table>
			</td>
		</form>
	</tr>
</table>
