<?php header('Content-Type: application/json');
 ?>
<?php

header('Access-Control-Allow-Origin: *');

$sql = "SELECT *
FROM 	ag_emergencias where COD_TECNICO = :userID" ;

try {

	
    $dbh = new PDO("firebird:dbname=localhost:C:\wamp\www\services\BASE_AG.FDB", "SYSDBA", "masterkey");

	/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("userID", $_GET["userId"]);
	$stmt->execute();	
	$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;	
	

	echo '{"items":'. json_encode($usuario) .'}'; 
} catch(PDOException $e) {

	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>