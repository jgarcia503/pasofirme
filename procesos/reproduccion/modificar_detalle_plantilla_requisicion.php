
<?php
ob_start();
session_start();
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$items  = array();
$encontrado = false;
$sql="SELECT b.nombre, a.cantidad, a.unidad FROM plantilla_servicios_requisicion_lns a JOIN productos b ON b.referencia=a.producto_id WHERE enc_id=:id_enc AND producto_id=:producto";
$params_sql=array("id_enc", "producto");
$respuesta=$data->query($sql, $params, $params_sql);
foreach($_SESSION['plantilla_requisicion']["items"] as $detalle){
    if($detalle['nombre']==$params['nombre_producto']){
        $encontrado=true;
        break;
    }
}
if($encontrado==true){
    foreach($_SESSION['plantilla_requisicion']["items"] as $detalle){
        if($detalle['nombre']==$params['nombre_producto']){
            $detalle['cantidad'] = $params['cantidad'];
            $detalle['unidad'] = $params['unidad'];
        }
        $items[]=$detalle;
    }   
    $_SESSION['plantilla_requisicion']["items"]=$items;
    $response=array('success'=>true, 'items'=>$_SESSION['plantilla_requisicion']["items"]);
}else{
    $items=$_SESSION['plantilla_requisicion']["items"];
    if ($respuesta['total'] > 0) {
        $params["detalle"] = $respuesta['items'][0]['nombre'];
        array_push($items, array("referencia"=>$params["producto"], "nombre"=>$params["detalle"], "cantidad"=>$params["cantidad"], "unidad"=>$params["unidad"]));
    } else {
        array_push($items, array("referencia"=>$params["producto"], "nombre"=>$params["nombre_producto"], "cantidad"=>$params["cantidad"], "unidad"=>$params["unidad"]));
    }
}
$_SESSION['plantilla_requisicion']=array("success"=>true, "items"=>$items, "total"=>count($items));
echo json_encode($_SESSION['plantilla_requisicion']);
?>