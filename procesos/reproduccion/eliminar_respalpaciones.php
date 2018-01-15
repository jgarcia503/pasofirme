<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="DELETE FROM resul_palpaciones WHERE id = :id";
$params_sql=array("id");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['total'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Palpaci&oacute;n eliminada correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar eliminar palpaci&oacute;n');
}

echo json_encode($response);
?>