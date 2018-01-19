<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$mi_sql="INSERT INTO controles_sanitarios(fecha, hora, empleado, evento, animal, notas) VALUES(:fecha, :hora, :empleado, :evento, :animal, trim(:notas)) RETURNING id";
$params_misql=array("fecha", "hora", "empleado", "evento", "animal", "notas");
$response_misql=$data->query($mi_sql, $params, $params_misql, true);
if ($response_misql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Control sanitario ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar el control sanitario');
}

echo json_encode($response);
?>