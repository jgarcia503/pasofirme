<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$ruta="../../upload/ganado/";

$params['foto'] = $_FILES['ganado']['name'];
$tmp_foto = $_FILES['ganado']['tmp_name'];
$envio = $data->upload($params['foto'], $tmp_foto, $ruta);

$sql="INSERT INTO animales(numero, nombre, sexo, estado, fecha_nacimiento, fecha_deteste, peso_nacimiento, peso_deteste, raza, color, marca_oreja, marca_hierro, tipo, procedencia, precio_venta, parto, concepcion, padre, madre, donadora, estado_cachos, temperamento, estructura, aplomos_corvejon, aplomos_cuartillas, fotos, notas, cc, grupo, grupa_ancho, grupa_angulo) VALUES(:arete, :nombre, :sexo, :estado, :fnacimiento, :fdestete, :pnacimiento, :pesodestete, :raza, :color, :aretemag, :marca_hierro, :tipo, :procedencia, :pcompra, :parto, :concepcion, :padre, :madre, :donadora, :estado_cachos, :temperamento, :ccorporal, :acorvejon, :acuartillas, :foto, trim(:notas), :ccontable, :grupo, :gancho, :gangulo) RETURNING id";
$params_sql=array("arete", "nombre", "sexo", "estado", "fnacimiento", "fdestete", "pnacimiento", "pesodestete", "raza", "color", "aretemag", "marca_hierro", "tipo", "procedencia", "pcompra", "parto", "concepcion", "padre", "madre", "donadora", "estado_cachos", "temperamento", "ccorporal", "acorvejon", "acuartillas", "foto", "notas", "ccontable", "grupo", "gancho", "gangulo");
$response_sql=$data->query($sql, $params, $params_sql, true);

if ($response_sql['insertId'] > 0) {
	$response = array('success'=>true, 'mensaje'=>'Animal ingresado correctamente');
}else{
	$response = array('success'=>false , 'mensaje'=>'Error al intentar igresar los datos');
}

echo json_encode($response);
?>