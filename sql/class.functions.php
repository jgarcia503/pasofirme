<?php
/**
* 
*/
class kardex
{
	//constructor
    function dataTable() {
        
    }
	
	function decrease_inventario_farmacia($array, $bodega_seleccionada=NULL){
		include_once ("class.data.php");
		$data = new data();
        foreach ($array as $datos) {
        	$sql_select="SELECT precio_promedio FROM productos WHERE referencia = '".$datos['referencia']."'";
        	$response_select=$data->query($sql_select, array(), array());
        	$params['costo_promedio']=$response_select['items'][0]['precio_promedio'];
        	if ($response_select['total'] > 0) {
        		$sql_update="UPDATE productos SET cantidad_total=(cantidad_total::numeric(1000,2)-$datos[cantidad]) WHERE referencia = '".$datos['referencia']."'";
        		$response_update=$data->query($sql_update, array(), array(), true);
        		if ($response_update['total'] > 0) {
	        		$sql_update2="UPDATE existencias SET existencia=(existencia::numeric(1000,2)-$datos[cantidad]) WHERE codigo_producto = '$datos[referencia]' AND codigo_bodega = '$bodega_seleccionada'";
	        		$response_update2=$data->query($sql_update2, array(), array(), true);
	        		$sql_insert="INSERT INTO kardex VALUES(default, '".$bodega_seleccionada."', '".$datos['referencia']."', NOW(), 'requisicion-tratamiento', '".$datos['ultimo_id']."', '".$params['costo_promedio']."', '".$datos['cantidad']."')";
	        		$response_insert=$data->query($sql_insert, array(), array(), true);
	        		$response=array('success'=>'si');
        		}else{
        			$response=array('success'=>'no');
        		}
        	}
        }
        return $response;
	}

	function convertir($unidad,$cantidad){
	    #unidades estandar dentro del sistema kg y litros
	    #de peso
	    $conversiones['qq']=100;#quintal 100kg
	    $conversiones['ton']=1000;
	    $conversiones['g']=0.001;
	    $conversiones['kg']=1;
	    $conversiones['oz']=0.03;
	    $conversiones['lb']=0.45;
	    #de volumen
	    $conversiones['ml']=0.001;
	    $conversiones['lt']=1;
	    $resultado=$conversiones[$unidad]*floatval($cantidad);
	    return $resultado;    
	}
}
?>