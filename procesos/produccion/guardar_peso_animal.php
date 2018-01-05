<?php
ob_start();
@session_start();
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$params['numero']='';
$params['nombre_animal']='';
$params['peso_animal']='';
foreach ($_SESSION['detalle_peso_animal'] as $detalle) {
	$params['numero'].=explode('=', $detalle['num_animal'])[0].',';
	$params['nombre_animal'].=explode('=', $detalle['animal'])[0].',';
	$params['peso_animal'].=explode('=', $detalle['peso'])[0].',';
}

$sql="INSERT INTO bit_peso_animal(fecha, empleado, numero, nombre, peso, notas) VALUES('".$params['fecha']."', '".$params['empleado']."', '".$params['numero']."', '".$params['nombre_animal']."', '".$params['peso_animal']."', '".$params['notas']."') RETURNING id";
$response_sql=$data->query($sql, array(), array(), true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Peso del animal guardado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar el peso del animal');
}

unset($_SESSION['detalle_peso_animal']);
echo json_encode($response);
?>