<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-ge"></i>&nbsp;Administraci&oacute;n de pruebas CMT
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-ge"></i>&nbsp;Administraci&oacute;n de pruebas CMT</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=cprueba_cmt" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar prueba CMT</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th>Fecha</th>
                    <th>Animales revisados</th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_pruebas_cmt();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['animales_revisados'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle de control sanitario" data-toggle="modal" data-target="#info_pruebas_cmt" onclick="ver('<?php echo $datos['fecha']?>')"><i class="fa white fa-eye"></i></label>
                      <label class="btn btn-primary" title="Reporte de pruebas CMT" data-toggle="modal" data-target="#" onclick="ver_pdf('<?php echo $datos['fecha']?>')"><i class="fa white fa-file-pdf-o"></i></label>
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
<div class="modal fade" id="info_pruebas_cmt" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Animales con el evento&nbsp;<span class="break"></span><label id="evento_sanitario" style="color: #033FE7;"></label></h4>
      </div>
      <div class="modal-body">
        <table role="grid" id="tabla_prueba_cmt" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
           <thead>
              <tr class="bg bg-info">
                <th>N&uacute;mero</th>
                <th>Nombre</th>
                <th>DI</th>
                <th>DR</th>
                <th>TI</th>
                <th>TD</th>
              </tr>
           </thead>
           <tbody id="detalle_prueba_cmt">
           </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="reporte_prueba_cmt" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Factura</h4>
      </div>
      <div class="modal-body">
        <div id="pdf_prueba_cmt" style="height: 670px;"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
function ver(id){
  $.ajax({
    url : 'procesos/sanidad/listar_prueba_cmt.php',
    type: 'POST',
    data: {'id':id},
    success: function(response){
      $("#detalle_prueba_cmt").html(response);
    },
    error: function(){
      $.confirm({icon: 'fa fa-exclamation', title: 'Hubo un error al ejecutar la acción', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Cerrar', btnClass: 'btn-danger', action: function(){close();}}}});
    }
  });
}

function ver_pdf(id){
   $.ajax({
      data: {'id':id},
      dataType: 'json',
      type: 'POST',
      url: 'reportes/rep_prueba_cmt.php',
      beforeSend: function () {
          $("#reporte_prueba_cmt").modal('show');
          document.getElementById('pdf_prueba_cmt').innerHTML=('<br><br><center><br><p>Generando reporte...</p></center><br><br>');
      },
      success: function(response){
        if(response.success == true) {
            document.getElementById('pdf_prueba_cmt').innerHTML=(''+response.link+'');
        }else{
            document.getElementById('pdf_prueba_cmt').innerHTML=(response.error);
        }
      },
      error: function() {
          document.getElementById('pdf_prueba_cmt').innerHTML=('<br><br><center><br><p>Lo sentimos... <br> Ocurrio un error al realizar la transaccion tiempo de espera agotado</p></center><br><br>');
      }
  });
}
</script>