<?php
session_start();
if(!isset($_SESSION['login_user'], $_SESSION['login_password'])){
	header("location: index.php");
	
} else {
	include("db_connect.php");
	
include("authority.php");	

$query=$db->prepare('Select * FROM vehicle');
$query->execute();
$vehiclelist=$query-> fetchAll(PDO::FETCH_OBJ);

$tablename = "vehicle";
$idname = "vehicle_Id";
$page = $_SERVER['PHP_SELF'];

$garagequery=$db->prepare('Select `garage_Id` FROM garage');
$garagequery->execute();
$garagelist=$garagequery-> fetchAll(PDO::FETCH_OBJ);
$routequery=$db->prepare('Select `route_Id` FROM route');
$routequery->execute();
$routelist=$routequery-> fetchAll(PDO::FETCH_OBJ);


if(isset($_GET["addseatNumber"], $_GET["addtype"], $_GET["addmodel"], $_GET["addgarage"], $_GET["addroute"]))
{
	//insert function
	
	$value1 = $_GET["addseatNumber"];
	$value2 = $_GET["addtype"];
	$value3 = $_GET["addmodel"];
	$value4 = $_GET["addgarage"];
	$value5 = $_GET["addroute"];
	
	//query text
	$str = "INSERT INTO `vehicle` ( `seat_number`, `type`, `model`, `garage`, `route`) VALUES ('{$value1}', '{$value2}', '{$value3}', '{$value4}', '{$value5}')";
	//#query text
	

	if ($db->query($str) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
}
else if(isset($_GET["uptvehicleId"], $_GET["uptseatNumber"], $_GET["upttype"], $_GET["uptmodel"], $_GET["uptgarage"], $_GET["uptroute"])) {
	//update function
	
	$value1 = $_GET["uptvehicleId"];
	$value2 = $_GET["uptseatNumber"];
	$value3 = $_GET["upttype"];
	$value4 = $_GET["uptmodel"];
	$value5 = $_GET["uptgarage"];
	$value6 = $_GET["uptroute"];
	//query text
	
	$uptstr = "UPDATE `vehicle` SET `seat_number` = '{$value2}', `type` = '{$value3}', `model` = '{$value4}', `garage` = '{$value5}', `route` = '{$value6}' WHERE `vehicle`.`vehicle_Id` = {$value1};";
	//#query text
	

	if ($db->query($uptstr) === TRUE) {
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
    <title>Transportation Vehicles</title>

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
	  <li class="active">Vehicles</li>
	</ol>

    <h1><a href="vehicles.php"><strong><span class="glyphicon glyphicon-bed"></span> Vehicles</strong></a></h1>
	
	
	<div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Vehicle List</a></li>
                            <?php if($perm_insert == 1) { ?><li><a href="#tab2default" data-toggle="tab">Add New Vehicle</a></li><?php } ?>
                            <?php if($perm_update == 1) { ?><li><a href="#tab3default" data-toggle="tab">Update Vehicle</a></li><?php } ?>
							
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
							  <th>#</th>
							  <th>Seat Number</th>
							  <th>Type</th>
							  <th>Model</th>
							  <th>Garage</th>
							  <th>Route</th>
							  <?php if($perm_delete == 1) { ?><th>Delete</th><?php } ?>
							  
							</tr>
						  </thead>
						  <tbody>
						  <?php
							foreach($vehiclelist as $vehicle){?>
								
							<tr>
							  <th><?= $vehicle->vehicle_Id ?></th>
							  <th><?= $vehicle->seat_number ?></th>
							  <th><?= $vehicle->type ?></th>
							  <th><?= $vehicle->model ?></th>
							  <th><?= $vehicle->garage ?></th>
							  <th><?= $vehicle->route ?></th>
							  <?php if($perm_delete == 1) { ?><th><a href="delete.php?Id=<?= $vehicle->vehicle_Id ?>&tableName=<?= $tablename ?>&idname=<?= $idname ?>&page=<?= $page ?>" name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th>
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

	
						<form class="form-horizontal" action="vehicles.php" method="get">
						<fieldset>

						

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">Seat Number</label>  
						  <div class="col-md-4">
						  <input name="addseatNumber" class="form-control input-md" id="addseatNumber" required="" type="text" placeholder="Seat Number">
							
						  </div>
						</div>

					



						<!-- Multiple Radios (inline) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="gender">Type</label>
						  <div class="col-md-4"> 
							<label class="radio-inline" for="type-0">
							  <input name="addtype" id="type-0" type="radio" checked="checked" value="BUS">
							  BUS
							</label> 
							<label class="radio-inline" for="gender-1">
							  <input name="addtype" id="type-1" type="radio" value="TRAM">
							  TRAM
							</label> 
							<label class="radio-inline" for="gender-2">
							  <input name="addtype" id="type-2" type="radio" value="METRO">
							  METRO
							</label>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="bdate">Model</label>  
						  <div class="col-md-4">
						  <input name="addmodel" class="form-control input-md" id="addmodel" required="" type="text" placeholder="Model">
							
						  </div>
						</div>
						
						
					
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="addgarage">Garage</label>  
						  <div class="col-md-4">
							<select name="addgarage" class="form-control">
							<?php
							foreach($garagelist as $garage){?>
							
							  <option value="<?= $garage->garage_Id ?>"><?= $garage->garage_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						
						
						
						
						

			
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="uptroute">Route</label>  
						  <div class="col-md-4">
							<select name="addroute" class="form-control">
							<?php
							foreach($routelist as $route){?>
							
							  <option value="<?= $route->route_Id ?>"><?= $route->route_Id ?></option>
						
			
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

	
						<form class="form-horizontal" action="vehicles.php" method="get">
						<fieldset>

						<legend>Write the informations of the vehicle whose information you want to update and click the update button.</legend>

					
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="addgarage">Vehicle Id</label>  
						  <div class="col-md-4">
							<select name="uptvehicleId" class="form-control">
							<?php
							foreach($vehiclelist as $vehicle){?>
							
							  <option value="<?= $vehicle->vehicle_Id ?>"><?= $vehicle->vehicle_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">Seat Number</label>  
						  <div class="col-md-4">
						  <input name="uptseatNumber" class="form-control input-md" id="uptseatNumber" required="" type="text" placeholder="Seat Number">
							
						  </div>
						</div>

					



						<!-- Multiple Radios (inline) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="gender">Type</label>
						  <div class="col-md-4"> 
							<label class="radio-inline" for="type-0">
							  <input name="upttype" id="type-0" type="radio" checked="checked" value="BUS">
							  BUS
							</label> 
							<label class="radio-inline" for="gender-1">
							  <input name="upttype" id="type-1" type="radio" value="TRAM">
							  TRAM
							</label> 
							<label class="radio-inline" for="gender-2">
							  <input name="upttype" id="type-2" type="radio" value="METRO">
							  METRO
							</label>
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="bdate">Model</label>  
						  <div class="col-md-4">
						  <input name="uptmodel" class="form-control input-md" id="uptmodel" required="" type="text" placeholder="Model">
							
						  </div>
						</div>
						
						
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="addgarage">Garage</label>  
						  <div class="col-md-4">
							<select name="uptgarage" class="form-control">
							<?php
							foreach($garagelist as $garage){?>
							
							  <option value="<?= $garage->garage_Id ?>"><?= $garage->garage_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="uptroute">Route</label>  
						  <div class="col-md-4">
							<select name="uptroute" class="form-control">
							<?php
							foreach($routelist as $route){?>
							
							  <option value="<?= $route->route_Id ?>"><?= $route->route_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						

						
						
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