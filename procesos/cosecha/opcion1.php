<?php
include("../../sql/class.data.php");
$data = new data();

$params=$_POST;

$sql="SELECT sum(subtotal::numeric(1000,2)) total FROM proyectos_lns WHERE enc_id=:id_proyecto";
$param_list=array("id_proyecto");
$response=$data->query($sql, $params, $param_list);

echo json_encode($response);
?>