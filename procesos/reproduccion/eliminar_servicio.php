<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="DELETE FROM servicios WHERE id = :id_servicio";
$params_sql=array("id_servicio");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['total'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Servicio eliminado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar eliminar el servicio');
}

echo json_encode($response);
?>