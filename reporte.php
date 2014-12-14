<?php header('Content-Type: application/json');
 ?>
<?php

header('Access-Control-Allow-Origin: *');

$sql = "UPDATE ag_emergencias SET LATITUD= :lati, LONGITUD = :long, FECHA_HORA_LLEGADA = CURRENT_TIMESTAMP WHERE COD_EDS=:cod and activo=1 ";

try {

	
    $dbh = new PDO("firebird:dbname=localhost:c:\wamp\www\services\BASE_AG.FDB", "SYSDBA", "masterkey");

	/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("lati", $_POST["lat"]);
	$stmt->bindParam("long", $_POST["lon"]);
	$stmt->bindParam("cod", $_POST["cod"]);

	$stmt->execute();	
	$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;

	if ($usuario == 0) {
		 echo 'error';
	} elseif (!$usuario) {
	    echo '3'; 
	} else {
		echo '4'; 
  
	}	
	
} catch(PDOException $e) {

	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>