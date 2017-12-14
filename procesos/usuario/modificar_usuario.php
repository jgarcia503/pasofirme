<?php
include("../../sql/class.data.php");

$params=$_POST;
$data= new data();

$sql_validar = "SELECT * FROM contactos WHERE id = :id_usuario";
$params_validar = array("id_usuario");
$response_validar = $data->query($sql_validar, $params, $params_validar);

if ($params['tusuario'] == 'admin' OR $params['tusuario'] == 'empleado') {
    if ($response_validar['items'][0]['tipo'] != $params['tusuario'] OR $response_validar['items'][0]['usuario'] != $params['usuario'] OR $response_validar['items'][0]['nombre'] != $params['nombre']) {
        $sql_update="UPDATE contactos SET tipo=:tusuario, usuario=:usuario, telefono=:telefono, nombre=:nombre, correo=:correo WHERE id = :id_usuario";
        $params_update = array("tusuario", "usuario", "telefono", "nombre", "correo", "id_usuario");
        $response_update = $data->query($sql_update, $params, $params_update, true);
        if ($response_update['success'] == true) {
            $response = array('success'=>true, 'mensaje'=>'Usuario modificado correctamente');
        }else{
            $response = array('success'=>false, 'mensaje'=>'Error en la modificación de los datos');
        }
    }else{
        $response = array('success'=>false, 'mensaje'=>'Todos los datos son iguales');
    }
}else{
    if ($response_validar['items'][0]['tipo'] != $params['tusuario'] OR $response_validar['items'][0]['nombre'] != $params['nombre']) {
        $sql_update="UPDATE contactos SET tipo=:tusuario, telefono=:telefono, nombre=:nombre, correo=:correo, usuario='', contrasena='' WHERE id = :id_usuario";
        $params_update = array("tusuario", "telefono", "nombre", "correo", "id_usuario");
        $response_update = $data->query($sql_update, $params, $params_update, true);
        if ($response_update['success'] == true) {
            $response = array('success'=>true, 'mensaje'=>'Usuario modificado correctamente');
        }else{
            $response = array('success'=>false, 'mensaje'=>'Error en la modificación de los datos');
        }
    }else{
        $response = array('success'=>false, 'mensaje'=>'Todos los datos son iguales');
    }
}
echo json_encode($response);
?>