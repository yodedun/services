
<?php
header('Access-Control-Allow-Origin: *');

$sql = "UPDATE 
ag_emergencias SET DESCRIPCION= :descripcion, NRO_REPORTE = :nro, FECHA_HORA_SALIDA = CURRENT_TIMESTAMP , activo=0
WHERE COD_EDS=:cod and activo=1 ";

try {

	
	
    $dbh = new PDO("firebird:dbname=localhost:C:\wamp\www\services\BASE_AG.FDB", "SYSDBA", "masterkey");

	/*$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);*/	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $dbh->prepare($sql);  
	$stmt->bindParam("nro", $_POST[nroReporte]);
	$stmt->bindParam("descripcion", $_POST[descripcion]);
	$stmt->bindParam("cod", $_POST[id]);
	$stmt->execute();	
	$usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
	$dbh = null;
	echo '1'; 
	
} catch(PDOException $e) {
	echo '7'; 
}


?>