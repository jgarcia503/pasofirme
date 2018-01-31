<?php
ob_start();
@session_start();
include("../../sql/class.data.php");
$data = new data();
include("../../sql/class.functions.php");
$kardex = new kardex();
$params = $_POST;

$sql_insert="INSERT INTO tratamientos_enc VALUES(default, :fecha, :animal, :descripcion, :tipo, trim(:notas)) RETURNING id";
$params_insert=array("fecha", "animal", "descripcion", "tipo", "notas");
$response_insert=$data->query($sql_insert, $params, $params_insert, true);
$ultimo_id=$response_insert['insertId'];
foreach ($_SESSION['detalle_tratamiento_medico'] as $detalle) {
$sql_insert2="INSERT INTO tratamientos_lns VALUES(default, '".$detalle['referencia']."', '".$detalle['cantidad']."', '".$detalle['desde']."', '".$detalle['hasta']."', '".$detalle['medida']."', '".$detalle['vecesxdia']."', '".$ultimo_id."') RETURNING id";
$response_insert2=$data->query($sql_insert2, array(), array(), true);
	$f1=new DateTime($detalle['desde']);
	$f2=new DateTime($detalle['hasta']);
	$dias=$f2->diff($f1)->days;
	$decrease_inv[]=array("cantidad"=>($detalle['cantidad']*$detalle['vecesxdia']*$dias), "referencia"=>$detalle['referencia'], "ultimo_id"=>$ultimo_id);
}
$response_kardex=$kardex->decrease_inventario_farmacia($decrease_inv,2);

if ($response_insert2['insertId'] > 0 && $response_kardex['success']=='si') {
	$response=array('success'=>true, 'mensaje'=>'Tratamiento medico ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>