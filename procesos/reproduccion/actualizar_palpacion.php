<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$response_validar=$data->query("SELECT * FROM resul_palpaciones WHERE id = :palpacion_id", $params, array("palpacion_id"));
if ($params['unombre']==$response_validar['items'][0]['nombre']) {
	$response=array('success'=>false, 'mensaje'=>'Los datos son iguales, no hay nada que actualizar');
}else{	
	$sql="UPDATE resul_palpaciones SET nombre=:unombre, notas=trim(:unotas) WHERE id = :palpacion_id";
	$params_sql=array("unombre", "unotas", "palpacion_id");
	$response_sql=$data->query($sql, $params, $params_sql, true);
	if ($response_sql['total'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Palpacion actualizada correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar actualizar los datos');
	}
}

echo json_encode($response);
?>