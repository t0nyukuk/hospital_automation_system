<?php
include_once 'db_config.php';

session_start();

function login($email, $password, $mysqli) {
	//echo("<script>console.log('PHP: login');</script>");
	if ($stmt = $mysqli->prepare("SELECT id, name, lastname, password, type FROM members WHERE email = ? LIMIT 1"))
	{
		//echo $email;
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($user_id, $name, $lastname, $db_password, $usertype);
        $stmt->fetch();

        //echo("<script>console.log('PHP: ".$user_id.",".$username.",".$db_password.",".$email."');</script>");

        if( $db_password == $password ){

        	$_SESSION['uid']= $user_id;
        	$_SESSION['email']=$email;
        	$_SESSION['usertype']=$usertype;
        	if( $usertype == 0 )
				header('Location: ../admin/main.php');
			if( $usertype == 1 )
				header('Location: ../user/main.php');
        	return true;
        }
        else{
        	return false;
        }

	}
}

function check_login( $mysqli ){

	if( $_SESSION['uid']=="" )
		return false;

	if( $stmt = $mysqli->prepare("SELECT email, type FROM members WHERE id = ? LIMIT 1") )
	{
		$stmt->bind_param('i',$_SESSION['uid']);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($email,$usertype);
		$stmt->fetch();
		if( $email == $_SESSION['email'] && $usertype == $_SESSION['usertype']){
			return true;
		}else{
			return false;
		}

	}

}

function check_page_type( $page_type ){

	if( $_SESSION['usertype'] == $page_type )
		return true;
	else
		return false;

}

function go_main_page(){

	//echo 111111;
	if( $_SESSION['usertype'] == 0 )
		header('Location: admin/main.php');
	else
		header('Location: user/main.php');

}

function check_session(){
	echo $_SESSION['uid'];
	echo $_SESSION['email'];
	echo $_SESSION['usertype'];
}

?>