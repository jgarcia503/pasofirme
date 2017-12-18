<?php
ob_start();
session_start();
include("../../sql/class.data.php");
$data = new data();
$encontrado=false;
$_SESSION['detalle_cosecha']= isset($_SESSION['detalle_cosecha']) ? $_SESSION['detalle_cosecha'] : array();

//Validamos que el codigo del producto no se repita
$consulta = $data->query("SELECT count(referencia) FROM productos WHERE referencia = :silo", $_POST, array("silo"));

if ($consulta['items'][0]['count']>0) {
	$response=array('success'=>false, 'mensaje'=>'Codigo ya existe');
}else{
	if (!empty($_SESSION['detalle_cosecha'])) {
		foreach ($_SESSION['detalle_cosecha'] as $detalle) {
			if ($detalle['csilo']==$_POST['silo']) {
				$encontrado=true;
				break;
			}
		}
		if ($encontrado==true) {
			$response=array('success'=>false, 'mensaje'=>'Codigo fue ingresado');
		}else{
			$_SESSION['detalle_cosecha'][]=array('csilo'=>$_POST['silo'], 'tsilo'=>$_POST['tsilo'], 'descripcion'=>$_POST['descripcion']);
			$response=array('success'=>true, 'items'=>$_SESSION['detalle_cosecha']);
		}
	}else{
		$_SESSION['detalle_cosecha'][]=array('csilo'=>$_POST['silo'], 'tsilo'=>$_POST['tsilo'], 'descripcion'=>$_POST['descripcion']);
		$response=array('success'=>true, 'items'=>$_SESSION['detalle_cosecha']);
	}
}
echo json_encode($response);
?>