<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT *, (SELECT precio_leche::float FROM configuraciones) precio_base,
(((SELECT precio_leche::float FROM configuraciones)*cantidad_botellas::float)+grasa_valor::float+proteina_valor::float+rcs_x_1000::float+reductasa_valor::float+acidez_valor::float+temperatura_valor::float+agua_valor::float)/cantidad_botellas::float valor FROM analisis_leche WHERE id = :id";
$params_sql=array("id");
$response_datos=$data->query($sql, $params, $params_sql);

$response_tabla="";
foreach ($response_datos['items'] as $key_datos) {
	$response_tabla.="
		<tr>
			<td>".$key_datos['fecha']."</td>
			<td>".$key_datos['recepcion_no']."</td>
			<td>".$key_datos['cantidad_botellas']."</td>
			<td>".$key_datos['precio_base']."</td>
			<td>".$key_datos['grasa_%']."</td>
			<td>".$key_datos['grasa_valor']."</td>
			<td>".$key_datos['proteina_%']."</td>
			<td>".$key_datos['proteina_valor']."</td>
			<td>".$key_datos['rcs']."</td>
			<td>".$key_datos['rcs_x_1000']."</td>
			<td>".$key_datos['reductasa_%']."</td>
			<td>".$key_datos['reductasa_valor']."</td>
			<td>".$key_datos['acidez_%']."</td>
			<td>".$key_datos['acidez_valor']."</td>
			<td>".$key_datos['temperatura_%']."</td>
			<td>".$key_datos['temperatura_valor']."</td>
			<td>".$key_datos['agua_%']."</td>
			<td>".$key_datos['agua_valor']."</td>
			<td>".number_format($key_datos['valor'],4)."</td>
		</tr>
	";	
}

echo $response_tabla;
?>