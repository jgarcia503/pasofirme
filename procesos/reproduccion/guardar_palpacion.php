<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$response_nombre=$data->query("SELECT nombre FROM resul_palpaciones WHERE id = :resultado", $params, array("resultado"));
$params['iresultado']=$response_nombre['items'][0]['nombre'];
if ($params['prenada']=='si') {
	$sql_fecha="SELECT fecha FROM servicios WHERE animal = :animal ORDER BY fecha::date DESC LIMIT 1";
	$params_fecha=array("animal");
	$response_fecha=$data->query($sql_servicios, $params, $params_servicios);
	$datetime1 = new DateTime($response_fecha['items'][0]['fecha']);
	$datetime2 = new DateTime($params['fecha']);
	$interval = $datetime1->diff($datetime2);
	$params['dias_prenez']=$interval->format('%a');
}else{
	$params['dias_prenez']=0;
}

$params['icuerno']=($params['resultado']=='9')?$params['cuerno']:'';
$params['igrado_suciedad']=($params['resultado']=='11')?$params['grado_suciedad']:'';
$params['imeses']=($params['prenada']=='si')?$params['meses']:'';

$sql="INSERT INTO palpaciones VALUES(default, :fecha, :hora, :animal, :iresultado, :palpador, :dias_prenez, :prenada, trim(:notas), :icuerno, :igrado_suciedad, :imeses) RETURNING id";
$params_sql=array("fecha", "hora", "animal", "iresultado", "palpador", "dias_prenez", "prenada", "notas", "icuerno", "igrado_suciedad", "imeses");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Palpacion guardada correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>