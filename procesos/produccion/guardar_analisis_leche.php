<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$params['val_reductasa']=($params['reductasa_val']==='')?0.0000:$params['reductasa_val'];
$params[val_acidez]=($params[acidez_val]==='')?0.0000:$params[acidez_val];
$params[val_temperatura]=($params[temperatura_val]==='')?0.0000:$params[temperatura_val];
$params[val_agua]=($params[agua_val]==='')?0.0000:$params[agua_val];

$sql="INSERT INTO analisis_leche VALUES(default, '".$params['fecha']."', '".$params['cantidad']."', '".$params['recepcion']."', '".$params['grasa']."', '".$params['grasa_val']."', '".$params['proteina']."', '".$params['proteina_val']."', '".$params['rcs']."', '".$params['rcs_val']."', '".$params['reductasa']."', '".$params['val_reductasa']."', '".$params['acidez']."', ".$params[val_acidez].", ".$params[val_temperatura].", '".$params['temperatura']."', '".$params['agua']."', ".$params[val_agua].") RETURNING id";
$response_sql=$data->query($sql, array(), array(), true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Análisis de leche ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>