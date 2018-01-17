<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

if ($params['estado'] != 'muerto') {
	$sql="INSERT INTO animales(numero, nombre, fecha_nacimiento, peso_nacimiento, sexo, estado) VALUES(:numero, :nombre, :fnacimiento, :pnacimiento, :sexo, :estado) RETURNING id";
	$params_sql=array("numero", "nombre", "fnacimiento", "pnacimiento", "sexo", "estado");
	$response_sql=$data->query($sql, $params, $params_sql, true);
	if ($response_sql['insertId'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Animal guardado correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
	}
}else{
	$sql="INSERT INTO partos(fecha, contacto, notas, sexo_cria, estado) VALUES(:fnacimiento, :empleado, :notas, :sexo, :estado) RETURNING id";
	$params_sql=array("fnacimiento", "empleado", "notas", "sexo", "estado");
	$response_sql=$data->query($sql, $params, $params_sql, true);
	if ($response_sql['insertId'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Parto guardado correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
	}
}


echo json_encode($response);
?>