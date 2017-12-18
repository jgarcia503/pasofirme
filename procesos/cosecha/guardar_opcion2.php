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

$params['vta_total']=filter_var($params['venta'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_silo']=filter_var($params['siembra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION)-$params['vta_total'];
$params['costo_proyecto']=filter_var($params['siembra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_cosecha_mano_obra']=filter_var($params['mano_obra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_picar_mano_obra']=filter_var($params['picado'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_transporte']=filter_var($params['transporte'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_plastico']=filter_var($params['plastico'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_compactacion']=filter_var($params['compactacion'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$params['costo_insumos']=filter_var($params['insumos'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

$params['reclamo_costo']=filter_var($params['costo_proyecto']-($params['vta_total']*($params['reclamacion']/100)));
$params['costo_silo']+=($params['costo_cosecha_mano_obra']+$params['costo_picar_mano_obra']+$params['costo_transporte']+$params['costo_plastico']+$params['costo_compactacion']+$params['costo_insumos']);

$sql_op2="INSERT INTO opcion_2(venta_elote, redes_cosechadas, precio_x_red, costo_zacate, calidad_zacate, calidad_elote, costo_siembra, costo_mano_obra_cosecha, ton_forraje, costo_picado, costo_transporte, costo_plastico, costo_compactacion, costo_insumos, fecha_inicio, fecha_cierre, notas, enc_id, reclamo_costo) VALUES(:venta, :redes, :precio, :costo_silo, :zacate, :elote, :costo_proyecto, :costo_cosecha_mano_obra, :forraje, :costo_picar_mano_obra, :costo_transporte, :costo_plastico, :costo_compactacion, :costo_insumos, :finicio, :fcierre, :silos, :enc_id, :reclamo_costo) RETURNING id";
$params_op2=array("venta", "redes", "precio", "costo_silo", "zacate", "elote", "costo_proyecto", "costo_cosecha_mano_obra", "forraje", "costo_picar_mano_obra", "costo_transporte", "costo_plastico", "costo_compactacion", "costo_insumos", "finicio", "fcierre", "silos", "enc_id", "reclamo_costo");
$response_op2=$data->query($sql_op2, $params, $params_op2, true);
if ($response_op2['insertId'] > 0) {
	$sql_update="UPDATE proyectos_enc SET opcion='2' WHERE id_proyecto = :enc_id";
	$params_update=array("enc_id");
	$response_update=$data->query($sql_update, $params, $params_update, true);
}
$kg_tforraje=convertir('ton', filter_var($params['forraje'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION));
$params['costo_promedio'] = number_format(filter_var($params['costo_silo'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION)/$kg_tforraje,2);
foreach ($_SESSION['detalle_cosecha'] as $detalle) {
	$kg_forraje=convertir('ton', floatval($detalle['tsilo']));
	$sql_op2lns="INSERT INTO opcion_2_lns(cod_silo, tonenaladas_silo, descripcion, enc_id) VALUES('".$detalle['csilo']."', '".$detalle['tsilo']."', '".$detalle['descripcion']."', '".$params['enc_id']."') RETURNING id";
	$response_op2lns=$data->query($sql_op2lns, array(), array(), true);
	$sql_productos="INSERT INTO productos(referencia, nombre, unidad_standar, precio_promedio, categoria, marca, cantidad_total) VALUES('".$detalle['csilo']."', 'silo', 'kg', '".$params['costo_promedio']."', 'silos', 'Paso Firme', '".$kg_forraje."') RETURNING id";
	$response_productos=$data->query($sql_productos, array(), array(), true);
	$sql_exitencias="INSERT INTO existencias(codigo_producto, codigo_bodega, existencia) VALUES('".$detalle['csilo']."', '".$params['bodega']."', '".$kg_forraje."') RETURNING id";
	$response_existencias=$data->query($sql_exitencias, array(), array(), true);
	$sql_kardex="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, entrada) VALUES('".$params['bodega']."', '".$detalle['csilo']."', NOW(), 'proyecto', '".$params['enc_id']."', '".$params['costo_promedio']."', '".$kg_forraje."') RETURNING id";
	$response_kardex=$data->query($sql_kardex, array(), array(), true);
}

if ($response_kardex['insertId']>0) {
	$response=array('success'=>true, 'mensaje'=>'Registros almacenados correctamente');
}else{
	$response=array('success'=>false, 'mensaje'=>'Error al intentar guardos los datos');
}

unset($_SESSION['detalle_cosecha']);
echo json_encode($response);
?>