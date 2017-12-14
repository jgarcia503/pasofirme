<?php

include_once ("class.connDB.php");

#Esta clase nos permitira conectarnos a la base de datos
class managerDB {
    
    #Constructor
    function managerDB() {       
    }

    function conectar($tipo) {
        $conectar = new connDB();
        try {
            if ($tipo == "pgsql") {
                $connection = new PDO("pgsql:host=$conectar->Server_PgSQL;port=$conectar->Port_PgSQL;dbname=$conectar->DB_PgSQL;", "$conectar->User_PgSQL", "$conectar->Password_PgSQL");
            }
        } catch (PDOException $e) {
            //echo $e->getMessage();
            $connection = null;
        }
        return($connection);
    }
}
?>