<?php header('Content-Type: application/json;charset=utf-8');
mysql_set_charset('utf8'); 
 ?>
<?php

header('Access-Control-Allow-Origin: *');

$sql = "SELECT es.nombre, es.direccion, em.cod_eds, em.cod_tecnico, em.evento, em.fecha_hora_asignacion , em.fecha_hora_llegada
FROM 	ag_emergencias em, ag_estacion es where  em.cod_eds = es.codigo and em.activo=1 and em.cod_eds = :edsID" ;

try {

	
    $dbh = new PDO("firebird:dbname=localhost:C:\wamp\www\services\BASE_AG.FDB", "SYSDBA", "masterkey");
    $dbh -> exec("set names utf8");
	/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("edsID", $_GET["id"]);
	$stmt->execute();	
	$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;	
	

	echo '{"items":'. json_encode($usuario) .'}'; 
} catch(PDOException $e) {

	echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}


?>