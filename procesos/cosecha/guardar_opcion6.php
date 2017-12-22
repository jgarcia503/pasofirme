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
ob_start();
@session_start();
include("../../sql/class.data.php");
$data = new data();
$params=$_POST;

$params['costo_silo']=filter_var($params['csiembra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_cosecha_mano_obra']=filter_var($params['mano_obra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_picar_mano_obra']=filter_var($params['picado'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_transporte']=filter_var($params['ctransporte'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_silo']+=($params['costo_cosecha_mano_obra']+$params['costo_picar_mano_obra']+$params['costo_transporte']);

$params['kg_tforraje']=convertir('ton',filter_var($params['testimadas'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$params['costo_promedio']=filter_var($params['costo_silo'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION)/$params['kg_tforraje'];

$sql_op6="INSERT INTO opcion_6(costo_siembra, costo_mano_obra_cosecha, costo_mano_obra_picado, costo_transporte, notas, enc_id) VALUES('".$params['csiembra']."', '".$params['costo_cosecha_mano_obra']."', '".$params['costo_picar_mano_obra']."', '".$params['costo_transporte']."', '".$params['notas']."', '".$params['enc_id']."') RETURNING id";
$response_op6=$data->query($sql_op6, array(), array(), true);

if ($response_op6['insertId'] > 0) {
	$sql_update="UPDATE proyectos_enc SET opcion='6' WHERE id_proyecto=:enc_id";
	$params_update=array("enc_id");
	$response_update=$data->query($sql_update, $params, $params_update, true);
}

foreach ($_SESSION['detalle_cosecha'] as $detalle) {
	$kg_forraje=convertir('ton',filter_var($params['testimadas'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
	$sql_op6lns="INSERT INTO opcion_6_lns(cod_silo, tonenaladas_silo, descripcion, enc_id) VALUES('".$detalle['csilo']."', '".$detalle['tsilo']."', '".$detalle['descripcion']."', '".$params['enc_id']."') RETURNING id";
	$response_op6lns=$data->query($sql_op6lns, array(), array(), true);
	$sql_productos="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total) VALUES('".$detalle['csilo']."', 'silo', 'kg', '".$params['costo_promedio']."', 'silos', 'Paso Firme', '".$kg_forraje."') RETURNING id";
	$response_productos=$data->query($sql_productos, array(), array(), true);
	$sql_existencias="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$detalle['csilo']."', '".$params['bodega']."', '".$kg_forraje."') RETURNING id";
	$response_existencias=$data->query($sql_existencias, array(), array(), true);
	$sql_kardex="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$detalle['csilo']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio']."', '".$kg_forraje."') RETURNING id";
	$response_kardex=$data->query($sql_kardex, array(), array(), true);
}

if ($response_kardex['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Datos guardados correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

unset($_SESSION['detalle_cosecha']);
echo json_encode($response);
?>