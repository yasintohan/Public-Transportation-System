<?php 
	
	$perm_insert = 0;
	$perm_update = 0;
	$perm_delete = 0;
	
	$grantstr = "SHOW GRANTS FOR {$user}@{$host}";
	
	$permquery=$db->prepare($grantstr);
	$permquery->execute();
	$permuser=$permquery-> fetch(PDO::FETCH_OBJ);
	
	$permuserstr = serialize($permuser);
	
	

	if(strpos($permuserstr, "INSERT")){
    $perm_insert = 1;
	}
	if(strpos($permuserstr, "UPDATE")){
    $perm_update = 1;
	}
	if(strpos($permuserstr, "DELETE")){
    $perm_delete = 1;
	}
	if(strpos($permuserstr, "ALL PRIVILEGES")){
		$perm_insert = 1;
		$perm_update = 1;
		$perm_delete = 1;
	}

?>