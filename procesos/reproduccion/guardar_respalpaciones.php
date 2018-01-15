<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO resul_palpaciones VALUES(default, :nombre, trim(:notas)) RETURNING id";
$params_sql=array("nombre", "notas");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Resultado de palpacion ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>