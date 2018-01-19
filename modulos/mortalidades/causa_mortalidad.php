<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-warning"></i>&nbsp;Administraci&oacute;n de causa de mortalidad
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-warning"></i>&nbsp;Administraci&oacute;n de causa de mortalidad</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><label data-toggle="modal" data-target="#ccausamortalidad"><i class="fa fa-plus-circle"></i>&nbsp;Ingresar causa de mortalidad</label></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Nombre
                    </center></th>
                    <th width="20%"><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
               $response = $dataTable->obtener_causa_mortalidad();
               ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td width="20%"><center>
                      <label class="btn btn-success" title="Detalle de causa de mortalidad" data-toggle="modal" data-target="#icausamortalidad" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
                      <label class="btn btn-primary" title="Actualizar causa de mortalidad" data-toggle="modal" data-target="#ucausamortalidad" onclick="actualizar('<?php echo $datos['id']?>')"><i class="fa white fa-edit"></i></label>
                      <label class="btn btn-danger" title="Eliminar causa de mortalidad" onclick="eliminar('<?php echo $datos['id']?>')"><i class="fa white fa-trash"></i></label>
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
<div class="modal fade" id="icausamortalidad" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n causa de mortalidad</h4>
      </div>
      <div class="modal-body">
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" id="inombre" class="form-control" readonly>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas</label>
              <textarea id="inotas" rows="5" class="form-control" readonly></textarea>
            </div>
          </fieldset>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="ccausamortalidad" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear causa de mortalidad</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmccausa" id="frmccausa" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
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
<div class="modal fade" id="ucausamortalidad" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Actualizar causa de mortalidad</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmucausa" id="frmucausa" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <input type="hidden" name="id_causa" id="id_causa" readonly>
          <input type="hidden" name="causa_anterior" id="causa_anterior" readonly>
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
        <button type="submit" id="actualizar" name="actualizar" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button>
      </div>
      </form>
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
        var formulario = $('#frmccausa').serializeArray();
        $.ajax({
            data: formulario,
            type: 'POST',
            dataType: "Json",
            url: 'procesos/mortalidad/guardar_causa_mortalidad.php',
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
  $.post("procesos/mortalidad/info_causa.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('inombre').value = resultado[0].nombre;
      document.getElementById('inotas').value = resultado[0].notas;
    });
}

function actualizar(id){
  $.post("procesos/mortalidad/info_causa.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('id_causa').value = resultado[0].id;
      document.getElementById('causa_anterior').value = resultado[0].nombre;
      document.getElementById('unombre').value = resultado[0].nombre;
      document.getElementById('unotas').value = resultado[0].notas;
    });
}

//Actualizar datos a la BD
$('#actualizar').click(function () {
  $.validate({
     onSuccess : function(form) {
        var formulario = $('#frmucausa').serializeArray();
        $.ajax({
            data: formulario,
            type: 'POST',
            dataType: "Json",
            url: 'procesos/mortalidad/actualizar_causa_mortalidad.php',
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

function eliminar(id){
  $.confirm({title: 'Desea elminar causa de mortalidad?', content:'', icon: 'fa fa-info-circle', 
        buttons: {
          Si: function () {
            close();
            $.ajax({
              type: 'POST',
              dataType: 'json',
              data: {'id':id},
              url: "procesos/mortalidad/eliminar_causa_mortalidad.php",
              beforeSend: function(){
                $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
              },
              success: function(response){
                if (response.success == true) {
                  $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href='?mod=causa_mortalidad'}}}});
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