<?php
session_start();
if(!isset($_SESSION['login_user'], $_SESSION['login_password'])){
	header("location: index.php");
	
} else {
	include("db_connect.php");

include("authority.php");

$query=$db->prepare('Select * FROM employee');
$query->execute();
$employeelist=$query-> fetchAll(PDO::FETCH_OBJ);
$tablename = "employee";
$idname = "SSN";


$garagequery=$db->prepare('Select `garage_Id` FROM garage');
$garagequery->execute();
$garagelist=$garagequery-> fetchAll(PDO::FETCH_OBJ);


$contactquery=$db->prepare('Select * FROM employee_contact');
$contactquery->execute();
$contactlist=$contactquery-> fetchAll(PDO::FETCH_OBJ);
$conttablename = "employee_contact";
$contidname1 = "employee_SSN";
$contidname2 = "contact";


$page = $_SERVER['PHP_SELF'];


if(isset($_GET["addssn"], $_GET["addfname"], $_GET["addsname"], $_GET["addgender"], $_GET["addbdate"], $_GET["addcity"], $_GET["addstate"], $_GET["addzipcode"], $_GET["addgarageId"]))
{
	//insert function
	
	$value1 = $_GET["addssn"];
	$value2 = $_GET["addfname"];
	$value3 = $_GET["addmname"];
	$value4 = $_GET["addsname"];
	$value5 = $_GET["addgender"];
	$value6 = $_GET["addbdate"];
	$value7 = $_GET["addcity"];
	$value8 = $_GET["addstate"];
	$value9 = $_GET["addzipcode"];
	$value10 = $_GET["addgarageId"];
	
	
	$date = new DateTime($value6);
	$now = new DateTime();
	$interval = $now->diff($date);
	$agevalue = $interval->y;
	
	//query text
	$str = "INSERT INTO `employee` ( `SSN`, `first_name`, `middle_name`, `last_name`, `gender`, `birthdate`, `age`, `city`, `state`, `zipcode`, `garage`) VALUES ('{$value1}', '{$value2}', '{$value3}', '{$value4}', '{$value5}', '{$value6}', '{$agevalue}', '{$value7}', '{$value8}', '{$value9}', '{$value10}')";
	//#query text
	

	if ($db->query($str) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
}
else if(isset($_GET["uptssn"], $_GET["uptfname"], $_GET["uptsname"], $_GET["uptgender"], $_GET["uptbdate"], $_GET["uptcity"], $_GET["uptstate"], $_GET["uptzipcode"], $_GET["uptgarageId"])) {
	//update function
	
	$value1 = $_GET["uptssn"];
	$value2 = $_GET["uptfname"];
	$value3 = $_GET["uptmname"];
	$value4 = $_GET["uptsname"];
	$value5 = $_GET["uptgender"];
	$value6 = $_GET["uptbdate"];
	$value7 = $_GET["uptcity"];
	$value8 = $_GET["uptstate"];
	$value9 = $_GET["uptzipcode"];
	$value10 = $_GET["uptgarageId"];
	
	
	$date = new DateTime($value6);
	$now = new DateTime();
	$interval = $now->diff($date);
	$agevalue = $interval->y;
	
	//query text
	
	$uptstr = "UPDATE `employee` SET `SSN` = '{$value1}', `first_name` = '{$value2}', `middle_name` = '{$value3}', `last_name` = '{$value4}', `gender` = '{$value5}', `birthdate` = '{$value6}', `age` = '{$agevalue}', `city` = '{$value7}', `state` = '{$value8}', `zipcode` = '{$value9}', `garage` = '{$value10}' WHERE `employee`.`SSN` = {$value1};";
	//#query text
	

	if ($db->query($uptstr) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
	
}
else if(isset($_GET["conssn"], $_GET["concontact"])) {
	//update function
	
	$value1 = $_GET["conssn"];
	$value2 = $_GET["concontact"];

	
	//query text
	
	$constr = "INSERT INTO `employee_contact` ( `employee_SSN`, `contact`) VALUES ('{$value1}', '{$value2}')";	
	//#query text
	

	if ($db->query($constr) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
	
}


}




?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transportation Employees</title>

    <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
   
  

  </head>
  <body>
    
	
	
	
	<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main.php">Transportation DB</a>
        </div>
        <div class="navbar-collapse collapfile:///C:/Users/Rıdvan/Desktop/data%20homework/employees.php#se">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="main.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
		
		
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo($_SESSION['login_user']); ?> <span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="logout.php"><i class="glyphicon glyphicon-remove-circle"></i> Logout</a></li>
					
				  </ul>
				</li>
		
            </ul>
        </div>
    </div>
   
</div>



<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">

    <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">
		<li class="nav-header">Main</li>
        <li><a href="main.php"><i class="glyphicon glyphicon-th-large"></i> Home</a></li>
		<li><a href="driving.php"><i class="glyphicon glyphicon-transfer"></i> Driving</a></li>
		<li class="nav-header">Tables</li>
        <li><a href="garages.php"><i class="glyphicon glyphicon-home"></i> Garages</a></li>
        <li><a href="vehicles.php"><i class="glyphicon glyphicon-bed"></i> Vehicles</a></li>
        <li><a href="employees.php"><i class="glyphicon glyphicon-user"></i> Employees</a></li>
		<li><a href="routes.php"><i class="glyphicon glyphicon-road"></i> Routes</a></li>
		<li><a href="stops.php"><i class="glyphicon glyphicon-flag"></i> Stops</a></li>

    </ul>
</div>

<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    
	<ol class="breadcrumb">
	  <li><a href="main.php">Home</a></li>
	  <li class="active">Employees</li>
	</ol>

    <h1><a href="employees.php"><strong><span class="glyphicon glyphicon-user"></span> Employees</strong></a></h1>
	
	
	<div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Employees List</a></li>
                            <?php if($perm_insert == 1) { ?><li><a href="#tab2default" data-toggle="tab">Add New Employee</a></li> <?php } ?>
                            <?php if($perm_update == 1) { ?><li><a href="#tab3default" data-toggle="tab">Update Employee</a></li> <?php } ?>
							<li><a href="#tab4default" data-toggle="tab">Employee Contact</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
						
						<div class="row">
						 <div class="col-md-3" style="margin-bottom:20px;">
							<form action="#" method="get">
								<div class="input-group">
									
									<input class="form-control" id="system-search" name="q" placeholder="Search for" required>
									<span class="input-group-btn">
										<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
									</span>
								</div>
							</form>
						</div>
						
						</div>
						
						<!-- List Start -->
						<div class="panel panel-default table-responsive">
		  
						 

						  <table class="table table-list-search">
						  <thead>
							<tr>
							  <th>SSN</th>
							  <th>Name Surname</th>
							  <th>Gender</th>
							  <th>Birthdate</th>
							  <th>Age</th>
							  <th>Adress</th>
							  <th>Garage</th>
							  <th>Contact</th>
							  <?php if($perm_delete == 1) { ?><th>Delete</th><?php } ?>
							  
							</tr>
						  </thead>
						  <tbody>
						  
							<?php
							foreach($employeelist as $employee){?>
								
							<tr>
							  <th><?= $employee->SSN ?></th>
							  <th><?= $employee->name ?></th>
							  <th><?= $employee->gender ?></th>
							  <th><?= $employee->birthdate ?></th>
							  <th><?= $employee->age ?></th>
							  <th><?= $employee->adress ?></th>
							  <th><?= $employee->garage ?></th>
							  <th>
							  <?php
								$id = $employee->SSN;
								$str = "Select * FROM employee_contact WHERE employee_SSN = idd";
								$str = str_replace("idd", $id, $str);
								$contquery=$db->prepare($str);
								$contquery->execute();
								$contlist=$contquery-> fetchAll(PDO::FETCH_OBJ);
								
							
							foreach($contlist as $cont){?>
							  <span><?= $cont->contact ?></span>
							  <?php } ?>
							  </th>
							  
							  
							  
							  <?php if($perm_delete == 1) { ?><th><a href="delete.php?Id=<?= $employee->SSN ?>&tableName=<?= $tablename ?>&idname=<?= $idname ?>&page=<?= $page ?>" name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th>
							  <?php } ?>
							</tr>
								
							<?php } ?>
						  
							
							
							
							
						  </tbody>
						  
						 
						</table>
						</div>
						<!--#List Finish -->
						
						
						
						
						
						
						
						
						</div>
						<?php if($perm_insert == 1) { ?>
                        <div class="tab-pane fade" id="tab2default">
						
						
						
						<!-- Form Start -->

	
						<form class="form-horizontal" action="employees.php" method="get">
						<fieldset>

						<!-- Text input-->
						<div class="form-group" action="garages.php" method="get">
						  <label class="col-md-4 control-label" for="fname">SSN</label>  
						  <div class="col-md-4">
						  <input name="addssn" class="form-control input-md" id="addssn" required="" type="text" placeholder="SSN">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">First Name</label>  
						  <div class="col-md-4">
						  <input name="addfname" class="form-control input-md" id="addfname" required="" type="text" placeholder="First Name">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="mname">Middle Name</label>  
						  <div class="col-md-4">
						  <input name="addmname" class="form-control input-md" id="addmname"  type="text" placeholder="Middle Name">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="sname">Surname</label>  
						  <div class="col-md-4">
						  <input name="addsname" class="form-control input-md" id="addsname" required="" type="text" placeholder="Surname">
							
						  </div>
						</div>

						<!-- Multiple Radios (inline) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="gender">Gender</label>
						  <div class="col-md-4"> 
							<label class="radio-inline" for="gender-0">
							  <input name="addgender" id="gender-0" type="radio" checked="checked" value="Male">
							  Male
							</label> 
							<label class="radio-inline" for="gender-1">
							  <input name="addgender" id="gender-1" type="radio" value="Female">
							  Female
							</label> 
							<label class="radio-inline" for="gender-2">
							  <input name="addgender" id="gender-2" type="radio" value="Other">
							  Other
							</label>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="bdate">Birthdate</label>  
						  <div class="col-md-4">
						  <input name="addbdate" class="form-control input-md" id="addbdate" required="" type="date" placeholder="">
							
						  </div>
						</div>
						
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">City</label>  
						  <div class="col-md-4">
						  <input name="addcity" class="form-control input-md" id="addcity" required="" type="text" placeholder="City">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="mname">State</label>  
						  <div class="col-md-4">
						  <input name="addstate" class="form-control input-md" id="addstate" required="" type="text" placeholder="State">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="sname">Zipcode</label>  
						  <div class="col-md-4">
						  <input name="addzipcode" class="form-control input-md" id="addzipcode" required="" type="text" placeholder="Zipcode">
							
						  </div>
						</div>
						
						
							<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="addgarageId">Garage Id</label>  
						  <div class="col-md-4">
							<select name="addgarageId" class="form-control">
							<?php
							foreach($garagelist as $garage){?>
							
							  <option value="<?= $garage->garage_Id ?>"><?= $garage->garage_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						
						
						<!-- Button (Double) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="button1id"></label>
						  <div class="col-md-8">
							<button type="submit" name="button1id" class="btn btn-success" id="button1id">Add</button>
							<button type="reset" name="button2id" class="btn btn-danger" id="button2id">Reset</button>
						  </div>
						</div>
						
						
						</form>
						
					<!--#Form Finish -->
											
						
						
						
						
						</div>
						<?php } ?>
						
						<?php if($perm_update == 1) { ?>
						<div class="tab-pane fade" id="tab3default">
						
						
						
						<!-- Form Start -->

	
						<form class="form-horizontal" action="employees.php" method="get">
						<fieldset>

						<!-- Form Name -->
						<legend>Write the informations of the employee whose information you want to update and click the update button.</legend>


					
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="uptssn">SSN</label>  
						  <div class="col-md-4">
							<select name="uptssn" class="form-control">
							<?php
							foreach($employeelist as $employee){?>
							
							  <option value="<?= $employee->SSN ?>"><?= $employee->SSN ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						
						

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">First Name</label>  
						  <div class="col-md-4">
						  <input name="uptfname" class="form-control input-md" id="uptfname" required="" type="text" placeholder="First Name">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="mname">Middle Name</label>  
						  <div class="col-md-4">
						  <input name="uptmname" class="form-control input-md" id="uptmname" type="text" placeholder="Middle Name">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="sname">Surname</label>  
						  <div class="col-md-4">
						  <input name="uptsname" class="form-control input-md" id="uptsname" required="" type="text" placeholder="Surname">
							
						  </div>
						</div>

						<!-- Multiple Radios (inline) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="gender">Gender</label>
						  <div class="col-md-4"> 
							<label class="radio-inline" for="gender-0">
							  <input name="uptgender" id="gender-0" type="radio" checked="checked" value="Male">
							  Male
							</label> 
							<label class="radio-inline" for="gender-1">
							  <input name="uptgender" id="gender-1" type="radio" value="Female">
							  Female
							</label> 
							<label class="radio-inline" for="gender-2">
							  <input name="uptgender" id="gender-2" type="radio" value="Other">
							  Other
							</label>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="bdate">Birthdate</label>  
						  <div class="col-md-4">
						  <input name="uptbdate" class="form-control input-md" id="uptbdate" required="" type="date" placeholder="mm/dd/yyyy">
							
						  </div>
						</div>
						
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">City</label>  
						  <div class="col-md-4">
						  <input name="uptcity" class="form-control input-md" id="uptcity" required="" type="text" placeholder="City">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="mname">State</label>  
						  <div class="col-md-4">
						  <input name="uptstate" class="form-control input-md" id="uptstate" required="" type="text" placeholder="State">
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="sname">Zipcode</label>  
						  <div class="col-md-4">
						  <input name="uptzipcode" class="form-control input-md" id="uptzipcode" required="" type="text" placeholder="Zipcode">
							
						  </div>
						</div>
											
							
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="uptgarageId">Garage Id</label>  
						  <div class="col-md-4">
							<select name="uptgarageId" class="form-control">
							<?php
							foreach($garagelist as $garage){?>
							
							  <option value="<?= $garage->garage_Id ?>"><?= $garage->garage_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						
						
						
						
						
						
						
						<!-- Button (Double) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="button1id"></label>
						  <div class="col-md-8">
							<button type="submit" name="button2id" class="btn btn-default" id="button2id">Update</button>
						  </div>
						</div>
						
						
						</form>
						
					<!--#Form Finish -->
											
						
						
						
						
						</div>
						<?php } ?>
						
					
						
						
						<div class="tab-pane fade" id="tab4default">
						
						
						
						<!-- Form Start -->

						<?php if($perm_insert == 1) { ?>
						<form class="form-horizontal" action="employees.php" method="get">
						<fieldset>
						
						<!-- Form Name -->
						<legend>Write the SSN number and contact of the employee. Click Add button to add new contact.</legend>
						

							<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="conssn">SSN</label>  
						  <div class="col-md-4">
							<select name="conssn" class="form-control">
							<?php
							foreach($employeelist as $employee){?>
							
							  <option value="<?= $employee->SSN ?>"><?= $employee->SSN ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>

							<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="contact">Contact</label>  
						  <div class="col-md-4">
						  <input name="concontact" class="form-control input-md" id="concontact" required="" type="text" placeholder="Contact">
							
						  </div>
						</div>

						
						<div class="form-group">
						  <label class="col-md-4 control-label" for="button1id"></label>
						  <div class="col-md-8">
							<button name="button1id" class="btn btn-success" id="button1id">Add</button>
							
						  </div>
						</div>
						
						
						</form>
						<?php } ?>
					<!--#Form Finish -->
					
					
					
					<!-- List Start -->
						<div class="panel panel-default table-responsive">
		  
						 

						  <table class="table">
						  <thead>
							<tr>
							  <th>SSN</th>
							  <th>Contact</th>
							  <?php if($perm_delete == 1) { ?><th>Delete</th><?php } ?>
							  
							 
							  
							</tr>
						  </thead>
						  <tbody>
						  
						  <?php
							foreach($contactlist as $contact){?>
								
							<tr>
							  <th><?= $contact->employee_SSN ?></th>
							  <th><?= $contact->contact ?></th>
							  <?php if($perm_delete == 1) { ?><th><a href="delete.php?Id1=<?= $contact->employee_SSN ?>&Id2=<?= $contact->contact ?>&tableName=<?= $conttablename ?>&idname1=<?= $contidname1 ?>&idname2=<?= $contidname2 ?>&page=<?= $page ?>" name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th>
							  <?php } ?>
							</tr>
								
							<?php } ?>
						  
							
							
						  </tbody>
						</table>
						</div>
						<!--#List Finish -->
					
											
						
						
						
						
						</div>
						
						
						
						
                        
                    </div>
                </div>
            </div>	
	
	
	
	
	

	
	
	
		
		
		
		
		
	
	
	
	
	
	
	
    <hr>
</div>

    
	<footer style="text-align:center;"><p>Copyright &copy; Yasin Tohan<p></footer>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
	<script src="js/search.js" ></script>
	
  </body>
</html>