<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql_validar="SELECT color FROM animales WHERE color IN (SELECT nombre FROM colores WHERE id=:id_color)";
$params_validar=array("id_color");
$response_validar=$data->query($sql_validar, $params, $params_validar);

if ($response_validar['total'] > 0) {
	$response=array('success'=>false, 'mensaje'=>'No se puede eliminar, ya existe un animal con este color');
}else{
	$sql_delete="DELETE FROM colores WHERE id=:id_color";
	$params_delete=array("id_color");
	$response_delete=$data->query($sql_delete, $params, $params_delete, true);

	if ($response_delete['total'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Color eliminado correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar eliminar el color');
	}
}

echo json_encode($response);
?>