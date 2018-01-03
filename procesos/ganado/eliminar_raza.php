<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql_validar="SELECT raza FROM animales WHERE raza IN (SELECT nombre FROM razas WHERE id = :id_raza)";
$params_validar=array("id_raza");
$response_validar=$data->query($sql_validar, $params, $params_validar);
if ($response_validar['total'] > 0) {
	$response=array('success'=>false, 'mensaje'=>'No se puede eliminar ya existe un animal de esta raza');
}else{
	$sql_delete="DELETE FROM razas WHERE id = :id_raza";
	$params_delete=array("id_raza");
	$response_delete=$data->query($sql_delete, $params, $params_delete, true);
	if ($response_delete['total'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Raza eliminada exitosamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar eliminar raza');
	}
}

echo json_encode($response);
?>