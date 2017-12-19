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

$params['costo_proyecto']=filter_var($params['grano'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_cosecha_mano_obra']=filter_var($params['mano_obra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_picar_mano_obra']=filter_var($params['picado'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_transporte']=filter_var($params['transporte'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_plastico']=filter_var($params['plastico'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_compactacion']=filter_var($params['compactacion'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_insumos']=filter_var($params['insumos'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

$params['costo_proyecto']+=($params['costo_cosecha_mano_obra']+$params['costo_picar_mano_obra']+$params['costo_transporte']+$params['costo_plastico']+$params['costo_compactacion']+$params['costo_insumos']);

$sql_op3="INSERT INTO opcion3 VALUES(default, '".$params['grano']."', '".$params['costo_cosecha_mano_obra']."', '".$params['costo_picar_mano_obra']."', '".$params['costo_transporte']."', '".$params['costo_plastico']."', '".$params['forraje']."', '".$params['costo_compactacion']."', '".$params['costo_insumos']."', '".$params['finicio']."', '".$params['fcierre']."', '".$params['notas']."', '".$params['enc_id']."') RETURNING id";
$response_op3=$data->query($sql_op3, array(), array(), true);

if ($response_op3['insertId'] > 0) {
	$sql_update="UPDATE proyectos_enc SET opcion='3' WHERE id_proyecto = :enc_id";
	$params_update=array("enc_id");
	$response_update=$data->query($sql_update, $params, $params_update, true);
}
$kg_tforraje=convertir('ton', filter_var($params['forraje'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$params['costo_promedio'] = number_format(filter_var($params['costo_proyecto'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION)/$kg_tforraje,2);

foreach ($_SESSION['detalle_cosecha'] as $detalle) {
	$kg_forraje=convertir('ton', filter_var($params['forraje'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
	$sql_op3lns="INSERT INTO opcion_3_lns VALUES(default, '".$detalle['csilo']."', '".$detalle['tsilo']."', '".$detalle['descripcion']."', '".$params['enc_id']."') RETURNING id";
	$response_op3lns=$data->query($sql_op3lns, array(), array(), true);
	$sql_productos="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total) VALUES('".$detalle['csilo']."', 'silo', 'kg', '".$params['costo_promedio']."', 'silos', 'Paso Firme', '".$kg_forraje."') RETURNING id";
	$response_productos=$data->query($sql_productos, array(), array(), true);
	$sql_exitencias="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$detalle['csilo']."', '".$params['bodega']."', '".$kg_forraje."') RETURNING id";
	$response_existencias=$data->query($sql_exitencias, array(), array(), true);
	$sql_kardex="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$detalle['csilo']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio']."', '".$kg_forraje."') RETURNING id";
	$response_kardex=$data->query($sql_kardex, array(), array(), true);
}

if ($response_kardex['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Registros almacenados correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}

unset($_SESSION['detalle_cosecha']);
echo json_encode($response);
?>