<?php
	include("../../sql/class.data.php");
	$data = new data();

	$params = $_POST;

	$sql="SELECT nombre, costo_uso_x_dia FROM tablones WHERE id::text IN (SELECT regexp_split_to_table(id_tablones, ',') FROM proyecto_tablones WHERE id_proyecto = :proyecto_id)";
	$param_list=array("proyecto_id");
	$response=$data->query($sql, $params, $param_list);
echo json_encode($response);
?>