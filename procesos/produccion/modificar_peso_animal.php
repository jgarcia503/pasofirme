<?php
ob_start();
session_start();
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql = "SELECT id, regexp_split_to_table(rtrim(numero,','),',') num_animal, regexp_split_to_table(rtrim(nombre,','),',') animal, regexp_split_to_table(rtrim(peso,','),',') peso FROM bit_peso_animal WHERE id = :id_panimal";
$parametros = array("id_panimal");
$respuesta = $data->query($sql, $params, $parametros);
foreach ($respuesta['items'] as $consulta) {
    $encontrado = false;
    foreach ($_SESSION['peso_animal']['items'] as $detalle) {
        if ($consulta['num_animal'] == $detalle["num_animal"]) {
            $encontrado = true;
            break;
        }
    }
    if ($encontrado == true) {
    	$params['numanimal_detalle']='';
		$params['nanimal_detalle']='';
		$params['panimal_detalle']='';
		foreach ($_SESSION['peso_animal']['items'] as $detalle_animal) {
			$params['numanimal_detalle'].=explode('=', $detalle_animal['num_animal'])[0].',';
			$params['nanimal_detalle'].=explode('=', $detalle_animal['animal'])[0].',';
			$params['panimal_detalle'].=explode('=', $detalle_animal['peso'])[0].',';
		}
        $sql_update = "UPDATE bit_peso_animal SET fecha=:fecha, empleado=:empleado, numero=:numanimal_detalle, nombre=:nanimal_detalle, peso=:panimal_detalle, notas=:notas WHERE id=:id_panimal";
        $params_update = array("fecha"=>$params['fecha'], "empleado"=>$params['empleado'], "numanimal_detalle"=>$params['numanimal_detalle'], "nanimal_detalle"=>$params['nanimal_detalle'], "panimal_detalle"=>$params['panimal_detalle'], "notas"=>$params['notas'], "id_panimal"=>$params['id_panimal']);
        $response_update = $data->query($sql_update, $params_update, array(), true);
    }
}
if ($response_update['success'] == true OR $response_update['total'] > 0) {
    $response = array('success'=>true, 'mensaje'=>"Datos actualizados correctamente");
} else {
    $response = array('success'=>false, 'mensaje'=>"Error en la operación");
}
echo json_encode($response);
?>