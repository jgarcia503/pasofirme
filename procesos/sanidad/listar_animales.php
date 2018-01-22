<?php
include("../../sql/class.data.php");
$data = new data();

$response=$data->query("SELECT numero, nombre FROM animales");

echo json_encode($response);
?>