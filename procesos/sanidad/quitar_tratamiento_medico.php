<?php
ob_start();
session_start();
$items=array();
if(count($_SESSION['detalle_tratamiento_medico'])>1){
	foreach($_SESSION['detalle_tratamiento_medico'] as $detalle){
		if($detalle['referencia']!=$_POST['referencia']){
			$items[]=$detalle;
		}
	}
}else{
	$_SESSION['detalle_tratamiento_medico']=$items;
}
if(!empty($items)){
	$_SESSION['detalle_tratamiento_medico']=$items;
}
echo json_encode($_SESSION['detalle_tratamiento_medico']);
?>