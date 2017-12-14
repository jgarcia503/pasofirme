<?php
@session_start();
include("../../sql/class.data.php");
$data = new data();

$params=$_POST;

$sql_update = "UPDATE proyectos_enc SET cerrado = 'true', fecha_fin = CURRENT_DATE WHERE id_proyecto=:id_proyecto";
$paramsenc = array("id_proyecto");
$responseenc = $data->query($sql_update, $params, $paramsenc, true);

if ($params['tablon'] == 'No') {
	$sql_update2 = "UPDATE tablones SET estatus = 'descansando' WHERE id IN (SELECT id_tablones::integer FROM proyecto_tablones WHERE id_proyecto = :id_proyecto)";
	$paramstab = array("id_proyecto");
	$responsetab = $data->query($sql_update2, $params, $paramstab, true);
	if ($responsetab["total"] > 0) {
    	$response=array('success'=>true, 'mensaje'=>'El proyecto ha cerrado y el tablon entro a descanso');
	}else{
	    $response=array('success'=>false, 'mensaje'=>'Error al cerrar el proyecto');
	}
} else {
	$sql_update3 = "UPDATE tablones SET estatus = 'libre' WHERE id IN (SELECT id_tablones::integer FROM proyecto_tablones WHERE id_proyecto = :id_proyecto)";
	$paramstab2 = array("id_proyecto");
	$responsetab2 = $data->query($sql_update3, $params, $paramstab2, true);
	if ($responsetab2["total"] > 0) {
    	$response=array('success'=>true, 'mensaje'=>'El proyecto ha cerrado y el tablon quedo libre');
	}else{
	    $response=array('success'=>false, 'mensaje'=>'Error al cerrar el proyecto');
	}
}

echo json_encode($response);
?>