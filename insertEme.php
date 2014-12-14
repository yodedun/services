<?php header('Content-Type: application/json');
 ?>
<?php

header('Access-Control-Allow-Origin: *');

$sql = "INSERT INTO ag_emergencias (
			COD_EDS,
			COD_TECNICO,
			COD_SOLICITANTE,
			COD_RECIBE
			) VALUES (
			003,
            80865603, 
            :dos, 
            :tres)";

try {

	
    $dbh = new PDO("firebird:dbname=localhost:G:\wamp\www\john\services\BASE_AG.FDB", "SYSDBA", "masterkey");

	/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("uno", $_GET["uno"]);
	$stmt->bindParam("dos", $_GET["dos"]);
	$stmt->bindParam("tres", $_GET["tres"]);
	$stmt->execute();	
	$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;	
	

	echo '{"items":'. json_encode($usuario) .'}'; 
} catch(PDOException $e) {

	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>