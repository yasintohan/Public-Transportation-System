<?php 
	
	
	try{
	$host='localhost'; //Host
	$dbname='transportation'; // Database Name
	
	$user= $_SESSION['login_user'];
	$pass= $_SESSION['login_password'];
	
	
	$db=new
	PDO("mysql:host=$host;dbname=$dbname;charset=UTF8","$user",$pass);
	
}
catch(PDOException $e){
	print $e->getMessage();
	header("location: index.php");
	
}
	

	


?>