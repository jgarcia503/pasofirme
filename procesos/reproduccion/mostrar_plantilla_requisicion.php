<?php
include("../../sql/class.data.php");
session_start();
$data = new data();
$params=$_POST;
if (!isset($_SESSION['detalle_plantilla'])) {
    $_SESSION['detalle_plantilla']=array();
}
$sql="SELECT b.referencia, b.nombre, a.cantidad, a.unidad FROM plantilla_servicios_requisicion_lns a JOIN productos b ON b.referencia=a.producto_id WHERE enc_id=:id";
$params_sql=array("id");
$response=$data->query($sql, $params, $params_sql);
if (isset($_SESSION['detalle_plantilla'])){
    $rowCount=intval($response['total']);
    foreach ($_SESSION['detalle_plantilla'] as $row) {
            $result=$data->query('select "" b.referencia, b.nombre, a.cantidad, a.unidad from plantilla_servicios_requisicion_lns a join productos b on b.referencia=a.producto_id where enc_id=:id', array('id'=>$params['id']));
            $response['items'][]=$result['items'][0];
            $rowCount++;
    }
    $response['total']=$rowCount;
}
$_SESSION["plantilla_requisicion"]=$response;
echo json_encode($response);
?>