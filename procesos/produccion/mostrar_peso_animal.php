<?php
include("../../sql/class.data.php");
session_start();
$data = new data();
$params=$_POST;
if (!isset($_SESSION['detalle_peso_animal'])) {
    $_SESSION['detalle_peso_animal']=array();
}
$sql="SELECT regexp_split_to_table(rtrim(numero,','),',') num_animal, regexp_split_to_table(rtrim(nombre,','),',') animal, regexp_split_to_table(rtrim(peso,','),',') peso FROM bit_peso_animal WHERE id = :id_panimal";
$params_sql=array("id_panimal");
$response=$data->query($sql, $params, $params_sql);
if (isset($_SESSION['detalle_peso_animal'])){
    $rowCount=intval($response['total']);
    foreach ($_SESSION['detalle_peso_animal'] as $row) {
            $result=$data->query('select "" regexp_split_to_table(rtrim(numero,','),',') num_animal, regexp_split_to_table(rtrim(nombre,','),',') animal, regexp_split_to_table(rtrim(peso,','),',') peso from bit_peso_animal where id=:id_panimal', array('id_panimal'=>$params['id_panimal']));
            $response['items'][]=$result['items'][0];
            $rowCount++;
    }
    $response['total']=$rowCount;
}
$_SESSION["peso_animal"]=$response;
echo json_encode($response);
?>