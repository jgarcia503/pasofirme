<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="UPDATE servicios SET fecha=:fecha, hora=:hora, animal=:animal, tipo=:tipo, inseminador=:inseminador, padre=:padre, donadora=:donadora, notas=trim(:notas) WHERE id = :id_servicios";
$params_sql=array("fecha", "hora", "animal", "tipo", "inseminador", "padre", "donadora", "notas", "id_servicios");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['total'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Servicio actualizado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar actualizar los datos');
}

echo json_encode($response);
?>