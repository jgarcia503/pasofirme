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
$params=$_POST;

$params['costo_proyecto']=filter_var($params['csiembra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_tapizca']=filter_var($params['ctapizca'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_desgranado']=filter_var($params['cdesgranado'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['precio_vta']=filter_var($params['pventa'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_moler_1']=filter_var($params['cmoler1'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_moler_2']=filter_var($params['cmoler2'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_moler_3']=filter_var($params['cmoler3'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_envasar_1']=filter_var($params['cenvasar1'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_envasar_2']=filter_var($params['cenvasar2'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_envasar_3']=filter_var($params['cenvasar3'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

$params['costo_proyecto_1']=$params['costo_proyecto'];
$params['costo_proyecto']=$params['costo_proyecto']+$params['costo_tapizca']+$params['costo_desgranado'];

if ($params['venta'] == 'si') {
	$params['reclamo_costo']=$params['costo_proyecto_1']-($params['precio_vta']*($params['rcosto']/100));
	$params['costo_proyecto']=$params['costo_proyecto']-$params['precio_vta'];
}else{
	$params['costo_proyecto']=$params['costo_proyecto']+$params['costo_moler_1']+$params['costo_envasar_1'];
	$params['reclamo_costo']=0;
}

$params['costo_tuza_olote']=$params['cvtuza_olote']+$params['costo_moler_2']+$params['costo_envasar_2'];
$params['costo_rastrojo']=$params['cvrastrojo']+$params['costo_moler_3']+$params['costo_envasar_3'];

$params['codigo1']=($params['venta']=='si')?'':$params['enc_id'].'-1';
$params['codigo2']=$params['enc_id'].'-2';
$params['codigo3']=$params['enc_id'].'-3';
$params['es_venta']=($params['venta']=='si')?'si':'no';
$params['precio_venta']=($params['venta']=='si')?$params['precio_vta']:'';

$sql_op5="INSERT INTO opcion_5(costo_tapizca, costo_desgranado, ton_maiz_con_grano, ton_tuza_olote, ton_rastrojo, cod_tuza_olote, cod_rastrojo, cod_maiz, costo_tuza_olote, costo_rastrojo, es_venta, precio_vta, notas, enc_id, reclamo_costo) VALUES('".$params['costo_tapizca']."', '".$params['costo_desgranado']."', '".$params['tmaiz']."', '".$params['ttuza_olote']."', '".$params['trastrojo']."', '".$params['codigo2']."', '".$params['codigo3']."', '".$params['codigo1']."', '".$params['costo_tuza_olote']."', '".$params['costo_rastrojo']."', '".$params['es_venta']."', '".$params['precio_venta']."', '".$params['notas']."', '".$params['enc_id']."', '".$params['reclamo_costo']."') RETURNING id";
$response_op5=$data->query($sql_op5, array(), array(), true);
if ($response_op5['insertId'] > 0) {
	$sql_update="UPDATE proyectos_enc SET opcion='5' WHERE id_proyecto = :enc_id";
	$params_update=array("enc_id");
	$response_update=$data->query($sql_update, $params, $params_update, true);
}

$params['kg_prod_1']=convertir('ton',$params['tmaiz']);
$params['kg_prod_2']=convertir('ton',$params['ttuza_olote']);
$params['kg_prod_3']=convertir('ton',$params['trastrojo']);

$params['costo_promedio_1']=floatval($params['costo_proyecto'])/$params['kg_prod_1'];
$params['costo_promedio_2']=floatval($params['costo_tuza_olote'])/$params['kg_prod_2'];
$params['costo_promedio_3']=floatval($params['costo_rastrojo'])/$params['kg_prod_3'];

if ($paramas['venta']=='si') {
	$sql_pc2="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total, notas) VALUES('".$params['codigo2']."', 'tuza elote', 'kg', '".$params['costo_promedio_2']."', 'consumible', 'Paso Firme', '".$params['kg_prod_2']."', '".$params['notas']."') RETURNING id";
	$response_pc2=$data->query($sql_pc2, array(), array(), true);
	$sql_pc3="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total, notas) VALUES('".$params['codigo3']."', 'rastrojo', 'kg', '".$params['costo_promedio_3']."', 'consumible', 'Paso Firme', '".$params['kg_prod_3']."', '".$params['notas']."') RETURNING id";
	$response_pc3=$data->query($sql_pc3, array(), array(), true);
	$sql_ec2="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$params['codigo2']."', '".$params['bodega']."', '".$params['kg_prod_2']."') RETURNING id";
	$response_ec2=$data->query($sql_ec2, array(), array(), true);
	$sql_ec3="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$params['codigo3']."', '".$params['bodega']."', '".$params['kg_prod_3']."') RETURNING id";
	$response_ec3=$data->query($sql_ec3, array(), array(), true);
	$sql_kc2="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$params['codigo2']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio_2']."', '".$params['kg_prod_2']."') RETURNING id";
	$response_kc2=$data->query($sql_kc2, array(), array(), true);
	$sql_kc3="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$params['codigo3']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio_3']."', '".$params['kg_prod_3']."') RETURNING id";
	$response_kc3=$data->query($sql_kc3, array(), array(), true);
}else{
	$sql_pc1="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total, notas) VALUES('".$params['codigo1']."', 'maiz', 'kg', '".$params['costo_promedio_1']."', 'consumible', 'Paso Firme', '".$params['kg_prod_1']."', '".$params['notas']."') RETURNING id";
	$response_pc1=$data->query($sql_pc1, array(), array(), true);
	$sql_pc2="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total, notas) VALUES('".$params['codigo2']."', 'tuza elote', 'kg', '".$params['costo_promedio_2']."', 'consumible', 'Paso Firme', '".$params['kg_prod_2']."', '".$params['notas']."') RETURNING id";
	$response_pc2=$data->query($sql_pc2, array(), array(), true);
	$sql_pc3="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total, notas) VALUES('".$params['codigo3']."', 'rastrojo', 'kg', '".$params['costo_promedio_3']."', 'consumible', 'Paso Firme', '".$params['kg_prod_3']."', '".$params['notas']."') RETURNING id";
	$response_pc3=$data->query($sql_pc3, array(), array(), true);
	$sql_ec1="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$params['codigo1']."', '".$params['bodega']."', '".$params['kg_prod_1']."') RETURNING id";
	$response_ec1=$data->query($sql_ec1, array(), array(), true);
	$sql_ec2="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$params['codigo2']."', '".$params['bodega']."', '".$params['kg_prod_2']."') RETURNING id";
	$response_ec2=$data->query($sql_ec2, array(), array(), true);
	$sql_ec3="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$params['codigo3']."', '".$params['bodega']."', '".$params['kg_prod_3']."') RETURNING id";
	$response_ec3=$data->query($sql_ec3, array(), array(), true);
	$sql_kc1="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$params['codigo1']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio_1']."', '".$params['kg_prod_1']."') RETURNING id";
	$response_kc1=$data->query($sql_kc1, array(), array(), true);
	$sql_kc2="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$params['codigo2']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio_2']."', '".$params['kg_prod_2']."') RETURNING id";
	$response_kc2=$data->query($sql_kc2, array(), array(), true);
	$sql_kc3="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$params['codigo3']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio_3']."', '".$params['kg_prod_3']."') RETURNING id";
	$response_kc3=$data->query($sql_kc3, array(), array(), true);
}

if ($response_kc3['insertId'] > 0) {
	$response=array('success'=>true, 'mensaje'=>'Datos almacenados correcamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardar los datos');
}
echo json_encode($response);
?>