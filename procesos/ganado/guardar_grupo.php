<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$params['pminima']=($params['clasificacion']=='produccion')?$params['produccion_botellas']:'n/a';
$params['dnacida']=($params['clasificacion']=='desarrollo')?$params['dias_nacida']:'n/a';

$sql="INSERT INTO grupos(nombre, clasificacion, produccion_minima, dias_nac) VALUES(:nombre, :clasificacion, :pminima, :dnacida) RETURNING id";
$params_sql=array("nombre", "clasificacion", "pminima", "dnacida");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Grupo ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar el grupo');
}

echo json_encode($response);
?>