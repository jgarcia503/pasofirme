<?php  
ob_start();
@session_start();
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$sql = "SELECT producto_id, cantidad, unidad FROM plantilla_servicios_requisicion_lns WHERE enc_id=:id_enc";
$parametros = array("id_enc");
$respuesta = $data->query($sql, $params, $parametros);
foreach ($respuesta['items'] as $consulta) {
    $encontrado = false;
    $cantidad = 0;
    $unidad = "";
    foreach ($_SESSION['plantilla_requisicion']['items'] as $detalle) {
        if ($consulta['producto_id'] == $detalle["referencia"]) {
            $encontrado = true;
            $cantidad = $detalle["cantidad"];
            $unidad = $detalle["unidad"];
        }
    }
    if ($encontrado == true) {
        if ($consulta['cantidad'] != $cantidad OR $consulta['unidad'] != $unidad) {
            $sql_update = "UPDATE plantilla_servicios_requisicion_lns SET cantidad = :cantidad, unidad = :unidad WHERE enc_id = :id_enc AND producto_id = :producto_id";
            $params_update = array("id_enc"=>$params['id_enc'], "cantidad"=>$cantidad, "unidad"=>$unidad, "producto_id"=>$consulta['producto_id']);
            $response_update = $data->query($sql_update, $params_update, array(), true);
        }
    } else {
        $sql_delete = "DELETE FROM plantilla_servicios_requisicion_lns WHERE enc_id = :id_enc AND producto_id = :producto_id";
        $params_delete = array("id_enc"=>$params['id_enc'], "producto_id"=>$consulta['producto_id']);
        $response_delete = $data->query($sql_delete, $params_delete, array(), true);
    }
}
foreach ($_SESSION['plantilla_requisicion']['items'] as $sesion) {
    $sql2 = "SELECT producto_id FROM plantilla_servicios_requisicion_lns WHERE enc_id = :id_enc AND producto_id = :producto_id";
    $respuesta_lns = $data->query($sql2, array("id_enc"=>$params['id_enc'], "producto_id"=>$sesion["referencia"]));
    if ($respuesta_lns['total'] == 0) {
        $sql_insert = "INSERT INTO plantilla_servicios_requisicion_lns(producto_id, cantidad, unidad, enc_id) VALUES(:producto_id, :cantidad, :unidad, :id_enc) RETURNING id";
        $params_insert = array("producto_id"=>$sesion['referencia'], "cantidad"=>$sesion["cantidad"], "unidad"=>$sesion["unidad"], "id_enc"=>$params['id_enc']);
        $response_insert = $data->query($sql_insert, $params_insert, array(), true);
    }
}
$sql_update2 = "UPDATE plantilla_servicios_requisicion_enc SET fecha_modificacion = NOW(), usuario = :usuario WHERE id_tipo = :id_enc";
$params_update2 = array("usuario"=>$_SESSION['nombre'], "id_enc"=>$params['id_enc']);
$response_update2 = $data->query($sql_update2, $params_update2, array(), true);
if ($response_update['success'] == true || $response_update2['success'] == true || $response_delete['success'] == true || $response_insert['insertId'] > 0) {
    $response = array('success'=>true, 'mensaje'=>"Plantilla actualizada correctamente");
} else {
    $response = array('success'=>false, 'mensaje'=>"Error en la operación");
}

echo json_encode($response);
?>