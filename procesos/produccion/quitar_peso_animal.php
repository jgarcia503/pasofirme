<?php
ob_start();
session_start();
$items=array();
if(count($_SESSION['detalle_peso_animal'])>1){
	foreach($_SESSION['detalle_peso_animal'] as $detalle){
		if($detalle['num_animal']!=$_POST['animal_num']){
			$items[]=$detalle;
		}
	}
}else{
	$_SESSION['detalle_peso_animal']=$items;
}
if(!empty($items)){
	$_SESSION['detalle_peso_animal']=$items;
}
echo json_encode($_SESSION['detalle_peso_animal']);
?>