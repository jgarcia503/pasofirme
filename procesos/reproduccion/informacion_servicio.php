<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT s.*, c.nombre FROM servicios s INNER JOIN cat_tipos_servicios c ON s.tipo = c.id::character varying WHERE S.id = :id";
$params_sql=array("id");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>