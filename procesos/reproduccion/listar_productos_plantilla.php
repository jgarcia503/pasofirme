<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT b.nombre, a.cantidad, a.unidad FROM plantilla_servicios_requisicion_lns a JOIN productos b ON b.referencia=a.producto_id WHERE enc_id=:id";
$params_sql=array("id");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>