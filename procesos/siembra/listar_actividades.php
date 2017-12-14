<?php
	include("../../sql/class.data.php");
	$data = new data();
	$params = $_POST;

	$sql="SELECT * FROM proyectos_lns WHERE enc_id = :proyecto_id";
	$params_list = array("proyecto_id");
	$response = $data->query($sql, $params, $params_list);
echo json_encode($response);
?>