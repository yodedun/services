<?php header('Content-Type: application/json;charset=utf-8');
mysql_set_charset('utf8'); 
 ?>
<?php
header('Access-Control-Allow-Origin: *');


$sql = "SELECT *
FROM 	ag_emergencias";

try {

	
	
    $dbh = new PDO("firebird:dbname=localhost:c:\wamp\www\services\BASE_AG.FDB", "SYSDBA", "masterkey");

	/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->query($sql);  
	$employees = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;
	echo '{"items":'. json_encode($employees) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>