<?php
	include("../../sql/class.data.php");
	$data = new data();
	$params = $_POST;

	$sql="SELECT v.* FROM vegetaciones v INNER JOIN tipo_vegetacion tv ON v.id_tipo_cultivo::integer = tv.id WHERE v.id_tipo_cultivo::integer = :tipo";
	$param_list=array("tipo");
	$response=$data->query($sql, $params, $param_list);

echo json_encode($response);
?>