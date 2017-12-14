<?php  
@session_start();
include("../../sql/class.data.php");
$data = new data();

$params = $_POST;

$sql_validar="SELECT * FROM haciendas";
$response_validar=$data->query($sql_validar, array(), array());

if ($response_validar['items'][0]['nit'] != $params['nit'] OR $response_validar['items'][0]['nombre'] != $params['nombre'] OR $response_validar['items'][0]['propietario'] != $params['propietario'] OR $response_validar['items'][0]['direccion'] != $params['direccion'] OR $response_validar['items'][0]['telefono'] != $params['telefono'] OR $response_validar['items'][0]['correo'] != $params['correo'] OR $response_validar['items'][0]['notas'] != $params['notas']) {
	
	$sql = "UPDATE haciendas SET nit=:nit, nombre=:nombre, propietario=:propietario, direccion=:direccion, telefono=:telefono, correo=:correo, notas=:notas";
	$params_list = array("nit", "nombre", "propietario", "direccion", "telefono", "correo", "notas");
	$response_update = $data->query($sql, $params, $param_list, true);
	if ($response_update['success'] == true) {
		$response = array('success'=>true, 'mensaje'=>'Registro actualizado');
	} else {
		$response = array('success'=>false, 'mensaje'=>'Error al actualizar el  registro');
	}
} else {
	$response = array('success'=>false, 'mensaje'=>'Los datos a ingresar son iguales');
}

echo json_encode($response);
?>