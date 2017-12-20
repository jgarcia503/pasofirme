<?php 
$params=$_POST;
$vsiembra=filter_var($params['vsiembra'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$costo=filter_var($params['ctotal'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$ctotal=number_format($vsiembra-$costo,2);
$response=array('success'=>true, 'total'=>$ctotal);

echo json_encode($response);
?>