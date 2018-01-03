<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql_validar="SELECT nombre FROM colores WHERE nombre=:nombre";
$params_validar=array("nombre");
$response_validar=$data->query($sql_validar, $params, $params_validar);

if ($response_validar['total'] > 0) {
	$response=array('success'=>false, 'mensaje'=>'El color '.$response_validar['items'][0]['nombre'].' ya existe');
}else{
	$sql="INSERT INTO colores(nombre) VALUES(:nombre) RETURNING id";
	$params_sql=array("nombre");
	$response_sql=$data->query($sql, $params, $params_sql, true);
	if ($response_sql['insertId'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Color ingresado correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar el color');
	}
}

echo json_encode($response);
?>