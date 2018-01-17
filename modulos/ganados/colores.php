<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-adjust"></i>&nbsp;Administraci&oacute;n de colores
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-adjust"></i>&nbsp;Administraci&oacute;n de colores</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><label data-toggle="modal" data-target="#crear_color"><i class="fa fa-plus-circle"></i>&nbsp;Ingresar color</label></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Nombre
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_colores();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td><center>
                        <label class="btn btn-primary" title="Actualizar informaci&oacute;n" data-toggle="modal" data-target="#actualizar_color" onclick="ucolor('<?php echo $datos['id']?>','<?php echo $datos['nombre']?>');"><i class="fa white fa-edit"></i></label>
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
<div class="modal fade" id="crear_color" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear color</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmcolor" id="frmcolor" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
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
<div class="modal fade" id="actualizar_color" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Actualizar informaci&oacute;n</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmucolor" id="frmucolor" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <input type="hidden" name="id_color" id="id_color" readonly>
          <input type="hidden" name="nombre_ant" id="nombre_ant" readonly>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" name="unombre" id="unombre" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
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
function color(id){
  document.getElementById('color_id').value = id;
}

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmcolor').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/ganado/guardar_color.php',
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

function ucolor(id, nombre, notas){
  document.getElementById('id_color').value = id;
  document.getElementById('nombre_ant').value = nombre;
  document.getElementById('unombre').value = nombre;
}

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#actualizar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmucolor').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/ganado/actualizar_color.php',
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
  $.confirm({title: 'Desea elminar el color?', content:'', icon: 'fa fa-info-circle', 
        buttons: {
          Si: function () {
            close();
            $.ajax({
              type: 'POST',
              dataType: 'json',
              data: {'id_color':id},
              url: "procesos/ganado/eliminar_color.php",
              beforeSend: function(){
                $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
              },
              success: function(response){
                if (response.success == true) {
                  $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href='?mod=colores'}}}});
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