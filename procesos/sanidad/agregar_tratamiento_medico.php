<?php
ob_start();
session_start();
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$encontrado=false;
$_SESSION['detalle_tratamiento_medico']=isset($_SESSION['detalle_tratamiento_medico'])?$_SESSION['detalle_tratamiento_medico']:array();

if (!empty($_SESSION['detalle_tratamiento_medico'])) {
	foreach ($_SESSION['detalle_tratamiento_medico'] as $detalle) {
		if ($detalle['referencia']==$params['producto']) {
			$encontrado = true;
			break;
		}
	}
	if ($encontrado == true) {
		foreach ($_SESSION['detalle_tratamiento_medico'] as $detalle) {
			if ($detalle['referencia']==$params['producto']) {
				$detalle['cantidad']=$params['cantidad'];
				$detalle['desde']=$params['desde'];
				$detalle['hasta']=$params['hasta'];
				$detalle['vecesxdia']=$params['vecesxdia'];
			}
			$items[]=$detalle;
		}
		$_SESSION['detalle_tratamiento_medico']=$items;
		$response=array('success'=>true, 'items'=>$_SESSION['detalle_tratamiento_medico'], 'total'=>count($_SESSION['detalle_tratamiento_medico']));
	}else{
		$_SESSION['detalle_tratamiento_medico'][]=array('referencia'=>$params['producto'],'nproducto'=>$params['nproducto'],'cantidad'=>$params['cantidad'],'desde'=>$params['desde'],'hasta'=>$params['hasta'],'medida'=>$params['medida'],'vecesxdia'=>$params['vecesxdia']);
		$response=array('success'=>true, 'items'=>$_SESSION['detalle_tratamiento_medico'], 'total'=>count($_SESSION['detalle_tratamiento_medico']));
	}
}else{
	$_SESSION['detalle_tratamiento_medico'][]=array('referencia'=>$params['producto'],'nproducto'=>$params['nproducto'],'cantidad'=>$params['cantidad'],'desde'=>$params['desde'],'hasta'=>$params['hasta'],'medida'=>$params['medida'],'vecesxdia'=>$params['vecesxdia']);
	$response=array('success'=>true, 'items'=>$_SESSION['detalle_tratamiento_medico'], 'total'=>count($_SESSION['detalle_tratamiento_medico']));
}

echo json_encode($response);
?>