<?php
include("../../sql/class.managerDB.php");
/**
* 
*/
class functions
{
	function calcular_costo_proyecto($id){
		$managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT sum(subtotal::numeric(1000,2)) total FROM proyectos_lns WHERE enc_id:'$id'";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return floatval($response);
        unset($connection);
        unset($query);
	}
}
?>