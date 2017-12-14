<?php

/**
 * Description of connDB
 * Copyright(c) 2017
 * @author JOSE ENRIQUE GARCIA
 **/

class connDB {

    // declaracion de variables para conexion mysql
    var $DB_PgSQL;
    var $Server_PgSQL;
    var $Port_PgSQL;
    var $User_PgSQL;
    var $Password_PgSQL;

    function connDB() {
        // parametros para conexion a base de datos de mysql
        $this->DB_PgSQL = "webgan";
        $this->Server_PgSQL = "192.168.1.14";
        $this->Port_PgSQL = "5432";
        $this->User_PgSQL = "ti";
        $this->Password_PgSQL = "arigato";
    }
}
?>