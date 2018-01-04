<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="UPDATE grupos SET nombre=:unombre, produccion_minima=:upbotella WHERE id=:id_grupo";
$params_sql=array("unombre", "upbotella", "id_grupo");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['total'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Grupo actualizado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar actualizar el grupo');
}

echo json_encode($response);
?>