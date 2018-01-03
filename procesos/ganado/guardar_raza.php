<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO razas(nombre, notas) VALUES(:nombre, trim(:notas)) RETURNING id";
$params_sql=array("nombre", "notas");
$response_sql=$data->query($sql, $params, $params_sql, true);
if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'La raza se creo correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>