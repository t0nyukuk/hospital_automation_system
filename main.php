<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	if( check_login($mysqli) )
	{
		go_main_page();
	}

?>

<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<form name="form1" method="post" action="includes/login.php">
			<td>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
					<td colspan="3"><strong>Member Login </strong></td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" value="Login"></td>
					</tr>
				</table>
			</td>
		</form>
	</tr>
	<tr>
		<form name="form1" method="post" action="includes/register.php">
			<td>
				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
					<tr>
						<td>
							<center><input type="submit" value="Register"></center>
						</td>
					</tr>
				</table>
			</td>
		</form>
	</tr>
</table>
