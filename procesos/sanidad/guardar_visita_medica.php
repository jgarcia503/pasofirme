<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO visita_medica VALUES(default, :localizacion, :tecnico, :vacas, :terneras, :fecha, :tipovisita, :novillas, :vacashorras, :costovisita, :botellas, :socio, :animal, :notas) RETURNING id";
$params_sql=array("localizacion", "tecnico", "vacas", "terneras", "fecha", "tipovisita", "novillas", "vacashorras", "costovisita", "botellas", "socio", "animal", "notas");
$response_sql=$data->query($sql, $params, $params_sql, true);
if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Visita m&eacute;dica ingresada correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>