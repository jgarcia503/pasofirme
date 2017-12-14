<?php

include_once ("class.managerDB.php");

class data {

    #Constructor
    function data() {      
    }
    
    # Ejecuta consultas SQL
    # Parametros:
    #   sql: consulta sql  (requerido)
    #   params: Array asociativo GET o POST (sino se especifica params_list se utiliza el array completo)
    #   params_list: Lista de parametros para la consulta
    #   transaction: True o False para usar mysql con rollback
    #   strip_tags: True o False para eliminar las etiquetas HTML de la consulta sql
    function query ($sql, $params=array(), $param_list=array(), $transaction=false, $strip_tags=false, 
        $database="pgsql") {
        $managerDB = new managerDB();
        $connection = $managerDB->conectar($database);
        if ($connection!=null) {
            $response=array('success'=>true);
            try {
                $query=$connection->prepare($sql);
                foreach ($param_list as $param) {
                    if ($param=='start' or $param=='limit') {
                        @$query->bindParam(':'.$param, intval($params[$param]), PDO::PARAM_INT);
                    } else {
                        if ($strip_tags)    $params[$param]=strip_tags($params[$param]);
                        @$query->bindParam(':'.$param, $params[$param]);
                    }
                }
                if ($transaction) $connection->beginTransaction();
                if (count($param_list)>0) {
                    $query->execute();
                } else {
                    $query->execute($params);
                }
                if ($transaction) {
                    $response['insertId']=$query->fetchColumn();
                    $connection->commit();
                }
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }
}    
?>        