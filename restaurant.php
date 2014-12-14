<?php
include 'config.php';

$sql = "SELECT * FROM `tblrestaurant` where `id`=:restaurant";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("restaurant", $_GET[restaurant]);
	$stmt->execute();
	$employees = $stmt->fetchAll(PDO::FETCH_OBJ);   
	$dbh = null;
	echo '{"item":'. json_encode($employees) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>