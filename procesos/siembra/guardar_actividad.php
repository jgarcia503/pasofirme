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

$sql_bodega = "SELECT bodega_seleccionada FROM proyectos_enc WHERE id_proyecto='".$_POST['enc_id']."'";
$response_bodega = $data->query($sql_bodega, array(), array());
$params['bodega'] = $response_bodega['items'][0]['bodega_seleccionada'];

if (!empty($_SESSION['detalle_actividad'])) {
  foreach ($_SESSION['detalle_actividad'] as $detalle) {
    if ($detalle['tipo'] == 'material') {
      $sql="INSERT INTO proyectos_lns(actividad, tipo, producto, cantidad_dias, fecha, unidad, subtotal, fecha_ingreso_act, enc_id, notas) VALUES('".$detalle['actividad']."', '".$detalle['tipo']."', '".$detalle['producto']."', '".$detalle['dias_cant']."', '".$detalle['fecha']."', '".$detalle['unidad']."', '".$detalle['subtotal']."', NOW(), '".$_POST['enc_id']."', '".$_POST['nota']."') RETURNING id";
      $response_sql=$data->query($sql, array(), array(), true);
      $sql_productos="SELECT referencia FROM productos WHERE nombre = '".$detalle['producto']."'";
      $response_productos=$data->query($sql_productos, array(), array());
      if ($response_productos['total'] > 0) {
        $params['referencia'] = $response_productos['items'][0]['referencia'];
        $valor_a += convertir($detalle['unidad'], $detalle['dias_cant']);
        $sql_uproductos="UPDATE productos SET cantidad_total=(cantidad_total::numeric(1000,2)-$valor_a) WHERE referencia = '".$params['referencia']."'";
        $response_uproductos=$data->query($sql_uproductos, array(), array(), true);
        $sql_uexistencias="UPDATE existencias SET existencia = (existencia::numeric(1000,2)-$valor_a) WHERE codigo_producto = '".$params['referencia']."' AND codigo_bodega = '".$params['bodega']."'";
        $response_uexistencias=$data->query($sql_uexistencias, array(), array(), true);
      }else{
        $valor_a = convertir($detalle['unidad'], $detalle['dias_cant']);
        $sql_uproductos="UPDATE productos SET cantidad_total=(cantidad_total::numeric(1000,2)-$valor_a) WHERE referencia = '".$params['referencia']."'";
        $response_uproductos=$data->query($sql_uproductos, array(), array(), true);
        $sql_uexistencias="UPDATE existencias SET existencia = (existencia::numeric(1000,2)-$valor_a) WHERE codigo_producto = '".$params['referencia']."' AND codigo_bodega = '".$params['bodega']."'";
        $response_uexistencias=$data->query($sql_uexistencias, array(), array(), true);
      }
      $sql_rppromedio="SELECT referencia, precio_promedio FROM productos WHERE nombre = '".$detalle['producto']."'";
      $response_rppromedio=$data->query($sql_rppromedio, array(), array());
      if ($response_rppromedio['total'] > 0) {
        $salida=convertir($detalle['unidad'], $detalle['dias_cant']);
        $params['preferencia'] = $response_rppromedio['items'][0]['items'];
        $params['ppromedio'] = $response_rppromedio['items'][0]['precio_promedio'];
        $sql_kardex="INSERT INTO kardex(codigo_bodega, codigo_producto, fecha, tipo_doc, no_doc, costo, salida) 
        VALUES('".$params['bodega']."', '".$params['preferencia']."', NOW(), 'requisicion', '".$_POST['enc_id'].'-'.$response_sql['insertId']."', '".$params['ppromedio']."', '".$salida."') RETURNING id";
        $response_kardex=$data->query($sql_kardex, array(), array(), true);
      }
    }elseif ($detalle['tipo'] == 'mano de obra') {
      $sql_mobra="INSERT INTO proyectos_lns(actividad, tipo, mano_obra, cantidad_dias, fecha, subtotal, fecha_ingreso_act, enc_id, notas) 
      VALUES('".$detalle['actividad']."', '".$detalle['tipo']."', '".$detalle['costo']."', '".$detalle['dias_cant']."', '".$detalle['fecha']."', '".$detalle['subtotal']."', NOW(), '".$_POST['enc_id']."', '".$_POST['nota']."') RETURNING id";
      $response_mobra=$data->query($sql_mobra, array(), array(), true);
    }elseif ($detalle['tipo'] == 'deterioro activo') {
      $sql_dactivo="INSERT INTO proyectos_lns(actividad, tipo, fecha, subtotal, fecha_ingreso_act, enc_id, notas, activo, horas_uso_activo) VALUES('".$detalle['actividad']."', '".$detalle['tipo']."', '".$detalle['fecha']."', '".$detalle['subtotal']."', NOW(), '".$_POST['enc_id']."', '".$_POST['nota']."', '".$detalle['acitvo']."', '".$detalle['horas_uso']."')";
      $response_dactivo=$data->query($sql_dactivo, array(), array(), true);
    }
  }
  $response=array('success'=>true, 'mensaje'=>'Actividades ingresadas correctamente');
}else{
  $response=array('success'=>false, 'mensaje'=>'No hay datos en la tabla');
}
//si los datos se guardan limpiar la session y el formulario
unset($_SESSION['detalle_actividad']);
echo json_encode($response);
?>