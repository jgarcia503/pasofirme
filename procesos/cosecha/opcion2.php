<?php
include("../../sql/class.data.php");
$data = new data();

$params=$_POST;

$sql_total="SELECT sum(subtotal::numeric(1000,2)) total FROM proyectos_lns WHERE enc_id='".$_POST['id_proyecto']."'";
$response_total=$data->query($sql_total, array(), array());
$costo_total=floatval($response_total['items'][0]['total']);

$sql_ctablones="SELECT sum(a.dato) AS ctotal FROM (SELECT ((regexp_split_to_table(costo_uso_x_dia,',')::numeric(1000,10)*(SELECT fecha_fin::date-fecha_inicio::date FROM proyectos_enc WHERE id_proyecto = :id_proyecto))) AS dato FROM proyecto_tablones WHERE id_proyecto = :id_proyecto) AS a";
$params_tablones=array("id_proyecto");
$response_tablones=$data->query($sql_ctablones, $params, $params_tablones);

$ctotal=number_format(($costo_total+$response_tablones['items'][0]['ctotal']),2);
$response=array('success'=>true, 'total'=>$ctotal);
echo json_encode($response);
?>