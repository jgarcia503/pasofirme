<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql_fotos="SELECT fotos FROM animales WHERE id = :id_animal";
$params_fotos=array("id_animal");
$response_fotos=$data->query($sql_fotos, $params, $params_fotos);

unlink("../../upload/ganado/".$response_fotos['items'][0]['fotos']);

$sql="DELETE FROM animales WHERE id = :id_animal";
$params_list=array("id_animal");
$response_sql=$data->query($sql, $params, $params_list, true);

if ($response_sql['total'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Registro eliminado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar el eliminar el registro');
}

echo json_encode($response);
?>