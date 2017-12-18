<?php
ob_start();
session_start();
$items=array();
if(count($_SESSION['detalle_cosecha'])>1){
	foreach($_SESSION['detalle_cosecha'] as $detalle){
		if($detalle['csilo']!=$_POST['codigo']){
			$items[]=$detalle;
		}
	}
}else{
	$_SESSION['detalle_cosecha']=$items;
}
if(!empty($items)){
	$_SESSION['detalle_cosecha']=$items;
}
echo json_encode($_SESSION['detalle_cosecha']);
?>