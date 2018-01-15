<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="DELETE FROM palpaciones WHERE id = :id";
$params_sql=array("id");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['total'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Palpación eliminada correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Erro al intentar eliminar los datos');
}

echo json_encode($response);
?>