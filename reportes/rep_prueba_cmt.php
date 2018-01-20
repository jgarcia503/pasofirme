<?php
@session_start();
include("../sql/class.data.php");
require_once("../reportes/dompdf/dompdf_config.inc.php");
$params = $_POST;
$dompdf = new DOMPDF();
$html='<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>[titulo]</title><meta name="Description" content="[descripcion]" /><meta name="Author" content="[autor]" /></head><body style="border:0px green solid;margin:1mm 0em 3em 0em; font-family: Arial, Helvetica, sans-serif; text-align: justify; font-size: 9pt; line-height: 150%;">[header]<br><br><br><br><br><hr style="border-top: 2px solid #2E9AFE; border-bottom: 2px solid #2E9AFE; border-left:none; border-right:none; height: 6px; width: 100%;"><br>[style_css][contenido] <br><br> [footer] </body></html>';
$elementos=array(
    array('nombre' => '[header]', 'valor' => header_page()),
    array('nombre' => '[style_css]', 'valor' => style_css()),
    array('nombre' => '[footer]', 'valor' => footer_page())
);

array_push($elementos, array('nombre' => '[contenido]', 'valor' => contenido_analisis_leche()));

foreach($elementos as $elemento){
    $html=str_replace($elemento['nombre'], $elemento['valor'], $html);
}
$dompdf->load_html($html);
$dompdf->set_paper("letter", "portrait");
$dompdf->render();
if (file_put_contents("../reportes/pdfs/prueba_cmt".$params['id'].".pdf", $dompdf->output())){
  $response=array('success'=>true, 'link'=>"<iframe src='reportes/pdfs/prueba_cmt".$params['id'].".pdf?random=".md5(date('d-m-Y H:i:s'))."' style='width:100%;min-height:100%;'></iframe>", 'url'=>"reportes/pdfs/prueba_cmt".$params['id'].".pdf?random=".md5(date('d-m-Y H:i:s'))."");
} else {
  $response=array('success'=>false, 'error'=>'No se pudo generar el PDF');
}
echo json_encode($response);
/*---------------------------------------------FUNCIONES PARA LLENAR REPORTE-----------------------------------------------------------------------------*/
function header_page(){
    $params = $_POST;
    $html="
        <header style='height:25mm;border:0px green solid;'>
            <div style='float:left;width:100%;height:25mm;position:absolute;display:inline;border:0px red solid;text-align:center;font-weight:bold;margin-left:0;'>
                <h3>
                    <br>
                    <br>
                    <br>
                  PRUEBAS CMT FECHA <span class='break'></span><label>".$params['id']."</label>
                </h3>
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
    $html='
        <table class="normal">
        <thead>
            <tr>
                <th>N&uacute;mero</th>
                <th>Nombre</th>
                <th>DI</th>
                <th>DR</th>
                <th>TI</th>
                <th>TR</th>
            </tr>
        </thead>
        <tbody>
            [registros]
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
    $sql="SELECT a.*, b.nombre FROM pruebas_cmt a INNER JOIN animales b ON b.numero = a.animal WHERE fecha = :id";
    $params_sql=array("id");
    $response=$data->query($sql, $params, $params_sql);
    if ($response["total"] > 0) {
        foreach ($response["items"] as $datos) {
            $html.="<tr>
                <td style='text-align:center;'>".$datos['animal']."</td>
                <td style='text-align:center;'>".$datos['nombre']."</td>";
                if ($datos['ubre_1']=='3' OR $datos['ubre_1']=='c') {
                    $html.="<td style='background-color:#FF4242; text-align:center;'>".$datos['ubre_1']."</td>";
                }else{
                    $html.="<td style='text-align:center;'>".$datos['ubre_1']."</td>";
                }
                if ($datos['ubre_2']=='3' OR $datos['ubre_2']=='c') {
                    $html.="<td style='background-color:#FF4242; text-align:center;'>".$datos['ubre_2']."</td>";
                }else{
                    $html.="<td style='text-align:center;'>".$datos['ubre_2']."</td>";
                }
                if ($datos['ubre_3']=='3' OR $datos['ubre_3']=='c') {
                    $html.="<td style='background-color:#FF4242; text-align:center;'>".$datos['ubre_3']."</td>";
                }else{
                    $html.="<td style='text-align:center;'>".$datos['ubre_3']."</td>";
                }
                if ($datos['ubre_4']=='3' OR $datos['ubre_4']=='c') {
                    $html.="<td style='background-color:#FF4242; text-align:center;'>".$datos['ubre_4']."</td>";
                }else{
                    $html.="<td style='text-align:center;'>".$datos['ubre_4']."</td>";
                }
            $html.="</tr>";
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
            font-size:9pt; 
            text-aling:center;
         } 
         .normal tr, .normal td, .normal th { 
            border: 1px solid #000; 
            text-aling:center;
         }
        </style>
    ';
    return $html;
}

function footer_page(){
    $html="
        <script type=\"text/php\"> 
          if ( isset(\$pdf) ) { 
            @\$pdf->page_text(250,760,\"" . "Impreso el " . date('d-m-Y') . " a las " . date('h:i:s') . "\", Font_Metrics::get_font(\"helvetica\"), 8, array(0,0,0));
          } 
        </script>
    ";
  return $html;
}
?>