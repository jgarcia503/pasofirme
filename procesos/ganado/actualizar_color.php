<?php 
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql_ucolores="UPDATE colores SET nombre=:unombre WHERE id=:id_color";
$params_ucolores=array("unombre", "id_color");
$response_ucolores=$data->query($sql_ucolores, $params, $params_ucolores, true);
$sql_uanimales="UPDATE animales SET color=:unombre WHERE color=:nombre_ant";
$params_uanimales=array("unombre", "nombre_ant");
$response_uanimales=$data->query($sql_uanimales, $params, $params_uanimales, true);

if ($response_ucolores['total'] > 0 AND $response_uanimales['success'] == true) {
	$response=array('success'=>true, 'mensaje'=>'Color actualizado correctamente');
}else{
	$response=array('succes'=>false, 'mensaje'=>'Error al intentar actualizar el color');
}

echo json_encode($response);
?>