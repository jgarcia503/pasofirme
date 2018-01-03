<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-paw"></i>&nbsp;Administraci&oacute;n de razas
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-paw"></i>&nbsp;Administraci&oacute;n de razas</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><label data-toggle="modal" data-target="#crear_raza"><i class="fa fa-plus-circle"></i>&nbsp;Ingresar raza</label></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tabla_razas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Nombre
                    </center></th>
                    <th><center>
                      Notas
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_razas();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td><?php echo $datos['notas'] ?></td>
                    <td><center>
                        <label class="btn btn-primary" title="Actualizar informaci&oacute;n" data-toggle="modal" data-target="#actualizar_raza" onclick="uraza('<?php echo $datos['id']?>','<?php echo $datos['nombre']?>','<?php echo $datos['notas']?>');"><i class="fa white fa-edit"></i></label>
                        <label class="btn btn-danger" title="Eliminar" onclick="eliminar('<?php echo $datos['id']?>')"><i class="fa white fa-trash"></i></label>
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
<div class="modal fade" id="crear_raza" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear raza</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmcraza" id="frmcraza" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
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

<!-- Ventana modal para actualizar informacion -->
<div class="modal fade" id="actualizar_raza" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Actualizar informaci&oacute;n</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmuraza" id="frmuraza" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <input type="hidden" name="raza_id" id="raza_id" readonly>
          <input type="hidden" name="nombre_ant" id="nombre_ant" readonly>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" name="unombre" id="unombre" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas</label>
              <textarea name="unotas" id="unotas" rows="5" class="form-control"></textarea>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
        <button type="submit" id="actualizar" name="actualizar" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;Enviar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#tabla_razas").dataTable({
      "sPaginationType": "full_numbers"
  });
});

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmcraza').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/ganado/guardar_raza.php',
                    beforeSend: function () {
                        $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                    },
                    success: function(response){
                        if (response.success == true) {
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload();}}}});
                        }else{
                            $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
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
});

function uraza(id, nombre, notas){
  document.getElementById('raza_id').value = id;
  document.getElementById('nombre_ant').value = nombre;
  document.getElementById('unombre').value = nombre;
  document.getElementById('unotas').value = notas;
}

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#actualizar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmuraza').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/ganado/actualizar_raza.php',
                    beforeSend: function () {
                        $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                    },
                    success: function(response){
                        if (response.success == true) {
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload();}}}});
                        }else{
                            $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
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
});

function eliminar(id){
  $.confirm({title: 'Desea elminar la raza?', content:'', icon: 'fa fa-info-circle', 
        buttons: {
          Si: function () {
            close();
            $.ajax({
              type: 'POST',
              dataType: 'json',
              data: {'id_raza':id},
              url: "procesos/ganado/eliminar_raza.php",
              beforeSend: function(){
                $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
              },
              success: function(response){
                if (response.success == true) {
                  $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href='?mod=razas'}}}});
                }else{
                  $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                }
              },
              error: function(){
                $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
              },
              complete: function(){
                $.unblockUI();
              }
            });
          }, No: function () {
            close();
          },
        }
  });
}
</script>