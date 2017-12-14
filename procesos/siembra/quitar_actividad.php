<?php
ob_start();
session_start();
$items=array();
//print_r($_SESSION['detalle_actividad']);
if (count($_SESSION['detalle_actividad'])>1) {
	foreach ($_SESSION['detalle_actividad'] as $detalle) {
		if ($detalle['actividad']!=$_POST['actividad'] AND $detalle['tipo']!=$_POST['tipo']) {
			$items[]=$detalle;
		}
		if ($detalle['actividad']!=$_POST['actividad'] AND $detalle['tipo']==$_POST['tipo']) {
			$items[]=$detalle;
		}
		if ($detalle['actividad']==$_POST['actividad'] AND $detalle['tipo']!=$_POST['tipo']) {
			$items[]=$detalle;
		}
	}
}else{
	$_SESSION['detalle_actividad']=$items;
}
if (!empty($items)) {
	$_SESSION['detalle_actividad']=$items;
}
echo json_encode($_SESSION['detalle_actividad']);
?>