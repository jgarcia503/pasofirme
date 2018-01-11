<?php
@session_start();
include("../sql/class.data.php");
require_once("../reportes/dompdf/dompdf_config.inc.php");
$params = $_POST;
$dompdf = new DOMPDF();
$html='<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>[titulo]</title><meta name="Description" content="[descripcion]" /><meta name="Author" content="[autor]" /></head><body style="border:0px green solid;margin:1mm 0em 3em 0em; font-family: Arial, Helvetica, sans-serif; text-align: justify; font-size: 9pt; line-height: 150%;">[header]<br><br><br><br><br><hr style="border-top: 2px solid #2E9AFE; border-bottom: 2px solid #2E9AFE; border-left:none; border-right:none; height: 6px; width: 100%;"><br>[style_css][contenido] </body></html>';
$elementos=array(
    array('nombre' => '[header]', 'valor' => header_page()),
    array('nombre' => '[style_css]', 'valor' => style_css())
);

array_push($elementos, array('nombre' => '[contenido]', 'valor' => contenido_analisis_leche()));

foreach($elementos as $elemento){
    $html=str_replace($elemento['nombre'], $elemento['valor'], $html);
}
$dompdf->load_html($html);
$dompdf->set_paper("letter", "portrait");
$dompdf->render();
if (file_put_contents("../reportes/pdfs/file".$_SESSION["tipo"].".pdf", $dompdf->output())){
  $response=array('success'=>true, 'link'=>"<iframe src='reportes/pdfs/file".$_SESSION["tipo"].".pdf?random=".md5(date('d-m-Y H:i:s'))."' style='width:100%;min-height:100%;'></iframe>", 'url'=>"reportes/pdfs/file".$_SESSION["tipo"].".pdf?random=".md5(date('d-m-Y H:i:s'))."");
} else {
  $response=array('success'=>false, 'error'=>'No se pudo generar el PDF');
}
echo json_encode($response);
/*---------------------------------------------FUNCIONES PARA LLENAR REPORTE-----------------------------------------------------------------------------*/
function header_page(){
    $html="
        <header style='height:25mm;border:0px green solid;'>
            <div style='float:left;width:100%;height:25mm;position:absolute;display:inline;border:0px red solid;text-align:center;font-weight:bold;margin-left:0;'>
                <h3>
                  PASO FIRME, S.A de C.V.
                </h3>
                <p>
                    Calle a Santa Ana, Km. 80,
                    <br>
                    Ct&oacute;n Cujucuyo, Texistepeque
                    <br>
                    Santa Ana
                    <br>
                    <br>
                    CRIA Y ENGORDE DE GANADO BOVINO
                    <br>
                    ELABORACION DE ALIMENTOS
                    <br>
                    PREPARADOS PARA ANIMALES
                </p>
            </div>
            <div style='position:absolute;display:inline;margin-right:90%;float:right;width:10%;height:25;border:0px blue solid;'>
              <center>
              <img src='../img/pie3.png' style='height:45mm;width:25mm;margin-top:2mm; '>
              </center>
            </div>
        </header>
    ";   
    $html=str_replace("[usuario]", $_SESSION["usuario"], $html);  
    return $html;
}
//----------------------------------------------------- En caso que el estado sea pendiente se mandaran a llamar estas funciones -------------------------------------------------//
function contenido_analisis_leche(){
    $data = new data();
    $params = $_POST;
    $sql = "with total AS(SELECT grasa_valor::float+proteina_valor::float+rcs_x_1000::float+reductasa_valor::float+temperatura_valor::float+agua_valor::float+((SELECT precio_leche::float FROM configuraciones)*cantidad_botellas::integer) total,cantidad_botellas::integer FROM analisis_leche WHERE id=:id) SELECT *, total/cantidad_botellas::float unitario FROM total";
    $param_list=array("id");
    $response = $data->query($sql, $params, $param_list);
    $iva=$response['items'][0]['total']*0.13;
    $subtotal=$iva+$response['items'][0]['total'];
    $percepcion=$subtotal*0.01;
    $asileche=5.00;
    $total=$subtotal+$iva-$asileche-$percepcion;
    $html='
        <table class="table2">
            <tbody>
                <tr>
                    <td>
                        <p>&nbsp;</p>
                        <p>CLIENTE:______________________________________________________________</p>
                        <p>______________________________________________________________________</p>
                        <p>DIRECCION:___________________________________________________________</p>
                        <p>MUNICIPIO:____________________________________________________________</p>
                        <p>DEPARTAMENTO:______________________________________________________</p>
                        <p>NUMERO DE NOTA DE REM. ANTERIOR:___________________________________</p>
                    </td>
                    <td>&nbsp;
                        <p>FECHA:____________________________________________________________</p>
                        <p>REGISTRO No.:_____________________________________________________</p>
                        <p>GIRO:_____________________________________________________________</p>
                        <p>NIT.:______________________________________________________________</p>
                        <p>CONDICIONES DE PAGO:____________________________________________</p>
                        <p>FECHA DE NOTA DE REM. ANTERIOR:_________________________________</p>
                        <p>VENTA A CUENTA DE:_______________________________________________</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="normal">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Articulo</th>
                <th>Precio Unitario</th>
                <th>Venta no sujetas</th>
                <th>Venta Exentas</th>
                <th>Venta Gravadas</th>
            </tr>
        </thead>
        <tbody>
            [registros]
        </tbody>
        </table>
        <table class="normal">
            <tbody>
                <tr>
                    <td>Sumas</td>
                    <td>'.$response['items'][0]['total'].'</td>
                </tr>
                <tr>
                    <td>13% de IVA</td>
                    <td>'.number_format($iva, 2).'</td>
                </tr>
                <tr>
                    <td>Sub-total</td>
                    <td>'.number_format($subtotal, 2).'</td>
                </tr>
                <tr>
                    <td>(-) IVA Retenido</td>
                    <td>'.number_format($percepcion, 2).'</td>
                </tr>
                <tr>
                    <td>Asileche</td>
                    <td>'.number_format($asileche, 2).'</td>
                </tr>
                <tr>
                    <td>Venta total</td>
                    <td>'.number_format($total, 2).'</td>
                </tr>
            </tbody>
        </table>
    ';
    $html=str_replace("[registros]", datos_analisis_leche(), $html);
    return $html;
}
function datos_analisis_leche(){
    $data = new data();
    $params = $_POST;
    $html = '';
    $sql = "with total AS(SELECT grasa_valor::float+proteina_valor::float+rcs_x_1000::float+reductasa_valor::float+temperatura_valor::float+agua_valor::float+((SELECT precio_leche::float FROM configuraciones)*cantidad_botellas::integer) total,cantidad_botellas::integer FROM analisis_leche WHERE id=:id) SELECT *, total/cantidad_botellas::float unitario FROM total";
    $param_list=array("id");
    $response = $data->query($sql, $params, $param_list);
    if ($response["total"] > 0) {
        foreach ($response["items"] as $datos) {
            $html.='
                <tr>
                    <td>'.$datos["cantidad_botellas"].'</td>
                    <td>Botellas leche</td>
                    <td>'.number_format($datos['unitario'], 4).'</td>
                    <td>-</td>
                    <td>-</td>
                    <td>'.$datos['total'].'</td>
                </tr>
            ';
        }
    }
    return $html;
}
//----------------------------------------------------------------------- Estilos y pie de paginas -----------------------------------------------------------------------//
function style_css(){
    $html='
        <style type="text/css">
         .normal { 
            border: 1px solid #000; 
            border-radius: 20px; 
            border-collapse: collapse; 
            width:100%; font-family: Arial, sans-serif; 
            font-size:8pt; 
            text-aling:center;
         } 
         .normal tr, .normal td, .normal th { 
            border: 1px solid #000; 
            text-aling:center;
         }
         .table2 {
            width:100%;
            font-family: Arial, sans-serif; 
            font-size:7pt;
         }
        </style>
    ';
    return $html;
}
?>