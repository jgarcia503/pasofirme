<?php
ob_start();
session_start();
$items=array();
if(count($_SESSION['detalle_prueba_cmt'])>1){
	foreach($_SESSION['detalle_prueba_cmt'] as $detalle){
		if($detalle['numero']!=$_POST['numero']){
			$items[]=$detalle;
		}
	}
}else{
	$_SESSION['detalle_prueba_cmt']=$items;
}
if(!empty($items)){
	$_SESSION['detalle_prueba_cmt']=$items;
}
echo json_encode($_SESSION['detalle_prueba_cmt']);
?>