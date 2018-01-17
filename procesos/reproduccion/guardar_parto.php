<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO partos VALUES(default, :fecha, :animal, :cria, :hora, :empleado, trim(:notas)) RETURNING id";
$params_sql=array("fecha", "animal", "cria", "hora", "empleado", "notas");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Parto ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>