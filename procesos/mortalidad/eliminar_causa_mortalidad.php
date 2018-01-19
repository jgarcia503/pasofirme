<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql_validar="SELECT causa FROM mortalidades WHERE causa IN (SELECT nombre FROM causas_mortalidades WHERE id=:id)";
$params_validar=array("id");
$response_validar=$data->query($sql_validar, $params, $params_validar);
if ($response_validar['total'] > 0) {
	$response=array('success'=>false, 'mensaje'=>'No se puede eliminar, ya se encuentra en uso.');
}else{
	$sql="DELETE FROM causas_mortalidades WHERE id=:id";
	$params_sql=array("id");
	$response_sql=$data->query($sql, $params, $params_sql, true);
	if ($response_sql['total'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Causa de mortalidad eliminada correctamente.');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar eliminar causa de mortalidad.');
	}
}

echo json_encode($response);
?>