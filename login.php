
<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/conet.php';

// connecting to db
$conn = new DB_CONNECT();

// check for post data
if (isset($_GET["cedula"])) {
    $cedula = $_GET['cedula'];
    $clave = $_GET['clave'];

    // get a product from products table
    $result = ibase_query("SELECT count(*) CANT FROM ag_usuarios where cedula = '$cedula' and clave = '$clave' ");

        while ($row = ibase_fetch_object($result)) {
                $conteo=$row->CANT;
        }

        if ($conteo > 0) {

            if (ibase_num_fields($result) > 0) {

                 $result2 = ibase_query("SELECT AG_EMERGENCIAS.cod_eds COD_EDS, es.nombre NOMBRE_EDS, 
                                AG_EMERGENCIAS.cod_tecnico COD_TEC, 
                                us.nombre NOMBRE_EMP, AG_EMERGENCIAS.evento EVENTO, AG_EMERGENCIAS.fecha_hora_asignacion HORA_ASIG 
                                FROM AG_EMERGENCIAS , ag_estacion es, ag_usuarios us
                                where AG_EMERGENCIAS.cod_tecnico = '$cedula' and AG_EMERGENCIAS.cod_eds = es.codigo and
                                AG_EMERGENCIAS.cod_tecnico = us.cedula order by AG_EMERGENCIAS.fecha_hora_asignacion");

                if (!empty($result2)) {
                // check for empty result
                    if (ibase_num_fields($result2) > 0) {
                        $response["emergency"] = array();
    
                        while ($row = ibase_fetch_object($result2)) {
                        // temp user array
                            $emergency = array();
                            $emergency["cod_eds"] = $row->COD_EDS;
                            $emergency["nom_eds"] = $row->NOMBRE_EDS;
                            $emergency["cod_tec"] = $row->COD_TEC;
                            $emergency["nom_emp"] = $row->NOMBRE_EMP;
                            $emergency["evento"] = $row->EVENTO;
                            $emergency["hor_asi"] = $row->HORA_ASIG;
                            
                            $response["emergency"] = utf8_encode($result2["emergency"]);
                            // push single product into final response array
                            array_push($response["emergency"], $emergency);
                        }
                        // success
                        $response["success"] = 1;
                        $response["message"] = "resultados OK";
                        // echoing JSON response
                        $response["success"] = utf8_encode($result["success"]);
                        $response["message"] = utf8_encode($result["message"]);
                        echo json_encode($response);
                    }
                }
                else {
                // required field is missing
                $response["success"] = 0;
                $response["message"] = "No hay resultados";

                // echoing JSON response
                $response["success"] = utf8_encode($result["success"]);
                $response["message"] = utf8_encode($result["message"]);
                echo json_encode($response);
                }
            }
        } else {
        // no product found
        $response["success"] = 2;
        $response["message"] = "Usuario y clave no coinciden";

        // echo no users JSON
        $response["success"] = utf8_encode($result["success"]);
        $response["message"] = utf8_encode($result["message"]);
        echo json_encode($response);
        }
} else {
        // no product found
$response["success"] = 4;
$response["message"] = "No hay variables";
// echo no users JSON
$response["success"] = utf8_encode($result["success"]);
$response["message"] = utf8_encode($result["message"]);
echo json_encode($response);
        }
?>