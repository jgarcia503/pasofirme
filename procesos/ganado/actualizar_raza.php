<?php
include("../../sql/class.data.php");
$data = new data();
$params =$_POST;

$sql_urazas="UPDATE razas SET nombre=:unombre, notas=trim(:unotas) WHERE id=:raza_id";
$params_urazas=array("unombre", "unotas", "raza_id");
$response_urazas=$data->query($sql_urazas, $params, $params_urazas, true);
$sql_uanimales="UPDATE animales SET raza=:unombre WHERE raza=:nombre_ant";
$params_uanimales=array("unombre", "nombre_ant");
$response_uanimales=$data->query($sql_uanimales, $params, $params_uanimales, true);

if ($response_urazas['total'] > 0 AND $response_uanimales['success'] == true) {
	$response=array('success'=>true, 'mensaje'=>'Raza actualizada correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar actualizar la información');
}

echo json_encode($response);
?>