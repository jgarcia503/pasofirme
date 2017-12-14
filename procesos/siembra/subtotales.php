<?php
function convertir($unidad,$cantidad){
    #unidades estandar dentro del sistema kg y litros
    
    #de peso
    $conversiones['qq']=100;#quintal 100kg
    $conversiones['ton']=1000;
    $conversiones['g']=0.001;
    $conversiones['kg']=1;
    $conversiones['oz']=0.03;
    $conversiones['lb']=0.45;
    #de volumen
    $conversiones['ml']=0.001;
    $conversiones['lt']=1;
    
    $resultado=$conversiones[$unidad]*floatval($cantidad);
    
    return $resultado;    
}
include("../../sql/class.data.php");
$data = new data();

$params = $_POST;

if ($params['tipo'] == 'material') {
	$sql="SELECT precio_promedio FROM productos WHERE nombre= :producto";
	$params_list = array("producto");
	$response_ppromedio = $data->query($sql, $params, $params_list);
	if ($response_ppromedio['total'] > 0) {
		$ppromedio = $response_ppromedio['items'][0]['precio_promedio'];
		$precio_conv = convertir($params['unidad'], $params['cantidad']);
		$subtotal = floatval($precio_conv*$ppromedio);
		$response = array('success'=>true, 'subtotal'=>$subtotal);
	}
}elseif ($params['tipo'] == 'deterioro activo') {
	$sql_deterioro="SELECT precio_promedio FROM activo WHERE nombre=:activo";
	$param_deterioro=array("activo");
	$response_deterioro=$data->query($sql_deterioro, $params, $param_deterioro);
	if ($response_deterioro['total'] > 0) {
		$params['costo_deterioro']=$response_deterioro['items'][0]['precio_promedio'];
		$subtotal = floatval($params['costo_deterioro']*$params['horas_uso']);
		$response = array('success'=>true, 'subtotal'=>$subtotal);
	}
}
echo json_encode($response);
?>