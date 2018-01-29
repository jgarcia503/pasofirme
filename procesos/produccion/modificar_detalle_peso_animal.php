
<?php
ob_start();
session_start();
include("../../sql/class.data.php");
$data = new data();
$params = $_POST;
$items  = array();
$encontrado = false;
$sql="SELECT regexp_split_to_table(rtrim(numero,','),',') num_animal, regexp_split_to_table(rtrim(nombre,','),',') animal, regexp_split_to_table(rtrim(peso,','),',') peso FROM bit_peso_animal WHERE id = :id_panimal";
$params_sql=array("id_panimal");
$respuesta=$data->query($sql, $params, $params_sql);
foreach($_SESSION['peso_animal']["items"] as $detalle){
    if($detalle['num_animal']==$_POST['num_animal']){
        $encontrado=true;
        break;
    }
}
if($encontrado==true){
    foreach($_SESSION['peso_animal']["items"] as $detalle){
        if($detalle['num_animal']==$_POST['num_animal']){
            $detalle['peso'] = $_POST['peso'];
        }
        $items[]=$detalle;
    }   
    $_SESSION['peso_animal']["items"]=$items;
    $response=array('success'=>true, 'items'=>$_SESSION['peso_animal']["items"]);
}else{
    $items=$_SESSION['peso_animal']["items"];
    if ($respuesta['total'] > 0) {
        $params["detalle"] = $respuesta['items'][0]['num_animal'];
        array_push($items, array("num_animal"=>$params["detalle"], "animal"=>$params["animal"], "peso"=>$params["peso"]));
    } else {
        array_push($items, array("num_animal"=>$params["num_animal"], "animal"=>$params["animal"], "peso"=>$params["peso"]));
    }
}
$_SESSION['peso_animal']=array("success"=>true, "items"=>$items, "total"=>count($items));
echo json_encode($_SESSION['peso_animal']);
?>