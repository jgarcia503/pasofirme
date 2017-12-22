<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO opcion_7(costo_siembra, costo_mano_obra_cosecha, costo_mano_obra_picado, costo_transporte, notas, enc_id) VALUES(:csiembra, :mano_obra, :picado, :ctransporte, :notas, :enc_id) RETURNING id";
$params_sql=array("csiembra", "mano_obra", "picado", "ctransporte", "notas", "enc_id");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$sql_update="UPDATE proyectos_enc SET opcion='7' WHERE id_proyecto=:enc_id";
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