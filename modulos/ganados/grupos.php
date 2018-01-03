<style type="text/css">
#uno {
  text-align: center;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-th-large"></i>&nbsp;Administraci&oacute;n de grupos
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-th-large"></i>&nbsp;Administraci&oacute;n de grupos</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><label data-toggle="modal" data-target="#crear_grupo"><i class="fa fa-plus-circle"></i>&nbsp;Ingresar grupo</label></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tabla_colores" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Nombre
                    </center></th>
                    <th><center>
                      Producci&oacute;n m&iacute;nima
                    </center></th>
                    <th><center>
                      D&iacute;as de nacida
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_grupos();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td id="uno"><?php echo $datos['produccion_minima'] ?></td>
                    <td id="uno"><?php echo $datos['dias_nac'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle del grupo" data-toggle="modal" data-target="#ver" onclick="ver('<?php echo $datos['nombre'] ?>', '<?php echo $datos['clasificacion'] ?>', '<?php echo $datos['produccion_minima'] ?>', '<?php echo $datos['dias_nac'] ?>')"><i class="fa white fa-eye"></i></label>
                      <label class="btn btn-primary" title="Actualizar informaci&oacute;n" data-toggle="modal" data-target="#actualizar_grupo" onclick="ugrupo('<?php echo $datos['id']?>','<?php echo $datos['nombre']?>','<?php echo $datos['produccion_minima'] ?>');"><i class="fa white fa-edit"></i></label>
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
<div class="modal fade" id="crear_grupo" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear grupo</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmgrupo" id="frmgrupo" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Clasificaci&oacute;n</label>
              <select name="clasificacion" id="clasificacion" class="form-control" data-validation="required" data-validation-error-msg="Seleccione clasificacion">
                <option value="">Seleccione Clasificaci&oacute;n</option>
                <option value="produccion">Producci&oacute;n</option>
                <option value="desarrollo">Desarrollo</option>
              </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12" id="div_pbotella">
              <label>Producci&oacute;n minima &#40;Botellas&#41;</label>
              <input type="text" name="produccion_botellas" id="produccion_botellas" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-12" id="div_dnacida">
              <label>D&iacute;as de nacida</label>
              <input type="text" name="dias_nacida" id="dias_nacida" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
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
<div class="modal fade" id="ver" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Detalle del grupo</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <div class="form-group col-md-6">
            <label>Nombre</label>
            <input type="text" class="form-control" id="nombre" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Clasificaci&oacute;n</label>
            <input type="text" class="form-control" id="vclasificacion" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-6">
            <label>Producci&oacute;n minima &#40;Botellas&#41;</label>
            <input type="text" class="form-control" id="produccion_minima" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>D&iacute;as de nacida</label>
            <input type="text" class="form-control" id="vdnacida" readonly>
          </div>
        </fieldset>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Ventana modal para actualizar informacion -->
<div class="modal fade" id="actualizar_grupo" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Actualizar informaci&oacute;n</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmucolor" id="frmucolor" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <input type="hidden" name="id_grupo" id="id_grupo" readonly>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Nombre</label>
              <input type="text" name="unombre" id="unombre" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Producci&oacute;n minima &#40;Botellas&#41;</label>
              <input type="text" name="upbotella" id="upbotella" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
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
  $("#tabla_colores").dataTable({
      "sPaginationType": "full_numbers"
  });
  $('#div_pbotella').hide();
  $('#produccion_botellas').prop('disable', true);
  $('#div_dnacida').hide();
  $('#dias_nacida').prop('disable', true);
});

$("#clasificacion").on('change', function(){
  switch($(this).val()){
    case 'produccion':
      $('#produccion_botellas').prop('disable', false);
      $('#div_pbotella').show();
      $('#dias_nacida').prop('disable', true);
      $('#div_dnacida').hide();
      document.getElementById('dias_nacida'). value = '';
    break;
    case 'desarrollo':
      $('#produccion_botellas').prop('disable', true);
      $('#div_pbotella').hide();
      $('#dias_nacida').prop('disable', false);
      $('#div_dnacida').show();
      document.getElementById('produccion_botellas'). value = '';
    break;
    case '':
      $('#div_pbotella').hide();
      $('#produccion_botellas').prop('disable', true);
      $('#div_dnacida').hide();
      $('#dias_nacida').prop('disable', true);
      document.getElementById('dias_nacida'). value = '';
      document.getElementById('produccion_botellas'). value = '';
    break;
  }
});

function color(id){
  document.getElementById('color_id').value = id;
}

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmgrupo').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/ganado/guardar_grupo.php',
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

function ver(nombre, clasificacion, pbotellas, dnacida){
  document.getElementById('nombre').value = nombre;
  document.getElementById('vclasificacion').value = clasificacion;
  document.getElementById('produccion_minima').value = pbotellas;
  document.getElementById('vdnacida').value = dnacida;
}

function ugrupo(id, nombre, pminima){
  document.getElementById('id_grupo').value = id;
  document.getElementById('unombre').value = nombre;
  document.getElementById('upbotella').value = pminima;
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
</script>