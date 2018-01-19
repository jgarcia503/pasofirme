<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO causas_mortalidades VALUES(default, :nombre, trim(:notas)) RETURNING id";
$params_sql=array("nombre", "notas");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Causa de mortalidad ingresada correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar causa de mortalidad');
}

echo json_encode($response);
?>