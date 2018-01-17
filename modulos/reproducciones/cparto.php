<?php
$sql_animales="SELECT DISTINCT CONCAT(a.numero,'-',a.nombre) animales FROM animales a INNER JOIN palpaciones b ON a.numero||' '||a.nombre=b.animal WHERE a.sexo='Hembra' AND b.prenada='si'";
$response_animales=$data->query($sql_animales, array(), array());
$response_contactos=$data->query("SELECT nombre FROM contactos WHERE tipo='empleado'", array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear parto
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=partos"><i class="fa fa-stumbleupon-circle"></i>&nbsp;Administraci&oacute;n de partos</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear parto</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="box box-primary">
      <!-- /.box-header -->
      <div class="box-body">
          <form action="" role="form" name="frmcparto" id="frmcparto" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
            <fieldset>
              <div class="form-group col-md-6">
                <label>Fecha</label>
                <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Hora</label>
                <input type="text" class="form-control timepicker" name="hora" data-validation="required" data-validation-error-msg="Complete este campo">
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-4">
                <label>Animal</label>
                <div class="input-group">
                  <input type="text" class="form-control awesomplete" name="animal" id="animal" list="animales" data-minchars="1">
                  <datalist id="animales">
                    <?php foreach ($response_animales['items'] as $key_animales) { ?>
                      <option value="<?php echo $key_animales['animales'] ?>"><?php echo $key_animales['animales'] ?></option>
                    <?php } ?>
                  </datalist>
                  <div class="input-group-btn">
                    <label class="btn btn-success" title="Agregar animal" data-toggle="modal" data-target="#crear_animal"><i class="fa white fa-plus-circle"></i></label>
                  </div>
                  <!-- /btn-group -->
                </div>
              </div>
              <div class="form-group col-md-4">
                <label>Cr&iacute;a</label>
                <div class="input-group">
                  <input type="text" class="form-control awesomplete" name="cria" id="cria" list="animales" data-minchars="1">
                  <div class="input-group-btn">
                    <label class="btn btn-success" title="Agregar cr&iacute;a" data-toggle="modal" data-target="#crear_animal"><i class="fa white fa-plus-circle"></i></label>
                  </div>
                  <!-- /btn-group -->
                </div>
              </div>
              <div class="form-group col-md-4">
                <label>Empleado</label>
                <select class="form-control" name="empleado" id="empleado" data-validation="required" data-validation-error-msg="Seleccione empleado">
                  <option value="">Seleccione empleado</option>
                  <?php foreach ($response_contactos['items'] as $key_contactos) { ?>
                  <option value="<?php echo $key_contactos['nombre'] ?>"><?php echo $key_contactos['nombre'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-12">
                <label>Notas</label>
                <textarea name="notas" class="form-control" rows="5"></textarea>
              </div>
            </fieldset>
            <div class="box-footer">
              <button type="button" onClick="location.href='?mod=partos'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
              <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa white fa-save"></i>&nbsp;Guardar</button>
            </div>
          </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="crear_animal" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Ingresar animal&#47;Ingresar cr&iacute;a</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmcanimal" id="frmcanimal" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-4">
              <label>Estado</label>
              <select class="form-control" name="estado" id="estado" data-validation="required" data-validation-error-msg="Seleccione estado">
                <option value="">Seleccione estado</option>
                <option value="muerto">Muerto</option>
                <option value="activo">Activo</option>
                <option value="vendido">Vendido</option>
                <option value="externo">Externo</option>
              </select>
            </div>
            <div class="form-group col-md-4" id="div_numero">
              <label>N&uacute;mero</label>
              <input type="text" name="numero" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-4" id="div_nombre">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
              <label>Sexo</label>
              <select class="form-control" name="sexo" id="sexo" data-validation="required" data-validation-error-msg="Seleccione sexo">
                <option value="">Seleccione sexo</option>
                <option value="hembra">Hembra</option>
                <option value="macho">Macho</option>
              </select>
            </div>
            <div class="form-group col-md-4" id="div_fnacimiento">
              <label>Fecha</label>
              <input type="text" name="fnacimiento" data-provide="datepicker" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo" readonly placeholder="dd-mm-yyyy">
            </div>
            <div class="form-group col-md-4" id="div_pnacimiento">
              <label>Peso de nacimiento</label>
              <input type="text" name="pnacimiento" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-4" id="div_empleado">
              <label>Empleado</label>
              <select class="form-control" name="empleado" id="empleado" data-validation="required" data-validation-error-msg="Seleccione empleado">
                <option value="">Seleccione empleado</option>
                <?php foreach ($response_contactos['items'] as $key_contactos) { ?>
                <option value="<?php echo $key_contactos['nombre'] ?>"><?php echo $key_contactos['nombre'] ?></option>
                <?php } ?>
              </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12" id="div_notas">
              <label>Notas</label>
              <textarea name="notas" rows="5" class="form-control"></textarea>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
        <button type="submit" id="guardar_animal" name="guardar_animal" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
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
          var formulario = $('#frmcparto').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/reproduccion/guardar_parto.php',
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

$(document).ready(function(){
  $("#empleado").prop('disable', true);
  $("#div_empleado").hide();
});
$("#estado").on('change', function(){
  switch($(this).val()){
    case 'muerto':
      $("#numero").prop('disable', true);
      $("#div_numero").hide();
      $("#nombre").prop('disable', true);
      $("#div_nombre").hide();
      $("#pnacimiento").prop('disable', true);
      $("#div_pnacimiento").hide();
      $("#div_notas").show();
      $("#notas").prop('disable', false);
      $("#div_empleado").show();
      $("#empleado").prop('disable', false);
    break;
    default:
      $("#div_numero").show();
      $("#numero").prop('disable', false);
      $("#div_nombre").show();
      $("#nombre").prop('disable', false);
      $("#div_pnacimiento").show();
      $("#pnacimiento").prop('disable', false);
      $("#notas").prop('disable', true);
      $("#div_notas").hide();
      $("#empleado").prop('disable', true);
      $("#div_empleado").hide();
    break;
  }
});

//Guardar datos a la BD
$('#guardar_animal').click(function () {
    $.validate({
       onSuccess : function(form) {
          var formulario = $('#frmcanimal').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/reproduccion/guardar_animal.php',
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
</script>