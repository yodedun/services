<?php
include 'config.php';

$sql = "SELECT `id`,`nombre`,`direccion`,`numero` FROM `tblrestaurant` WHERE `comida`=:comida 
and `comuna`=:comuna
		";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("comuna", $_GET[comuna]);
	$stmt->bindParam("comida", $_GET[comida]);
	$stmt->execute();
	$employees = $stmt->fetchAll(PDO::FETCH_OBJ);  
	$dbh = null;
	echo '{"items":'. json_encode($employees) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>