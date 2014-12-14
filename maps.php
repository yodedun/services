<?php
include 'config.php';

$id_inicio = $_GET['id_inicio'];


$sql2 = "SELECT * FROM restauranes";


$sql = "select e.id, e.firstName, e.lastName, e.title, e.picture, e.department, e.managerId, count(e.id) reportCount " . 
		"from employee e left join employee r on r.managerId = e.id " .
		"group by e.department order by e.department";
		//"group by e.id order by e.firstName, e.lastName";

try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->query($sql2 );  
	$employees = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;

	
	foreach($employees as $rest ){
		if( $rest->id == $id_inicio ){
			$inicio = $rest;
		}
	}
	
	
	$array_rest = array( "items"  => $employees , "inicio" => $inicio );

	echo json_encode($array_rest); 
} catch(PDOException $e) {
	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>