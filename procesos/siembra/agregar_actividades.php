<?php
ob_start();
session_start();
$items=array();
$encontrado = false;
$_SESSION['detalle_actividad']= isset($_SESSION['detalle_actividad']) ? $_SESSION['detalle_actividad'] : array();

if (!empty($_SESSION['detalle_actividad'])) {
	foreach ($_SESSION['detalle_actividad'] as $detalle) {
		if ($detalle['actividad'] == $_POST['actividad'] AND $detalle['tipo'] == $_POST['tipo']) {
			$encontrado = true;
			break;
		}
	}
	if ($encontrado == true) {
		foreach ($_SESSION['detalle_actividad'] as $detalle) {
			if ($detalle['actividad'] == $_POST['actividad'] AND $_POST['tipo'] == 'material') {
				$detalle['producto'] = $_POST['producto'];
				$detalle['unidad'] = $_POST['unidad'];
				$detalle['dias_cant'] = $_POST['dias_cant'];
				$detalle['subtotal'] = $_POST['subtotal'];
			}elseif ($detalle['actividad'] == $_POST['actividad'] AND $_POST['tipo'] == 'mano de obra') {
				$detalle['costo'] = $_POST['costo'];
				$detalle['dias_cant'] = $_POST['dias_cant'];
				$detalle['subtotal'] = $_POST['subtotal'];
			}elseif ($detalle['actividad'] == $_POST['actividad'] AND $_POST['tipo'] == 'deterioro activo') {
				$detalle['activo'] = $_POST['activo'];
				$detalle['horas_uso'] = $_POST['horas_uso'];
				$detalle['subtotal'] = $_POST['subtotal'];
			}
			$items[]=$detalle;
		}
		$_SESSION['detalle_actividad']=$items;
	} else {
		if ($_POST['tipo'] == 'material') {
			$_SESSION['detalle_actividad'][]=array('fecha'=>$_POST['fecha'], 'actividad'=>$_POST['actividad'], 'tipo'=>$_POST['tipo'],'costo'=>'-', 'activo'=>'-', 'producto'=>$_POST['producto'], 'unidad'=>$_POST['unidad'], 'dias_cant'=>$_POST['dias_cant'], 'horas_uso'=>'-','subtotal'=>$_POST['subtotal']);
		}elseif ($_POST['tipo'] == 'mano de obra') {
			$_SESSION['detalle_actividad'][]=array('fecha'=>$_POST['fecha'], 'actividad'=>$_POST['actividad'], 'tipo'=>$_POST['tipo'],'costo'=>$_POST['costo'], 'activo'=>'-', 'producto'=>'-', 'unidad'=>'-', 'dias_cant'=>''.$_POST['dias_cant'].'', 'horas_uso'=>'-','subtotal'=>$_POST['subtotal']);
		}elseif ($_POST['tipo'] == 'deterioro activo') {
			$_SESSION['detalle_actividad'][]=array('fecha'=>$_POST['fecha'], 'actividad'=>$_POST['actividad'], 'tipo'=>$_POST['tipo'],'costo'=>'-', 'activo'=>$_POST['activo'], 'producto'=>'-', 'unidad'=>'-', 'dias_cant'=>'-', 'horas_uso'=>''.$_POST['horas_uso'].'','subtotal'=>$_POST['subtotal']);
		}
	}
} else {
	if ($_POST['tipo'] == 'material') {
		$_SESSION['detalle_actividad'][]=array('fecha'=>$_POST['fecha'], 'actividad'=>$_POST['actividad'], 'tipo'=>$_POST['tipo'],'costo'=>'-', 'activo'=>'-', 'producto'=>$_POST['producto'], 'unidad'=>$_POST['unidad'], 'dias_cant'=>$_POST['dias_cant'], 'horas_uso'=>'-','subtotal'=>$_POST['subtotal']);
	}elseif ($_POST['tipo'] == 'mano de obra') {
		$_SESSION['detalle_actividad'][]=array('fecha'=>$_POST['fecha'], 'actividad'=>$_POST['actividad'], 'tipo'=>$_POST['tipo'],'costo'=>$_POST['costo'], 'activo'=>'-', 'producto'=>'-', 'unidad'=>'-', 'dias_cant'=>''.$_POST['dias_cant'].'', 'horas_uso'=>'-','subtotal'=>$_POST['subtotal']);
	}elseif ($_POST['tipo'] == 'deterioro activo') {
		$_SESSION['detalle_actividad'][]=array('fecha'=>$_POST['fecha'], 'actividad'=>$_POST['actividad'], 'tipo'=>$_POST['tipo'],'costo'=>'-', 'activo'=>$_POST['activo'], 'producto'=>'-', 'unidad'=>'-', 'dias_cant'=>'-', 'horas_uso'=>''.$_POST['horas_uso'].'','subtotal'=>$_POST['subtotal']);
	}
}
//print_r($_SESSION['detalle_actividad']);
echo json_encode($_SESSION['detalle_actividad']);
?>