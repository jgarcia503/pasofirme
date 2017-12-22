<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO opcion_8(costo_cortar_manojear, costo_secar, costo_aporreo, costo_siembra, enc_id) VALUES(:cortar_manojear, :secar, :aporreo, :csiembra, :enc_id) RETURNING id";
$params_sql=array("cortar_manojear", "secar", "aporreo", "csiembra", "enc_id");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$sql_update="UPDATE proyectos_enc SET opcion='8' WHERE id_proyecto = :enc_id";
	$params_update=array("enc_id");
	$response_update=$data->query($sql_update, $params, $params_update, true);
}

if ($response_update['total'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Datos guardados correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>