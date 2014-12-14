<?php
header('Access-Control-Allow-Origin: *');
include 'config.php';

$sql = "SELECT *
FROM 	ag_usuarios";

try {

	
	$str_conn = "firebird:dbname=192.168.0.18:C:\wamp\www\base\BASE_AG.FDB";
    $dbh = new PDO($str_conn, "SYSDBA", "masterkey");

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