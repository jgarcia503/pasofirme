<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT * FROM pesos_leches WHERE id=:id_peso";
$params_sql=array("id_peso");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>