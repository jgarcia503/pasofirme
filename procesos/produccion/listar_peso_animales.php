<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT regexp_split_to_table(rtrim(numero,','),',') numero, regexp_split_to_table(rtrim(nombre,','),',') nombre, regexp_split_to_table(rtrim(peso,','),',') peso FROM bit_peso_animal WHERE id=:id_peso";
$params_sql=array("id_peso");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>