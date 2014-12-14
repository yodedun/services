<?php

/**
 * A class file to connect to database
 */
class DB_CONNECT {

    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }

    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }

    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables

        // Connecting to mysql database
        //$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
        //$con = ibase_connect("DB_RUTA", "DB_USER", "DB_PASSWORD");
        $con = ibase_connect("localhost:G:\\wamp\\www\\john\\services\\BASE_AG.FDB", "SYSDBA", "masterkey");
        if (!$con) { 
            echo "Acceso Denegado!";
        exit; }
        // Selecing database
        //$db = mysql_select_db(DB_DATABASE) or die(mysql_error()) or die(mysql_error());

        // returing connection cursor
      
        return $con;
    }

    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        ibase_close();
    }

}

?>