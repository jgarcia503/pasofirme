<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO servicios VALUES(default, :fecha, :hora, :animal, :tipo, :inseminador, :padre, :donadora, trim(:notas), :pajilla, :horavisualizacion) RETURNING id";
$params_sql=array("fecha", "hora", "animal", "tipo", "inseminador", "padre", "donadora", "notas", "pajilla", "horavisualizacion");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$sql_update="UPDATE pajillas_toros SET disponible = 'false' WHERE codigo_pajilla=:pajilla";
	$params_update=array("pajilla");
	$response_update=$data->query($sql_update, $params, $params_update, true);
	
	$response=array('success'=>true, 'mensaje'=>'Servicio ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>