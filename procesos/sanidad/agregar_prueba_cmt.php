<?php
ob_start();
session_start();
include("../../sql/class.data.php");
$data = new data();
$encontrado=false;
$_SESSION['detalle_prueba_cmt']= isset($_SESSION['detalle_prueba_cmt']) ? $_SESSION['detalle_prueba_cmt'] : array();

if (!empty($_SESSION['detalle_prueba_cmt'])) {
	foreach ($_SESSION['detalle_prueba_cmt'] as $detalle) {
		if ($detalle['numero']==$_POST['numero']) {
			$encontrado=true;
			break;
		}
	}
	if ($encontrado==true) {
		foreach ($_SESSION['detalle_prueba_cmt'] as $detalle) {
			if ($detalle['numero']==$_POST['numero']) {
				$detalle['di'] = $_POST['di'];
				$detalle['dr'] = $_POST['dr'];
				$detalle['ti'] = $_POST['ti'];
				$detalle['tr'] = $_POST['tr'];
			}
			$items[]=$detalle;
		}
		$_SESSION['detalle_prueba_cmt']=$items;
		$response=array('success'=>true, 'items'=>$_SESSION['detalle_prueba_cmt']);
	}else{
		$_SESSION['detalle_prueba_cmt'][]=array('numero'=>$_POST['numero'], 'animal'=>$_POST['nombre_animal'], 'di'=>$_POST['di'], 'dr'=>$_POST['dr'], 'ti'=>$_POST['ti'], 'tr'=>$_POST['tr']);
		$response=array('success'=>true, 'items'=>$_SESSION['detalle_prueba_cmt']);
	}
}else{
	$_SESSION['detalle_prueba_cmt'][]=array('numero'=>$_POST['numero'], 'animal'=>$_POST['nombre_animal'], 'di'=>$_POST['di'], 'dr'=>$_POST['dr'], 'ti'=>$_POST['ti'], 'tr'=>$_POST['tr']);
	$response=array('success'=>true, 'items'=>$_SESSION['detalle_prueba_cmt']);
}

echo json_encode($response);
?>