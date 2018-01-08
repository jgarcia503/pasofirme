<?php  
ob_start();
session_start();
$params = $_POST;
$nuevo=array();
foreach ($_SESSION['peso_animal']['items'] as $detalle) {
    if ($detalle['num_animal']!=$params['animal_num']) {
        array_push($nuevo, array("num_animal"=>$detalle["num_animal"], "animal"=>$detalle["animal"], "peso"=>$detalle["peso"]));
    }
}
$_SESSION['peso_animal']=array("success"=>true, "items"=>$nuevo, "total"=>count($nuevo));
echo json_encode($_SESSION['peso_animal']);
?>