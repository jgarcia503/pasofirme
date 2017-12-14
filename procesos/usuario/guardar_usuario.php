<?php
@session_start();
include("../../sql/class.data.php");
$data = new data();

$params = $_POST;
$params['usuario'] = (isset($params['usuario'])) ? $params['usuario'] : '';

$sql="SELECT usuario FROM contactos WHERE usuario = :usuario";
$param_validar_usuario = array("usuario");
$response_validar_usuario = $data->query($sql, $params, $param_validar_usuario);
if ($response_validar_usuario['total'] > 0) {
    $response = array('success'=>false, 'mensaje'=>'Este nombre de usuario ya esta en uso');
}else{
	if ($params['tipo'] == 'admin' OR $params['tipo'] == 'empleado') {
	    $sql = "INSERT INTO contactos(tipo, usuario, telefono, nombre, contrasena, correo, estado) VALUES(:tipo, :usuario, :telefono, :nombre, 'admin', :correo, 'Activo') RETURNING id";
	    $param_list = array("tipo", "usuario", "telefono", "nombre", "correo");
	    $response_insert = $data->query($sql, $params, $param_list, true);
	    if ($response_insert['insertId'] > 0) {
	        $response = array('success'=>true, 'mensaje'=>'Usuario ingresado con exito');
	    } else {
	        $response = array('success'=>false, 'mensaje'=>'Error al ingresar los datos');
	    }
	} else {
		$sql = "INSERT INTO contactos(tipo, telefono, nombre, correo, estado) VALUES(:tipo, :telefono, :nombre, :correo, 'Activo') RETURNING id";
	    $param_list = array("tipo", "telefono", "nombre", "correo");
	    $response_insert = $data->query($sql, $params, $param_list, true);
	    if ($response_insert['insertId'] > 0) {
	        $response = array('success'=>true, 'mensaje'=>'Usuario ingresado con exito');
	    } else {
	        $response = array('success'=>false, 'mensaje'=>'Error al ingresar los datos');
	    }
	}
}

echo json_encode($response);
?>