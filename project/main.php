<?php
session_start();
if(!isset($_SESSION['login_user'], $_SESSION['login_password'])){
	header("location: index.php");
	
} else {
	include("db_connect.php");




$drivingquery=$db->prepare('SELECT count(drive_SSN) as count FROM `employee_drive`');
$drivingquery->execute();
$driving=$drivingquery-> fetch(PDO::FETCH_OBJ);

$garagesquery=$db->prepare('SELECT count(garage_Id) as count FROM `garage`');
$garagesquery->execute();
$garages=$garagesquery-> fetch(PDO::FETCH_OBJ);

$vehiclequery=$db->prepare('SELECT count(vehicle_Id) as count FROM `vehicle`');
$vehiclequery->execute();
$vehicles=$vehiclequery-> fetch(PDO::FETCH_OBJ);

$employeequery=$db->prepare('SELECT count(SSN) as count FROM `employee`');
$employeequery->execute();
$employees=$employeequery-> fetch(PDO::FETCH_OBJ);

$routequery=$db->prepare('SELECT count(route_Id) as count FROM `route`');
$routequery->execute();
$routes=$routequery-> fetch(PDO::FETCH_OBJ);

$stopquery=$db->prepare('SELECT count(id) as count FROM `stop`');
$stopquery->execute();
$stops=$stopquery-> fetch(PDO::FETCH_OBJ);

$muvtquery=$db->prepare("select (SELECT type FROM vehicle WHERE employee_drive.drive_vehicle_Id = vehicle_Id) As Vehicle, 
count((SELECT type FROM vehicle WHERE employee_drive.drive_vehicle_Id = vehicle_Id)) as Count 
FROM employee_drive WHERE MONTH(drive_date) = '5'
group by (SELECT type FROM vehicle WHERE employee_drive.drive_vehicle_Id = vehicle_Id) 
order by count((SELECT type FROM vehicle WHERE employee_drive.drive_vehicle_Id = vehicle_Id)) DESC
");
$muvtquery->execute();
$muvtlişt=$muvtquery-> fetchAll(PDO::FETCH_OBJ);

$lorquery=$db->prepare('SELECT 
route_route_Id AS route_Id,
(select source_stop FROM route  WHERE route_Id = route_route_Id) as Source_Stop, 
(select destination_stop FROM route  WHERE route_Id = route_route_Id) as Destination_Stop,  
count(route_route_Id) AS stop_number 
FROM route_goes 
group by route_route_Id 
order by count(route_route_Id) DESC
');
$lorquery->execute();
$lorlist=$lorquery-> fetchAll(PDO::FETCH_OBJ);

$avgquery=$db->prepare('select 
garage, 
count(SSN) as employee_number, 
avg(age) as avarage_age 
from employee 
group by garage
');
$avgquery->execute();
$avglist=$avgquery-> fetchAll(PDO::FETCH_OBJ);

$novofquery=$db->prepare('select 
route_Id, 
(select count(departure_time) from route_departure_time where route_id = route.route_Id) AS departure_number 
from route 
order by (select count(departure_time) from route_departure_time where route_id = route.route_Id) DESC
');
$novofquery->execute();
$novoflist=$novofquery-> fetchAll(PDO::FETCH_OBJ);

$novquery=$db->prepare('select 
garage_Id, 
(select count(type) from vehicle where garage = garage_Id) AS Vehicle_number 
from garage 
order by (select count(type) 
from vehicle 
where garage = garage_Id) DESC
');
$novquery->execute();
$novlist=$novquery-> fetchAll(PDO::FETCH_OBJ);

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
        <div class="navbar-collapse collapfile:///C:/Users/Rıdvan/Desktop/data%20homework/main.php#se">
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
	  <li class="active">Home</li>
	</ol>

    <h1><a href="main.php"><strong><span class="glyphicon glyphicon-home"></span> Home</strong></a></h1>
	
	<!-- numbers start --->

<hr>

	
	
	
	
  <div class="row">
  
	<div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="driving.php"><div class="circle-tile-heading purple"><i class="fa glyphicon glyphicon-transfer"></i></div></a>
        <div class="circle-tile-content purple">
          <div class="circle-tile-description text-faded">Driving</div>
          <div class="circle-tile-number text-faded ">		  
		  <?php echo($driving->count);?>
		  </div>
          <a class="circle-tile-footer" href="driving.php">More Info<i class="fa glyphicon glyphicon-chevron-right"></i></a>
        </div>
      </div>
    </div> 
  
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="garages.php"><div class="circle-tile-heading blue"><i class="fa glyphicon glyphicon-home"></i></div></a>
        <div class="circle-tile-content blue">
          <div class="circle-tile-description text-faded">Garages</div>
          <div class="circle-tile-number text-faded "><?php echo($garages->count);?></div>
          <a class="circle-tile-footer" href="garages.php">More Info<i class="fa glyphicon glyphicon-chevron-right"></i></a>
        </div>
      </div>
    </div>
     
    <div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="vehicles.php"><div class="circle-tile-heading green"><i class="fa glyphicon glyphicon-bed"></i></div></a>
        <div class="circle-tile-content green">
          <div class="circle-tile-description text-faded">Vehicles</div>
          <div class="circle-tile-number text-faded "><?php echo($vehicles->count);?></div>
          <a class="circle-tile-footer" href="vehicles.php">More Info<i class="fa glyphicon glyphicon-chevron-right"></i></a>
        </div>
      </div>
    </div> 
	<div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="employees.php"><div class="circle-tile-heading red"><i class="fa glyphicon glyphicon-user"></i></div></a>
        <div class="circle-tile-content red">
          <div class="circle-tile-description text-faded">Employees</div>
          <div class="circle-tile-number text-faded "><?php echo($employees->count);?></div>
          <a class="circle-tile-footer" href="employees.php">More Info<i class="fa glyphicon glyphicon-chevron-right"></i></a>
        </div>
      </div>
    </div> 
	<div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="routes.php"><div class="circle-tile-heading orange"><i class="fa glyphicon glyphicon-road"></i></div></a>
        <div class="circle-tile-content orange">
          <div class="circle-tile-description text-faded">Routes</div>
          <div class="circle-tile-number text-faded "><?php echo($routes->count);?></div>
          <a class="circle-tile-footer" href="routes.php">More Info<i class="fa glyphicon glyphicon-chevron-right"></i></a>
        </div>
      </div>
    </div>  
	<div class="col-lg-2 col-sm-6">
      <div class="circle-tile ">
        <a href="stops.php"><div class="circle-tile-heading yellow"><i class="fa glyphicon glyphicon-flag"></i></div></a>
        <div class="circle-tile-content yellow">
          <div class="circle-tile-description text-faded">Stops</div>
          <div class="circle-tile-number text-faded "><?php echo($stops->count);?></div>
          <a class="circle-tile-footer" href="stops.php">More Info<i class="fa glyphicon glyphicon-chevron-right"></i></a>
        </div>
      </div>
    </div> 
	
  </div> 
 
  <!--#numbers finish --->

	<hr>



  <div class="row">
  
  
  <div class="col-lg-12 col-md-12">
	<h3>Lengths of routes</h3>
   
	<div class="panel panel-default table-responsive">
		  
						 

						  <table class="table">
						  <thead>
							<tr>
							  <th>Route Id</th>
							  <th>Source</th>
							  <th>Destination</th>
							  <th>Stop Number</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
							foreach($lorlist as $lor){?>
								
							<tr>
							  <th><?= $lor->route_Id ?></th>
							  <th><?= $lor->Source_Stop ?></th>
							  <th><?= $lor->Destination_Stop ?></th>
							  <th><?= $lor->stop_number ?></th>
							</tr>
								
							<?php } ?>
							
							
							
						  </tbody>
						</table>
	</div>
   
   
	
	</div>
  
  
   
   <div class="col-lg-6 col-md-6">
	<h3>Most used vehicle types on May</h3>
   
	<div class="panel panel-default table-responsive">
		  
						 

						  <table class="table">
						  <thead>
							<tr>
							  <th>Vehicle</th>
							  <th>Count</th>
							
							</tr>
						  </thead>
						  <tbody>
						  
							<?php
							foreach($muvtlişt as $muvt){?>
								
							<tr>
							  <th><?= $muvt->Vehicle ?></th>
							  <th><?= $muvt->Count ?></th>
							  
							</tr>
								
							<?php } ?>
						  
						
							
							
							
						  </tbody>
						</table>
	</div>
   
   
	
	</div>
	
	
	<div class="col-lg-6 col-md-6">
	<h3>Number of vehicles in garages</h3>
   
	<div class="panel panel-default table-responsive">
		  
						 

						  <table class="table">
						  <thead>
							<tr>
							  <th>Garage Id</th>
							  <th>Vehicle Number</th>
							
							</tr>
						  </thead>
						  <tbody>
							<?php
							foreach($novlist as $nov){?>
								
							<tr>
							  <th><?= $nov->garage_Id ?></th>
							  <th><?= $nov->Vehicle_number  ?></th>
							  
							  
							</tr>
								
							<?php } ?>
							
							
							
						  </tbody>
						</table>
	</div>
   
   
	
	</div>
	
	
	</div>
	<div class="row">
	
	
	<div class="col-lg-6 col-md-6">
	<h3>Average age of employees</h3>
   
	<div class="panel panel-default table-responsive">
		  
						 

						  <table class="table">
						  <thead>
							<tr>
							  <th>Garage Id</th>
							  <th>Employee Number</th>
							  <th>Avarage Age</th>
							  
							</tr>
						  </thead>
						  <tbody>
							<?php
							foreach($avglist as $avg){?>
								
							<tr>
							  <th><?= $avg->garage ?></th>
							  <th><?= $avg->employee_number ?></th>
							  <th><?= $avg->avarage_age  ?></th>
							  
							</tr>
								
							<?php } ?>
							
							
							
						  </tbody>
						</table>
	</div>
   
   
	
	</div>
	
	
	<div class="col-lg-6 col-md-6">
	<h3>Number of voyages of routes</h3>
   
	<div class="panel panel-default table-responsive">
		  
						 

						  <table class="table">
						  <thead>
							<tr>
							  <th>Route Id</th>
							  <th>Departure Number</th>
							  
							  
							</tr>
						  </thead>
						  <tbody>
							<?php
							foreach($novoflist as $novof){?>
								
							<tr>
							  <th><?= $novof->route_Id ?></th>
							  <th><?= $novof->departure_number ?></th>
							 
							  
							</tr>
								
							<?php } ?>
							
							
							
						  </tbody>
						</table>
	</div>
   
   
	
	</div>

	
	
  </div> 

	
	
	
	
	
    <hr>
</div>

    
	<footer style="text-align:center;"><p>Copyright &copy; Yasin Tohan<p></footer>
	
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
  </body>
</html>