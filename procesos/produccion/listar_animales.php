<?php
include("../../sql/class.data.php");
$data = new data();
$sql = "SELECT * FROM animales";
$response = $data->query($sql);
echo json_encode($response);
?>