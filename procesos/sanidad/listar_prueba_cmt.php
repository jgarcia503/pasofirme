<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT a.*, b.nombre FROM pruebas_cmt a INNER JOIN animales b ON b.numero = a.animal WHERE fecha = :id";
$params_sql=array("id");
$response_sql=$data->query($sql, $params, $params_sql);
$html="";
foreach ($response_sql['items'] as $detalle) {
	$html.="<tr>
		<td>".$detalle['animal']."</td>
		<td>".$detalle['nombre']."</td>";
		if ($detalle['ubre_1']=='3' OR $detalle['ubre_1']=='c') {
			$html.="<td style='background-color:#FF4242; text-align:center;'>".$detalle['ubre_1']."</td>";
		}else{
			$html.="<td style='text-align:center;'>".$detalle['ubre_1']."</td>";
		}
		if ($detalle['ubre_2']=='3' OR $detalle['ubre_2']=='c') {
			$html.="<td style='background-color:#FF4242; text-align:center;'>".$detalle['ubre_2']."</td>";
		}else{
			$html.="<td style='text-align:center;'>".$detalle['ubre_2']."</td>";
		}
		if ($detalle['ubre_3']=='3' OR $detalle['ubre_3']=='c') {
			$html.="<td style='background-color:#FF4242; text-align:center;'>".$detalle['ubre_3']."</td>";
		}else{
			$html.="<td style='text-align:center;'>".$detalle['ubre_3']."</td>";
		}
		if ($detalle['ubre_4']=='3' OR $detalle['ubre_4']=='c') {
			$html.="<td style='background-color:#FF4242; text-align:center;'>".$detalle['ubre_4']."</td>";
		}else{
			$html.="<td style='text-align:center;'>".$detalle['ubre_4']."</td>";
		}
	$html.="</tr>";
}

echo $html;
?>