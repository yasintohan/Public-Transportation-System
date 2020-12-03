<?php
session_start();
if(!isset($_SESSION['login_user'], $_SESSION['login_password'])){
	header("location: index.php");
	
} else {
	include("db_connect.php");

include("authority.php");

$query=$db->prepare('Select * FROM route');
$query->execute();
$routelist=$query-> fetchAll(PDO::FETCH_OBJ);
$tablename = "route";
$idname = "route_Id";

$timequery=$db->prepare('Select * FROM route_departure_time order by route_id');
$timequery->execute();
$timelist=$timequery-> fetchAll(PDO::FETCH_OBJ);
$timetablename = "route_departure_time";
$timeidname1 = "route_id";
$timeidname2 = "departure_time";

$stopquery=$db->prepare('Select * FROM route_goes order by route_route_Id');
$stopquery->execute();
$stoplist=$stopquery-> fetchAll(PDO::FETCH_OBJ);
$stoptablename = "route_goes";
$stopidname1 = "route_route_Id";
$stopidname2 = "stop_id";

$stquery=$db->prepare('Select * FROM stop');
$stquery->execute();
$stlist=$stquery-> fetchAll(PDO::FETCH_OBJ);

$page = $_SERVER['PHP_SELF'];







if(isset($_GET["addsource"], $_GET["adddestination"]))
{
	//insert function
	
	$value1 = $_GET["addsource"];
	$value2 = $_GET["adddestination"];

	//query text
	$str = "INSERT INTO `route` ( `source_stop`, `destination_stop`) VALUES ('{$value1}', '{$value2}')";
	//#query text
	
	if ($db->query($str) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
}
else if(isset($_GET["uptrouteId"], $_GET["uptsource"], $_GET["uptdestination"])) {
	//update function
	
	$value1 = $_GET["uptrouteId"];
	$value2 = $_GET["uptsource"];
	$value3 = $_GET["uptdestination"];

	//query text
	
	$uptstr = "UPDATE `route` SET `source_stop` = '{$value2}', `destination_stop` = '{$value3}' WHERE `route`.`route_Id` = {$value1};";
	//#query text
	

	if ($db->query($uptstr) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
	
} 
else if(isset($_GET["deprouteId"], $_GET["depdepartureTime"]))
{
	//insert function
	
	$value1 = $_GET["deprouteId"];
	$value2 = $_GET["depdepartureTime"];

	//query text
	$str = "INSERT INTO `route_departure_time` ( `route_id`, `departure_time`) VALUES ('{$value1}', '{$value2}')";
	//#query text
	

	if ($db->query($str) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
}
else if(isset($_GET["stoprouteId"], $_GET["stopId"]))
{
	//insert function
	
	$value1 = $_GET["stoprouteId"];
	$value2 = $_GET["stopId"];

	//query text
	$str = "INSERT INTO `route_goes` ( `route_route_Id`, `stop_id`) VALUES ('{$value1}', '{$value2}')";
	//#query text
	

	if ($db->query($str) === TRUE) {
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
    <title>Transportation Routes</title>

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
	  <li class="active">Routes</li>
	</ol>

    <h1><a href="routes.php"><strong><span class="glyphicon glyphicon-road"></span> Routes</strong></a></h1>
	
	
	<div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Route List</a></li>
                            <?php if($perm_insert == 1) { ?><li><a href="#tab2default" data-toggle="tab">Add New Route</a></li><?php } ?>
                            <?php if($perm_update == 1) { ?><li><a href="#tab3default" data-toggle="tab">Update Route</a></li><?php } ?>
							<li><a href="#tab4default" data-toggle="tab">Departure Time</a></li>
							<li><a href="#tab5default" data-toggle="tab">Stops</a></li>
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
							  <th>Source Stop</th>
							  <th>Destination Stop</th>
							  <th>Departure Times</th>
							  <?php if($perm_delete == 1) { ?><th>Delete</th><?php } ?>
							 
							  
							</tr>
						  </thead>
						  <tbody>
						  
						  <?php
							foreach($routelist as $route){?>
								
							<tr>
							  <th><?= $route->route_Id ?></th>
							  <th><?= $route->source_stop ?></th>
							  <th><?= $route->destination_stop ?></th>
							  <th>
							  <?php
								$id = $route->route_Id;
								$str = "Select * FROM route_departure_time WHERE route_id = idd";
								$str = str_replace("idd", $id, $str);
								$depquery=$db->prepare($str);
								$depquery->execute();
								$deplist=$depquery-> fetchAll(PDO::FETCH_OBJ);
								
							
							foreach($deplist as $dep){?>
							  <span><?= $dep->departure_time ?></span>
							  <?php } ?>
							  </th>
							  <?php if($perm_delete == 1) { ?><th><a href="delete.php?Id=<?= $route->route_Id ?>&tableName=<?= $tablename ?>&idname=<?= $idname ?>&page=<?= $page ?>" name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th>
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

	
						<form class="form-horizontal" action="routes.php" method="get">
						<fieldset>

						

					
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="addsource">Source Stop</label>  
						  <div class="col-md-4">
							<select name="addsource" class="form-control">
							<?php
							foreach($stlist as $st){?>
							
							  <option value="<?= $st->name ?>"><?= $st->name ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="adddestination">Destination Stop</label>  
						  <div class="col-md-4">
							<select name="adddestination" class="form-control">
							<?php
							foreach($stlist as $st){?>
							
							  <option value="<?= $st->name ?>"><?= $st->name ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>

						

						
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

	
						<form class="form-horizontal" action="routes.php" method="get">
						<fieldset>

						<!-- Form Name -->
						<legend>Write the informations of the stop whose information you want to update and click the update button.</legend>


						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="uptsource">Route Id</label>  
						  <div class="col-md-4">
							<select name="uptrouteId" class="form-control">
							<?php
							foreach($routelist as $route){?>
							
							  <option value="<?= $route->route_Id ?>"><?= $route->route_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="uptsource">Source Stop</label>  
						  <div class="col-md-4">
							<select name="uptsource" class="form-control">
							<?php
							foreach($stlist as $st){?>
							
							  <option value="<?= $st->name ?>"><?= $st->name ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="uptdestination">Destination Stop</label>  
						  <div class="col-md-4">
							<select name="uptdestination" class="form-control">
							<?php
							foreach($stlist as $st){?>
							
							  <option value="<?= $st->name ?>"><?= $st->name ?></option>
						
			
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
						<form class="form-horizontal action="routes.php" method="get"">
						<fieldset>

						<!-- Form Name -->
						<legend>Write the route id and departure time of the route. Click Add button to add new departure time.</legend>


						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="deprouteId">Route Id</label>  
						  <div class="col-md-4">
							<select name="deprouteId" class="form-control">
							<?php
							foreach($routelist as $route){?>
							
							  <option value="<?= $route->route_Id ?>"><?= $route->route_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>

						

							<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="departureTime">Departure Time</label>  
						  <div class="col-md-4">
						  <input name="depdepartureTime" class="form-control input-md" id="depdepartureTime" required="" type="time" placeholder="Departure Time">
							
						  </div>
						</div>

						
						<div class="form-group">
						  <label class="col-md-4 control-label" for="button1id"></label>
						  <div class="col-md-8">
							<button type="submit" name="button1id" class="btn btn-success" id="button1id">Add</button>
							
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
							  <th>Route Id</th>
							  <th>Departure Time</th>
							  <?php if($perm_delete == 1) { ?><th>Delete</th><?php } ?>
							 
							  
							</tr>
						  </thead>
						  <tbody>
						  <?php
							foreach($timelist as $time){?>
								
							<tr>
							  <th><?= $time->route_id ?></th>
							  <th><?= $time->departure_time ?></th>
							  <?php if($perm_delete == 1) { ?><th><a href="delete.php?Id1=<?= $time->route_id ?>&Id2=<?= $time->departure_time ?>&tableName=<?= $timetablename ?>&idname1=<?= $timeidname1 ?>&idname2=<?= $timeidname2 ?>&page=<?= $page ?>" name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th>
							  <?php } ?>
							</tr>
								
							<?php } ?>
						  
						  
							
							
							
						  </tbody>
						</table>
						</div>
						<!--#List Finish -->
					
											
						
						
						
						
						</div>
						
						
						<div class="tab-pane fade" id="tab5default">
						
						
						
						<!-- Form Start -->

						<?php if($perm_insert == 1) { ?>
						<form class="form-horizontal action="routes.php" method="get"">
						<fieldset>

						<!-- Form Name -->
						<legend>Write the route id of the route and stop id. Click Add button to add new stop to the route.</legend>


						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="stoprouteId">Route Id</label>  
						  <div class="col-md-4">
							<select name="stoprouteId" class="form-control">
							<?php
							foreach($routelist as $route){?>
							
							  <option value="<?= $route->route_Id ?>"><?= $route->route_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>


						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="stopId">Destination Stop</label>  
						  <div class="col-md-4">
							<select name="stopId" class="form-control">
							<?php
							foreach($stlist as $st){?>
							
							  <option value="<?= $st->id ?>"><?= $st->name ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>

						
						<div class="form-group">
						  <label class="col-md-4 control-label" for="button1id"></label>
						  <div class="col-md-8">
							<button type="submit" name="button1id" class="btn btn-success" id="button1id">Add</button>
							
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
							  <th>Route Id</th>
							  <th>Stop</th>
							  <?php if($perm_delete == 1) { ?><th>Delete</th><?php } ?>
							 
							  
							</tr>
						  </thead>
						  <tbody>
							<?php
							foreach($stoplist as $stop){?>
								
							<tr>
							  <th><?= $stop->route_route_Id ?></th>
							  <th>
							  <?php
								$id = $stop->stop_id;
								
								$stpstr = "Select * FROM stop WHERE id = {$id}";
								
								$stpquery=$db->prepare($stpstr);
								$stpquery->execute();
								$stopname=$stpquery-> fetch(PDO::FETCH_OBJ);
								
								echo($stopname->name);
						
							 ?>
							  
							  </th>
							  <?php if($perm_delete == 1) { ?><th><a href="delete.php?Id1=<?= $stop->route_route_Id ?>&Id2=<?= $stop->stop_id ?>&tableName=<?= $stoptablename ?>&idname1=<?= $stopidname1 ?>&idname2=<?= $stopidname2 ?>&page=<?= $page ?>" name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th>
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