<?php 
session_start();
$error = '';


if(isset($username, $password)) {
		$_SESSION["login_user"] = $username;
		$_SESSION["login_password"] = $password;
		header("location: main.php");
}

		
	



?>