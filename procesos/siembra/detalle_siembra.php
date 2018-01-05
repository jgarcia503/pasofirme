<?php
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;

$sql="SELECT pe.*, b.nombre AS nombre_bodega, t.*, tv.nombre AS nombre_vegetacion FROM proyectos_enc pe INNER JOIN bodega b ON pe.bodega_seleccionada = b.codigo INNER JOIN proyecto_tablones pt ON pt.id_proyecto=pe.id_proyecto INNER JOIN tablones t ON t.id::character varying(255) = pt.id_tablones INNER JOIN tipo_vegetacion tv ON pe.tipo_cultivo = tv.id WHERE pe.id_proyecto = :proyecto_id ORDER BY pe.cerrado ASC";
$params_sql=array("proyecto_id");
$response=$data->query($sql, $params, $params_sql);

echo json_encode($response);
?>