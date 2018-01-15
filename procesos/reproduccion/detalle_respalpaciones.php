<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT * FROM resul_palpaciones WHERE id = :id";
$params_sql=array("id");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>