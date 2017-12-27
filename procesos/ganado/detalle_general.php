<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT '|' sep, numero, nombre, sexo, estado, fecha_nacimiento, fecha_deteste fecha_destete, peso_nacimiento, peso_deteste peso_destete, raza, color, marca_oreja, marca_hierro, tipo, procedencia, precio_venta, (SELECT nombre FROM grupos WHERE id::text=grupo) grupo, '|' sep1, parto, concepcion, padre, madre, abuelo_materno, abuelo_paterno, abuela_materna, abuela_paterna, '|' sep2, donadora, estado_cachos, temperamento, estructura, aplomos_corvejon, aplomos_cascos, grupa_ancho, grupa_angulo, to_char(current_date,'DD MM YYYY')::date - (SELECT fecha FROM partos WHERE animal=numero||'-'||nombre ORDER BY fecha::date desc limit 1)::date dias_lactancia, COALESCE(fotos,'no_disponible.png') fotos FROM animales WHERE id = :id_animal";
$params_sql=array("id_animal");
$response=$data->query($sql, $params, $params_sql);

$foto=$response['items'][0]['fotos'];

$plantilla='<input class="form-control" type="text" value="{}" readonly>';
$datos='';
unset($response['items'][0]['fotos']);
$campos_fila=0;
foreach ($response['items'] as $key => $value) {
	foreach ($value as $key => $valor) {
		if ($valor=='|') {
			$datos.=$valor;
			continue;
		}
		if ($campos_fila==0) {
			$datos.="<div class='row'>";
		}
		$datos.="<div class='col-md-3'>";
		$key=ucwords(preg_replace('/_/', ' ', $key));
		if ($valor==null) {
			$datos.="$key ".preg_replace('/{}/', '', $plantilla);
		}else{
			$datos.="$key ".preg_replace('/{}/', $valor, $plantilla);
		}
		$datos.="</div>";
		$campos_fila+=3;
		if ($campos_fila==12) {
			$campos_fila=0;
			$datos.="</div>";
		}
	}
}

echo "$foto";
echo $datos;
?>