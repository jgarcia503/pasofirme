<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-lastfm-square"></i>&nbsp;Administraci&oacute;n de eventos sanitarios
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-lastfm-square"></i>&nbsp;Administraci&oacute;n de eventos sanitarios</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><label data-toggle="modal" data-target="#ceventos_sanitarios"><i class="fa fa-plus-circle"></i>&nbsp;Ingresar evento sanitario</label></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>Nombre</center></th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_eventos_sanitarios();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle de eventos" data-toggle="modal" data-target="#ieventos_sanitarios" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
                      <label class="btn btn-warning" title="Detalle de purga" data-toggle="modal" data-target="#info_eventos_sanitarios" onclick="ver_purga('<?php echo $datos['id']?>', '<?php echo $datos['nombre']?>')"><i class="fa white fa-tencent-weibo"></i></label>
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
<div class="modal fade" id="ceventos_sanitarios" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear evento sanitario</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmceventosanitario" id="frmceventosanitario" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas</label>
              <textarea name="notas" rows="5" class="form-control"></textarea>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
        <button type="submit" id="guardar" name="guardar" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="ieventos_sanitarios" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n de evento sanitario</h4>
      </div>
      <div class="modal-body">
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" name="inombre" id="inombre" class="form-control" readonly>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas</label>
              <textarea name="inotas" id="inotas" rows="5" class="form-control" readonly></textarea>
            </div>
          </fieldset>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="info_eventos_sanitarios" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Animales con el evento&nbsp;<span class="break"></span><label id="evento_sanitario" style="color: #033FE7;"></label></h4>
      </div>
      <div class="modal-body">
        <table role="grid" id="tabla_evento_sanitario" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
           <thead>
              <tr class="bg bg-info">
                <th>Fecha</th>
                <th>Hora</th>
                <th>Animal</th>
              </tr>
           </thead>
           <tbody id="detalle_evento_sanitario">
           </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
       onSuccess : function(form) {
          var formulario = $('#frmceventosanitario').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/sanidad/guardar_evento_sanitario.php',
              beforeSend: function () {
                  $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
              },
              success: function(response){
                  if (response.success == true) {
                      $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload();}}}});
                  }else{
                      $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                  }
              },
              error: function() {
                  $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
              },
              complete: function() {
                  $.unblockUI();
              }
          });
        }
    });
});

function ver(id){
  $.post("procesos/sanidad/detalle_eventos_sanitarios.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('inombre').value = resultado[0].nombre;
      document.getElementById('inotas').value = resultado[0].notas;
    });
}

function ver_purga(id, nombre){
    $.ajax({
      url : 'procesos/sanidad/listar_evento_sanitario.php',
      type: 'POST',
      data: {'id':id},
      dataType: 'json',
      success: function(response){
        if(response.success){
          $("#tabla_evento_sanitario").DataTable().clear();
          $("#tabla_evento_sanitario").DataTable().destroy();
          $.each(response.items, function(index, value){
            $("#detalle_evento_sanitario").append("<tr><td>"+value.fecha+"</td>"
                                                      +"<td>"+value.hora+"</td>"
                                                      +"<td>"+value.animal+"</td>"
                                                  +"</tr>");
          });
          document.getElementById('evento_sanitario').innerHTML=nombre;
        }else{
          $.confirm({icon: 'fa fa-exclamation', title: '', content: 'response.error', type: 'orange', typeAnimated: true, buttons: { tryAgain: { text: 'Cerrar', btnClass: 'btn-warning', action: function(){close();}}}});
        }
        $("#tabla_evento_sanitario").dataTable({
          "sPaginationType": "full_numbers"
        });
      },
      error: function(){
        $.confirm({icon: 'fa fa-exclamation', title: 'Hubo un error al ejecutar la acción', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Cerrar', btnClass: 'btn-danger', action: function(){close();}}}});
      }
  });
}
</script>