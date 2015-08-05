<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
//sec_session_start(); // Our custom secure way of starting a PHP session.

session_start();

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // The hashed password.
        
    //echo $email;

    if (login($email, $password, $mysqli) == true) {
        // Login success 
        //header("location:login_success.php");

        //header('Location: ../protected_page.php');
    } else {
        // Login failed
        //header('Location: ../index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}
?>