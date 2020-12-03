<?php
session_start();
if(!isset($_SESSION['login_user'], $_SESSION['login_password'])){
	header("location: index.php");
	
} else {
	include("db_connect.php");

include("authority.php");


$query=$db->prepare('Select * FROM garage');
$query->execute();
$garagelist=$query-> fetchAll(PDO::FETCH_OBJ);

$tablename = "garage";
$idname = "garage_Id";
$page = $_SERVER['PHP_SELF'];



if(isset($_GET["addcapacity"], $_GET["addcity"], $_GET["addstate"], $_GET["addzipcode"]))
{
	//insert function
	
	$value1 = $_GET["addcapacity"];
	$value2 = $_GET["addcity"];
	$value3 = $_GET["addstate"];
	$value4 = $_GET["addzipcode"];
	
	//query text
	$str = "INSERT INTO `garage` ( `capacity`, `city`, `state`, `zipcode`) VALUES ('{$value1}', '{$value2}', '{$value3}', '{$value4}')";
	//#query text
	

	if ($db->query($str) === TRUE) {
	  header("Location: ".$page);
	} else {
	  header("Location: ".$page);
	}
	
	
}
else if(isset($_GET["uptgarageId"], $_GET["uptcapacity"], $_GET["uptcity"], $_GET["uptstate"], $_GET["uptzipcode"])) {
	//update function
	
	$value1 = $_GET["uptgarageId"];
	$value2 = $_GET["uptcapacity"];
	$value3 = $_GET["uptcity"];
	$value4 = $_GET["uptstate"];
	$value5 = $_GET["uptzipcode"];
	//query text
	
	$uptstr = "UPDATE `garage` SET `capacity` = '{$value2}', `city` = '{$value3}', `state` = '{$value4}', `zipcode` = '{$value5}' WHERE `garage`.`garage_Id` = {$value1};";
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
    <title>Transportation Garages</title>

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
	  <li class="active">Garages</li>
	</ol>


    <h1><a href="garages.php"><strong><span class="glyphicon glyphicon-home"></span> Garages</strong></a></h1>
	
	
	<div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Garage List</a></li>
                            <?php if($perm_insert == 1) { ?><li><a href="#tab2default" data-toggle="tab">Add New Garage</a></li><?php } ?>
                            <?php if($perm_update == 1) { ?><li><a href="#tab3default" data-toggle="tab">Update Garage</a></li><?php } ?>
							
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
							  <th>Capacity</th>
							  <th>Adress</th>
							  <?php if($perm_delete == 1) { ?><th>Delete</th><?php } ?>
							  
							  
							  
							</tr>
						  </thead>
						  <tbody>
							<?php
							foreach($garagelist as $garage){?>
								
							<tr>
							  <th><?= $garage->garage_Id ?></th>
							  <th><?= $garage->capacity ?></th>
							  <th><?= $garage->adress ?></th>
							  <?php if($perm_delete == 1) { ?><th><a href="delete.php?Id=<?= $garage->garage_Id ?>&tableName=<?= $tablename ?>&idname=<?= $idname ?>&page=<?= $page ?>" name="button1id" class="btn btn-danger btn-xs" id="button1id">Delete</a></th>
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

	
						<form class="form-horizontal" action="garages.php" method="get">
						<fieldset>

						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">Capacity</label>  
						  <div class="col-md-4">
						  <input name="addcapacity" class="form-control input-md" id="addcapacity" required="" type="text" placeholder="Capacity">
							
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
						
						<!-- Button (Double) -->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="button1id"></label>
						  <div class="col-md-8">
							<button type="submit" name="button1id" class="btn btn-success" id="button1id">Add</button>
							<button type="reset" name="reset" class="btn btn-danger" id="reset">Reset</button>
						  </div>
						</div>
						
						
						</form>
						
					<!--#Form Finish -->
											
						
						
						
						
						</div>
						
						<?php } ?>
						  
						<?php if($perm_update == 1) { ?>
						<div class="tab-pane fade" id="tab3default">
						
						
						
						<!-- Form Start -->

	
						<form class="form-horizontal" action="garages.php" method="get">
						<fieldset>

						<!-- Form Name -->
						<legend>Write the informations of the garage whose information you want to update and click the update button.</legend>


						
						
						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="addgarage">Garage Id</label>  
						  <div class="col-md-4">
							<select name="uptgarageId" class="form-control">
							<?php
							foreach($garagelist as $garage){?>
							
							  <option value="<?= $garage->garage_Id ?>"><?= $garage->garage_Id ?></option>
						
			
							<?php } ?>
							
							</select>
							
						  </div>
						</div>
						

						<!-- Text input-->
						<div class="form-group">
						  <label class="col-md-4 control-label" for="fname">Capacity</label>  
						  <div class="col-md-4">
						  <input name="uptcapacity" class="form-control input-md" id="uptcapacity" required="" type="text" placeholder="Capacity">
							
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