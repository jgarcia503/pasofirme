<?php
ob_start();
@session_start();
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

foreach ($_SESSION['detalle_prueba_cmt'] as $detalle) {
	$sql="INSERT INTO pruebas_cmt VALUES(default, '".$detalle['numero']."', '".$params['fecha']."', '".$detalle['di']."', '".$detalle['dr']."', '".$detalle['ti']."', '".$detalle['tr']."') RETURNING id";
	$response_sql=$data->query($sql, array(), array(), true);
}
if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Prueba CMT ingresada correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>