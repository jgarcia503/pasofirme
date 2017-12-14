<?php
@session_start();
include("../../sql/class.data.php");
$data = new data();

$params = $_POST;

$sql_correlativo="SELECT (count(to_char(fecha_inicio::date,'YYYY'))+1) AS correlativo FROM proyectos_enc WHERE to_char(fecha_inicio::date,'YYYY')='".explode('-', $params['fecha_inicio'])[2]."'";
$response_correlativo = $data->query($sql_correlativo, array(), array());
$fecha=date("Ym", strtotime($params['fecha_inicio']));
$params['numero'] = $response_correlativo['items'][0]['correlativo'];
$params['correlativo_proyecto'] = $fecha.'_'.$params['cultivo'].'_'.$params['numero'];

$sql_proyectosenc="INSERT INTO proyectos_enc(nombre_proyecto, fecha_inicio, cerrado, bodega_seleccionada, tipo_cultivo, notas, correlativo_proyecto, subtipo_cultivo) VALUES(:nombre, :fecha_inicio, 'false', :bodega, :cultivo, :notas, :correlativo_proyecto, :subtipo_cultivo) RETURNING id_proyecto";
$params_proyectosenc= array("nombre", "fecha_inicio", "bodega", "cultivo", "notas", "correlativo_proyecto", "subtipo_cultivo");
$response_proyectosenc = $data->query($sql_proyectosenc, $params, $params_proyectosenc, true);

//Verificamos que el se haya hecho el ingreso de los datos para afectar a las demas tablas
if ($response_proyectosenc['insertId'] > 0) {
	$params['id_proyecto'] = $response_proyectosenc['insertId'];
	$params['id_tablones'] = implode(',', $params['tablones']);
	$sql_btrim="SELECT btrim(array(SELECT costo_uso_x_dia FROM tablones WHERE id IN(:id_tablones))::text,'{}')";
	$params_btrim=array("id_tablones");
	$response_btrim=$data->query($sql_btrim, $params, $params_btrim);
	if ($response_btrim['total']>0) {
		$params['costo_uso']=$response_btrim['items'][0]['costo_uso_x_dia'];
	}
	$sql_proyectotab="INSERT INTO proyecto_tablones(id_proyecto, id_potrero, id_tablones, costo_uso_x_dia) VALUES(:id_proyecto, :potrero, :id_tablones, :costo_uso) RETURNING id";
	$params_proyectostab=array("id_proyecto", "potrero", "id_tablones", "costo_uso");
	$response_proyectostab = $data->query($sql_proyectotab, $params, $params_proyectostab, true);

	if ($response_proyectostab['insertId'] > 0) {
		$sql_tablones="UPDATE tablones SET estatus='ocupado' WHERE id IN ($params[id_tablones])";
		$response_tablones = $data->query($sql_tablones, array(), array(), true);
	}
	$response=array('success'=>true, 'mensaje'=>'Registro ingresado correctamente', 'referencia'=>$params['correlativo_proyecto']);
} else {
	$response=array('success'=>false, 'error'=>'Error al ingresar los datos');
}

echo json_encode($response);
?>