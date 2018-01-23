<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

if ($params['estado'] != 'muerto') {
	$sql="INSERT INTO animales(numero, nombre, fecha_nacimiento, peso_nacimiento, sexo, estado) VALUES(:numero, :nombre, :fnacimiento, :pnacimiento, :sexo, :estado) RETURNING id";
	$params_sql=array("numero", "nombre", "fnacimiento", "pnacimiento", "sexo", "estado");
	$response_sql=$data->query($sql, $params, $params_sql, true);
	if ($response_sql['insertId'] > 0) {
		$response=array('success'=>true, 'mensaje'=>'Animal guardado correctamente', 'titulo'=>'Operacion Exitosa', 'icon'=>'fa fa-check-circle', 'item'=>"<input type='hidden' value='".$params['estado']."' name='estado' readonly>"."<input type='hidden' value='".$params['sexo']."' name='sexo' readonly>");
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos', 'titulo'=>'Verifique su informacion', 'icon'=>'fa fa-exclamation');
	}
}else{
	$response=array('item'=>"<input type='hidden' value='".$params['estado']."' name='estado' readonly>"."<input type='hidden' value='".$params['sexo']."' name='sexo' readonly>");
}

echo json_encode($response);
?>