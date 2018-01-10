<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="INSERT INTO pesos_leches(empleado, fecha, animal, peso, hora, notas) VALUES(:empleado, :fecha, :animal, :peso, :hora, :notas) RETURNING id";
$params_sql=array("empleado", "fecha", "animal", "peso", "hora", "notas");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Peso de leche ingresado correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

echo json_encode($response);
?>