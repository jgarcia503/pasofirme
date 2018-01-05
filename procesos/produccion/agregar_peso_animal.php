<?php
ob_start();
session_start();
$encontrado=false;
$_SESSION['detalle_peso_animal']= isset($_SESSION['detalle_peso_animal']) ? $_SESSION['detalle_peso_animal'] : array();

if (!empty($_SESSION['detalle_peso_animal'])) {
	foreach ($_SESSION['detalle_peso_animal'] as $detalle) {
		if ($detalle['num_animal']==$_POST['num_animal']) {
			$encontrado=true;
			break;
		}
	}
	if ($encontrado==true) {
		foreach ($_SESSION['detalle_peso_animal'] as $detalle) {
			if ($detalle['num_animal']==$_POST['num_animal']) {
				$detalle['peso'] = $_POST['peso'];
			}
			$items[]=$detalle;
		}
		$_SESSION['detalle_peso_animal']=$items;
		$response=array('success'=>true, 'items'=>$_SESSION['detalle_peso_animal']);
	}else{
		$_SESSION['detalle_peso_animal'][]=array('num_animal'=>$_POST['num_animal'], 'animal'=>$_POST['animal'], 'peso'=>$_POST['peso']);
		$response=array('success'=>true, 'items'=>$_SESSION['detalle_peso_animal']);
	}
}else{
	$_SESSION['detalle_peso_animal'][]=array('num_animal'=>$_POST['num_animal'], 'animal'=>$_POST['animal'], 'peso'=>$_POST['peso']);
	$response=array('success'=>true, 'items'=>$_SESSION['detalle_peso_animal']);
}
echo json_encode($response);
?>