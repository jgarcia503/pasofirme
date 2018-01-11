<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-tasks"></i>&nbsp;An&aacute;lisis de leche
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-tasks"></i>&nbsp;An&aacute;lisis de leche</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=canalisis_leche" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar an&aacute;lisis de leche</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tabla_analisis_leche" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Fecha
                    </center></th>
                    <th><center>
                      Botellas
                    </center></th>
                    <th><center>
                      Recepci&oacute;n No.
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_analisis_leche();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['cantidad_botellas'] ?></td>
                    <td><?php echo $datos['recepcion_no'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle peso de analisis de leche" data-toggle="modal" data-target="#repo_analisis_leche" onclick="detalle_analisis('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
                      <label class="btn btn-primary" title="Reporte de analisis de leche" onclick="ver_pdf('<?php echo $datos['id']?>')"><i class="fa white fa-file-pdf-o"></i></label>
                    </center></td>
                  </tr>
                <?php } ?>
               </tbody>
            </table>
         </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="factura_venta" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Factura</h4>
      </div>
      <div class="modal-body">
        <div id="pdfanalisis" style="height: 670px;"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Ventana modal para crear raza -->
<div class="modal fade" id="repo_analisis_leche" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">An&aacute;lisis de leche</h4>
      </div>
      <div class="modal-body">
        <table role="grid" id="tabla_aleche" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
           <thead>
              <tr class="bg bg-navy">
                <th rowspan="2"><center>
                  Fecha
                </center></th>
                <th rowspan="2"><center>
                  Recep No
                </center></th>
                <th rowspan="2"><center>
                  Cantidad.
                </center></th>
                <th rowspan="2"><center>
                  Precio original
                </center></th>
                <th colspan="2"><center>
                  Grasa
                </center></th>
                <th colspan="2"><center>
                  Proteina
                </center></th>
                <th colspan="2"><center>
                  RCS
                </center></th>
                <th colspan="2"><center>
                  Reductasa
                </center></th>
                <th colspan="2"><center>
                  Acidez
                </center></th>
                <th colspan="2"><center>
                  Temperatura
                </center></th>
                <th colspan="2"><center>
                  &#37; de agua
                </center></th>
                <th rowspan="2"><center>
                  Precio
                </center></th>
              </tr>
              <tr class="bg bg-gray">
                <td><center>&#37;</center></td>
                <td><center>Valor</center></td>
                <td><center>&#37;</center></td>
                <td><center>Valor</center></td>
                <td><center>x1000</center></td>
                <td><center>Valor</center></td>
                <td><center>&#37;</center></td>
                <td><center>Valor</center></td>
                <td><center>&#37;</center></td>
                <td><center>Valor</center></td>
                <td><center>&#37;</center></td>
                <td><center>Valor</center></td>
                <td><center>&#37;</center></td>
                <td><center>Valor</center></td>
              </tr>
           </thead>
           <tbody id="detalle_analisis_leche">
           </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#tabla_analisis_leche").dataTable({                
      "sPaginationType": "full_numbers"
  });
});

function ver_pdf(id){
   $.ajax({
      data: {'id':id},
      dataType: 'json',
      type: 'POST',
      url: 'reportes/factura_leche.php',
      beforeSend: function () {
          document.getElementById('pdfanalisis').innerHTML=('<br><br><center><br><p>Generando reporte...</p></center><br><br>');
          $("#factura_venta").modal('show');
      },
      success: function(response){
        if(response.success == true) {
            document.getElementById('pdfanalisis').innerHTML=(''+response.link+'');
        }else{
            document.getElementById('pdfanalisis').innerHTML=(response.error);
        }
      },
      error: function() {
          document.getElementById('pdfanalisis').innerHTML=('<br><br><center><br><p>Lo sentimos... <br> Ocurrio un error al realizar la transaccion tiempo de espera agotado</p></center><br><br>');
      }
  });
}

// Muestra el precion del tablon
function detalle_analisis(id){
    $.ajax({
      data: {'id':id},
      type: 'POST',
      url : 'procesos/produccion/detalle_analisis.php',
      success: function(response){
        $('#detalle_analisis_leche tr').remove();
        $('#detalle_analisis_leche').html(response);
      },
      error: function(){
        $.confirm({icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
      }
  });
}
</script>