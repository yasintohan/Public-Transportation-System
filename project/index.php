<?php

if(isset($_SESSION['login_user'], $_SESSION['login_password'])){
	//header("location: main.php");
	
}


if(isset($_POST["inputUsername"], $_POST["inputPassword"])){
	$username = $_POST["inputUsername"];
	$password = $_POST["inputPassword"];
	include("session.php");
}


$page = $_SERVER['PHP_SELF'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transportation Admin</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
   
   <style>
   body{
	    background-image: linear-gradient(to right, #303f9f , #dc8989);
   
   }

.form-heading { color:#fff; font-size:23px;}
.panel h2{ 
	background: -webkit-linear-gradient(45deg, #303f9f, #dc8989);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;

 margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 100px auto 30px;
  padding: 50px 70px 70px 71px;
}
@media (min-width: 992px) {
 .main-div {
 
  max-width: 38%;
  
}
}
@media (max-width: 991px) {
 .main-div {
 
  max-width: 100%;
  
}
}


@media (min-width: 768px) {
 .main-div {
  padding: 50px 70px 70px 71px;
}
}
@media (max-width: 767px) {
  .main-div {
  padding: 20px 40px 40px 41px;
}
}


.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}

.login-form  .btn.btn-primary {
	
	background: -webkit-linear-gradient(45deg, #303f9f, #dc8989);
  border-color: #ffffff;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}


   </style>
   
   
   
   
  </head>
  
    
	
	
	<body>
<div class="container">


<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Login</h2>
   <p>Please enter your username and password</p>
   </div>
    <form id="Login" action="index.php" method="post">

        <div class="form-group">


            <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="Username" required="">

        </div>

        <div class="form-group">

            <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" required="">

        </div>
       	

        <button type="submit" class="btn btn-primary">Login</button>

    </form>
	
	
    </div>

</div></div>


<footer style="text-align:center; color:#ffffff;"><p>Copyright &copy; Yasin Tohan<p></footer>
    
	
	
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
  </body>
</html>