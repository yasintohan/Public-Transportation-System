<?php
session_start();
if(!isset($_SESSION['login_user'], $_SESSION['login_password'])){
	header("location: index.php");
	
} else {
	include("db_connect.php");

include("authority.php");


$query=$db->prepare('Select * FROM employee_drive order by drive_date DESC');
$query->execute();
$drivinglist=$query-> fetchAll(PDO::FETCH_OBJ);
$tablename = "employee_drive";
$idname1 = "drive_SSN";
$idname2 = "drive_vehicle_Id";
$idname3 = "drive_date";
$page = $_SERVER['PHP_SELF'];

$sssquery=$db->prepare('Select `SSN` FROM employee');
$sssquery->execute();
$ssnlist=$sssquery-> fetchAll(PDO::FETCH_OBJ);
$vehiclequery=$db->prepare('Select `vehicle_Id` FROM vehicle');
$vehiclequery->execute();
$vehiclelist=$vehiclequery-> fetchAll(PDO::FETCH_OBJ);


if(isset($_GET["ssn"], $_GET["vehicleId"], $_GET["date"]))
{
	//insert function
	
	$value1 = $_GET["ssn"];
	$value2 = $_GET["vehicleId"];
	$value3 = $_GET["date"];
	
	
	//query text
	$str = "INSERT INTO `employee_drive` ( `drive_SSN`, `drive_vehicle_Id`, `drive_date`) VALUES ('{$value1}', '{$value2}', '{$value3}')";
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
    <title>Transportation Driving</title>

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
        <div class="navbar-collapse collapfile:///C:/Users/Rıdvan/Desktop/data%20homework/driving.php#se">
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
	  <li class="active">Driving</li>
	</ol>

    <h1><a href="driving.php"><strong><span class="glyphicon glyphicon-transfer"></span> Driving</strong></a></h1>
	
	
	<div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Driving List</a></li>
                            <?php if($perm_insert == 1) { ?> <li><a href="#tab2default" data-toggle="tab">Add New Driving</a></li>  <?php } ?>
							
							
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
							  <th>Vehicle</th>
							  <th>Date</th>
							  <?php if($perm_delete == 1) { echo("<th>Delete</th>"); } ?>
							 
							  
							</tr>
						  </thead>
						  <tbody>
						  <?php
							foreach($drivinglist as $drive){?>
								
							<tr>
							  <th><?= $drive->drive_SSN ?></th>
							  <th><?= $drive->drive_vehicle_Id ?></th>
							  <th><?= $drive->drive_date ?></th>
							  <?php if($perm_delete == 1) { ?>   <th><a href="delete.php?Id1=<?= $drive->drive_SSN ?>&Id2=<?= $drive->drive_vehicle_Id ?>&Id3=<?= $drive->drive_date ?>&tableName=<?= $tablename ?>&idname1=<?= $idname1 ?>&idname2=<?= $idname2 ?>&idname3=<?= $idname3 ?>&page=<?= $page ?>"
							  name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th> <?php } ?>
							  
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

	
						<form class="form-horizontal" action="driving.php" method="get">
						<fieldset>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="ssn">SSN</label>  
						  <div class="col-md-4">
							<select name="ssn" class="form-control">
							<?php
							foreach($ssnlist as $ssn){?>
							
							  <option value="<?= $ssn->SSN ?>"><?= $ssn->SSN ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="vehicleId">Vehicle Id</label>  
						  <div class="col-md-4">
							<select name="vehicleId" class="form-control">
							<?php
							foreach($vehiclelist as $vehicle){?>
							
							  <option value="<?= $vehicle->vehicle_Id ?>"><?= $vehicle->vehicle_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>

					
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="date">Date</label>  
						  <div class="col-md-4">
						  <input name="date" class="form-control input-md" id="date" required="" type="date" placeholder="Date">
							
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
						
					
						
						
					
						
					
						
						
						
                        
                    </div>
                </div>
            </div>	
	
	
	
	
	

	
	
	
		
		
		
		
		
	
	
	
	
	
	
	
    <hr>
</div>

    
	<footer style="text-align:center;"><p>Copyright &copy; Yasin Tohan<p></footer>
	
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js" ></script>
	 <script src="js/search.js" ></script>
  </body>
 
  
  
  
  
</html>