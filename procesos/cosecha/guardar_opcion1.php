<?php
include("../../sql/class.data.php");
$data = new data();

$params=$_POST;

$sql="INSERT INTO opcion_1(costo_tot_siembra, precio_venta, ton_zacate_prod, utilidad_venta, enc_id) VALUES(:costo, :precio, :toneladas, :utilidad, :enc_id) RETURNING id";
$param_list=array("costo", "precio", "toneladas", "utilidad", "enc_id");
$response_sql=$data->query($sql, $params, $param_list, true);

if ($response_sql['insertId']>0) {
	$response=array('success'=>true, 'mensaje'=>'Registro ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar ingresar los datos');
}
echo json_encode($response);
?>