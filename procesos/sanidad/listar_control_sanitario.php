<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT fecha, hora, evento, empleado FROM controles_sanitarios WHERE animal = :id";
$params_sql=array("id");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>