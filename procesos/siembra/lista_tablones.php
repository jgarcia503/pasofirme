<?php                  
@session_start();
include("../../sql/class.data.php");
$data = new data();

$params = $_POST;

$sql = "SELECT * FROM tablones WHERE terreno_id = :id AND estatus = 'libre'";
$param_list = array("id");
$response = $data->query($sql, $params, $param_list);

echo json_encode($response);