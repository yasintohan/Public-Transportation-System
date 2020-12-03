<?php 
session_start();
if(isset($_GET["Id1"], $_GET["Id2"], $_GET["Id3"], $_GET["tableName"], $_GET["idname1"], $_GET["idname2"], $_GET["idname3"], $_GET["page"]))
{
	include("db_connect.php");//db connect
	
	//variables
	$id1 = $_GET["Id1"];
	$id2 = $_GET["Id2"];
	$id3 = $_GET["Id3"];
	$tableName = $_GET["tableName"];
	$idname1 = $_GET["idname1"];
	$idname2 = $_GET["idname2"];
	$idname3 = $_GET["idname3"];
	$page = $_GET["page"];
	//#variables
	
	//query text
	$str = "DELETE FROM {$tableName} WHERE {$idname1} =  '{$id1}' AND {$idname2} =  '{$id2}' AND {$idname3} =  '{$id3}'";
	//#query text

	$query=$db->prepare($str);
	$result=$query->execute();
	
	
	
	if($result){
		header("Location: ".$page);
	}
	else {
		echo("Error 2");
	}
}
else if(isset($_GET["Id1"], $_GET["Id2"], $_GET["tableName"], $_GET["idname1"], $_GET["idname2"], $_GET["page"]))
{
	include("db_connect.php");//db connect
	
	//variables
	$id1 = $_GET["Id1"];
	$id2 = $_GET["Id2"];
	$tableName = $_GET["tableName"];
	$idname1 = $_GET["idname1"];
	$idname2 = $_GET["idname2"];
	$page = $_GET["page"];
	//#variables
	
	//query text
	$str = "DELETE FROM {$tableName} WHERE {$idname1} =  '{$id1}' AND {$idname2} =  '{$id2}'";

	//#query text
	
	
	
	$query=$db->prepare($str);
	$result=$query->execute();
	
	
	
	if($result){
		header("Location: ".$page);
	}
	else {
		echo("Error 2");
	}
	
}
else if(isset($_GET["Id"], $_GET["tableName"], $_GET["idname"], $_GET["page"]))
{
	include("db_connect.php");//db connect
	
	//variables
	$id = $_GET["Id"];
	$tableName = $_GET["tableName"];
	$idname = $_GET["idname"];
	$page = $_GET["page"];
	//#variables
	
	//query text
	$str = "DELETE FROM {$tableName} WHERE {$idname} =  {$id}";
	//#query text
	
	$query=$db->prepare($str);
	$result=$query->execute();
	
	
	
	if($result){
		header("Location: ".$page);
	}
	else {
		echo("Error 2");
	}
}
else {
	echo("Error");
	
	}


?>