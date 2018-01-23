<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$response=$data->query("SELECT descripcion FROM visita_medica WHERE id = :id", $params, array("id"));

echo json_encode($response);
?>