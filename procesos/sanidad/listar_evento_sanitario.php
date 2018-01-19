<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT fecha, hora, animal FROM controles_sanitarios WHERE evento IN (SELECT nombre FROM eventos_sanitarios WHERE id=:id)";
$params_sql=array("id");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>