<?php  
ob_start();
session_start();
$params = $_POST;
$nuevo=array();
foreach ($_SESSION['plantilla_requisicion']['items'] as $detalle) {
    if ($detalle['nombre']!=$params['nombre']) {
        array_push($nuevo, array("referencia"=>$detalle["referencia"], "nombre"=>$detalle["nombre"], "cantidad"=>$detalle["cantidad"], "unidad"=>$detalle["unidad"]));
    }
}
$_SESSION['plantilla_requisicion']=array("success"=>true, "items"=>$nuevo, "total"=>count($nuevo));
echo json_encode($_SESSION['plantilla_requisicion']);
?>