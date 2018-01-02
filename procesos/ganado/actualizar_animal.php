<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$ruta="../../upload/ganado/";

$sql_imagen="SELECT fotos FROM animales WHERE id = :id_animal";
$params_imagen=array("id_animal");
$response_imagen=$data->query($sql_imagen, $params, $params_imagen);
unlink("../../upload/ganado/".$response_imagen['items'][0]['fotos']);

$params['foto'] = strtolower($_FILES['ganado']["name"]);
$tmp_name = $_FILES['ganado']['tmp_name'];
$envio = $data->upload($params['foto'], $tmp_name, $ruta);
if ($envio['success'] == true) {
	$sql_uanimales="UPDATE animales SET numero=:arete, nombre=:nombre, sexo=:sexo, estado=:estado, fecha_nacimiento=:fnacimiento, fecha_deteste=:fdestete, peso_nacimiento=:pnacimiento, peso_deteste=:pesodestete, raza=:raza, color=:color, marca_oreja=:aretemag, marca_hierro=:marca_hierro, tipo=:tipo, procedencia=:procedencia, precio_venta=:pcompra, parto=:parto, concepcion=:concepcion, padre=:padre, madre=:madre, donadora=:donadora, estado_cachos=:estado_cachos, temperamento=:temperamento, estructura=:ccorporal, aplomos_corvejon=:acorvejon, aplomos_cuartillas=:acuartillas, fotos=:foto, notas=trim(:notas), cc=:ccontable, grupo=:grupo, grupa_ancho=:gancho, grupa_angulo=:gangulo WHERE id = :id_animal";
	$params_uanimales=array("arete", "nombre", "sexo", "estado", "fnacimiento", "fdestete", "pnacimiento", "pesodestete", "raza", "color", "aretemag", "marca_hierro", "tipo", "procedencia", "pcompra", "parto", "concepcion", "padre", "madre", "donadora", "estado_cachos", "temperamento", "ccorporal", "acorvejon", "acuartillas", "foto", "notas", "ccontable", "grupo", "gancho", "gangulo", "id_animal");
	$response_uanimales=$data->query($sql_uanimales, $params, $params_uanimales, true);
	$sql_bpanimales="UPDATE bit_peso_animal SET numero=replace(numero, :num_ant, :arete), nombre=replace(nombre, :nom_ant, :nombre)";
	$params_bpanimales=array("num_ant", "arete", "nom_ant", "nombre");
	$response_bpanimales=$data->query($sql_bpanimales, $params, $params_bpanimales, true);

	if ($response_uanimales['total']>0 AND $response_bpanimales['total']>0) {
		$response=array('success'=>true, 'mensaje'=>'Información del animal actualizada correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar actualizar la información');
	}
}else{
	$sql_uanimales="UPDATE animales SET numero=:arete, nombre=:nombre, sexo=:sexo, estado=:estado, fecha_nacimiento=:fnacimiento, fecha_deteste=:fdestete, peso_nacimiento=:pnacimiento, peso_deteste=:pesodestete, raza=:raza, color=:color, marca_oreja=:aretemag, marca_hierro=:marca_hierro, tipo=:tipo, procedencia=:procedencia, precio_venta=:pcompra, parto=:parto, concepcion=:concepcion, padre=:padre, madre=:madre, donadora=:donadora, estado_cachos=:estado_cachos, temperamento=:temperamento, estructura=:ccorporal, aplomos_corvejon=:acorvejon, aplomos_cuartillas=:acuartillas, notas=trim(:notas), cc=:ccontable, grupo=:grupo, grupa_ancho=:gancho, grupa_angulo=:gangulo WHERE id = :id_animal";
	$params_uanimales=array("arete", "nombre", "sexo", "estado", "fnacimiento", "fdestete", "pnacimiento", "pesodestete", "raza", "color", "aretemag", "marca_hierro", "tipo", "procedencia", "pcompra", "parto", "concepcion", "padre", "madre", "donadora", "estado_cachos", "temperamento", "ccorporal", "acorvejon", "acuartillas", "notas", "ccontable", "grupo", "gancho", "gangulo", "id_animal");
	$response_uanimales=$data->query($sql_uanimales, $params, $params_uanimales, true);
	$sql_bpanimales="UPDATE bit_peso_animal SET numero=replace(numero, :num_ant, :arete), nombre=replace(nombre, :nom_ant, :nombre)";
	$params_bpanimales=array("num_ant", "arete", "nom_ant", "nombre");
	$response_bpanimales=$data->query($sql_bpanimales, $params, $params_bpanimales, true);

	if ($response_uanimales['total']>0 AND $response_bpanimales['total']>0) {
		$response=array('success'=>true, 'mensaje'=>'Información del animal actualizada correctamente');
	}else{
		$response=array('success'=>false, 'mensaje'=>'Error al intentar actualizar la información');
	}
}

echo json_encode($response);
?>