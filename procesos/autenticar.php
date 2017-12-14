<?php
@ob_start();
@session_start();
include("../sql/class.data.php");
$data = new data();
 
$params = $_POST;
$psw2 = 'admin';
$response=array('success'=>false, 'titulo'=>'Verifique su información!', 'mensaje'=>'Llene correctamente los campos');

if ($params["txtusuario"] === "" || $params["txtusuario"] === null || trim($params["txtusuario"]) === "" || $params["txtpassword"] === "" || $params["txtpassword"] === null || trim($params["txtpassword"]) === "") {
    $response=array('success'=>false, 'titulo'=>'Verifique su información!', 'mensaje'=>'Llene correctamente los campos');
}else {
    $sql="SELECT id, tipo, usuario, nombre, estado FROM contactos
        WHERE usuario=:txtusuario AND contrasena=:txtpassword";
    $param_list = array("txtusuario", "txtpassword");
    $response = $data->query($sql, $params, $param_list);
    if ($response["success"] == true) {
        if ($response["total"] > 0) {
            if ($response["items"][0]["estado"] == "Activo") {
                $_SESSION["helpdesk"] = true;
                $_SESSION["login"] = true;
                $_SESSION["id"] = $response["items"][0]["id"];
                $_SESSION["nombre"] = $response["items"][0]["nombre"];
                $_SESSION["tipo"] = $response["items"][0]["tipo"];
                if ($params["txtpassword"] == $psw2) { 
                    $response=array('success'=>true, 'modulo'=>'?mod=contrasena', 'titulo'=>'Bienvenido', 'mensaje'=> 'Usuario: '.$_SESSION["nombre"]);
                }else{ 
                    $response=array('success'=>true, 'modulo'=>'?mod=inicio', 'titulo'=>'Bienvenido', 'mensaje'=> 'Usuario: '.$_SESSION["nombre"]);
                }
            } else {
                $response=array('success'=>false, 'titulo'=>'comunicarse con administrador de sistema!', 'mensaje'=>'Su usuario ha sido dado de baja');
            }
        } else {
            $response=array('success'=>false, 'titulo'=>'Verifique su información!', 'mensaje'=>'Usuario o contrase&ntilde;a invalidos');
        }
    } else {
            $response=array('success'=>false, 'titulo'=>'Error!', 'mensaje'=>'No esta conectado a un servidor de base de datos');
    }
}
echo json_encode($response);
?>