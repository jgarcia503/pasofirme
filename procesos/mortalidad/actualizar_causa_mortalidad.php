<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql_causa="UPDATE causas_mortalidades SET nombre=:unombre, notas=trim(:unotas) WHERE id = :id_causa";
$params_causa=array("unombre", "unotas", "id_causa");
$response_causa=$data->query($sql_causa, $params, $params_causa, true);
if ($response_causa['total'] > 0) {
	$sql_mortalidades="UPDATE mortalidades SET causa=:unombre WHERE causa=:causa_anterior";
	$params_mortalidad=array("unombre", "causa_anterior");
	$response_mortalidad=$data->query($sql_mortalidades, $params, $params_mortalidad, true);
	if ($response_mortalidad['success'] == true) {
		$response=array('success'=>true, 'mensaje'=>'Causa de mortalidad actualizada correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar actualizar causa de mortalidad');
	}
}

echo json_encode($response);
?>