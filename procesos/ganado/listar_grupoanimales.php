<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT a.nombre FROM animales a INNER JOIN grupos b ON a.grupo = b.id::varchar WHERE b.id=:grupo_id";
$params_sql=array("grupo_id");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>