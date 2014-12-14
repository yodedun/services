<?php
header('Access-Control-Allow-Origin: *');
include 'config.php';

$sql = "SELECT `m`.`id`,`m`.`descripcion`,count(`r`.`nombre`)as `count`
FROM 	`tblrestaurant` `r`,
	`tblcomuna` `m`,
	`tblcomidas` `c`
WHERE `c`.`id`=`r`.`comida`
and `m`.`id`=`r`.`comuna`
and `c`.`id`=:comida
group by `m`.`descripcion`
		";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("comida", $_GET[comida]);
	$stmt->execute();
	$employees = $stmt->fetchAll(PDO::FETCH_OBJ);  
	$dbh = null;
	echo '{"items":'. json_encode($employees) .'}'; 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}

?>