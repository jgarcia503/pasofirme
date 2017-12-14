<?php

@session_start();
include("../../sql/class.data.php");

$data = new data();
$params = $_POST;

$params["id_usuario"] = $_SESSION["id"];
$sql = "UPDATE contactos SET contrasena=:txtPassword WHERE id=:id_usuario AND contrasena=:txtActual";
$param_list = array("txtPassword", "id_usuario", "txtActual");
$response = $data->query($sql, $params, $param_list);
if ($response["total"] > 0) {
    $response=array('success'=>true, 'titulo'=>'Operacion exitosa!', 'mensaje'=>'La contraseña ha sido modificada');
}else{
    $response=array('success'=>false, 'titulo'=>'Verifique su información!', 'mensaje'=>'La contraseña no ha sido modificada');
}
echo json_encode($response);
?>