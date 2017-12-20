<?php
include("../../sql/class.data.php");
$data = new data();
$params=$_POST;

$sql_op4="INSERT INTO opcion_4(costo_siembra, venta_siembra, enc_id) VALUES(:elote_zacate, :venta_siembra, :enc_id) RETURNING id";
$params_op4=array("elote_zacate", "venta_siembra", "enc_id");
$response_op4=$data->query($sql_op4, $params, $params_op4, true);

if ($response_op4['insertId'] > 0) {
	$sql_update="UPDATE proyectos_enc SET opcion='4' WHERE id_proyecto = :enc_id";
	$params_update=array("enc_id");
	$response_update=$data->query($sql_update, $params, $params_update, true);
}
if ($response_update['total'] > 0) {
	$response = array('success'=>true, 'mensaje'=>'Datos almacenados correctamente');
}else{
	$response = array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>