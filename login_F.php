<?php
header('Access-Control-Allow-Origin: *');

$sql = "SELECT *
FROM 	ag_usuarios WHERE CEDULA =:user" ;

try {

	
	
    $dbh = new PDO("firebird:dbname=localhost:C:\wamp\www\services\BASE_AG.FDB", "SYSDBA", "masterkey");

	/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("user", $_POST[user_name]);
	$stmt->bindParam("pass", $_POST[password]);
	$stmt->execute();	
	$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;

	if ($usuario == 0) {
		 echo 'error';
	} elseif (!$usuario) {
	    echo '3'; 
	} else {

			$sql2 = "SELECT *
				FROM 	ag_usuarios WHERE  CLAVE =:pass and CEDULA =:user" ;

				try {

				    $dbh = new PDO("firebird:dbname=localhost:C:\wamp\www\services\BASE_AG.FDB", "SYSDBA", "masterkey");

					/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
					$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $dbh->prepare($sql2);  
					$stmt->bindParam("user", $_POST[user_name]);
					$stmt->bindParam("pass", $_POST[password]);
					$stmt->execute();	
					$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
					$dbh = null;

					if ($usuario == 0) {
					   echo '{"items":'. json_encode($usuario) .'}';
					} elseif (!$usuario) {
					    echo '2';
					} else {


					    echo '{"items":'. json_encode($usuario) .'}'; 
					    
					}
					
				} catch(PDOException $e) {
					echo '{"error":{"text":'. $e->getMessage() .'}}'; 
				}


	    
	}
	
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>