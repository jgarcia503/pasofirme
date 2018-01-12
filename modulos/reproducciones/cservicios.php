<?php
$response_hembra=$data->query("SELECT * FROM animales WHERE sexo = 'Hembra'", array(), array());
$response_macho=$data->query("SELECT * FROM animales WHERE sexo = 'Macho'", array(), array());
$response_pajilla=$data->query("SELECT * FROM pajillas_toros WHERE disponible = true", array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear servicios
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=servicios"><i class="fa fa-joomla"></i>&nbsp;Administraci&oacute;n de servicios</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear servicios</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmcservicios" id="frmcservicios" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <fieldset>
                <div class="form-group col-md-3">
                  <label>Fecha</label>
                  <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
                </div>
                <div class="form-group col-md-3">
                  <label>Hora</label>
                  <input type="text" class="form-control timepicker" name="hora" data-validation="required" data-validation-error-msg="Complete este campo" >
                </div>
                <div class="form-group col-md-3">
                  <label>Animal</label>
                  <select class="form-control" name="animal" id="animal" data-validation="required" data-validation-error-msg="Seleccione animal">
                    <option value="">Seleccione animal</option>
                    <?php foreach ($response_hembra['items'] as $key_hembra) { ?>
                      <option value="<?php echo $key_hembra['numero']?> <?php echo $key_hembra['nombre']?>"><?php echo $key_hembra['numero']?> <?php echo $key_hembra['nombre']?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label>Padre</label>
                  <select class="form-control" name="padre" id="padre" data-validation="required" data-validation-error-msg="Seleccione padre">
                    <option value="">Seleccione padre</option>
                    <?php foreach ($response_macho['items'] as $key_padre) { ?>
                    <option value="<?php echo $key_padre['numero']?>-<?php echo $key_padre['nombre']?>"><?php echo $key_padre['numero']?>-<?php echo $key_padre['nombre']?></option>
                    <?php } ?>
                  </select>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-3">
                  <label>Tipo</label>
                  <select class="form-control" name="tipo" id="tipo" data-validation="required" data-validation-error-msg="Seleccione tipo">
                    <option value="">Seleccione tipo</option>
                    <option value="monta directa">Monta directa</option>
                    <option value="inseminacion">Inseminaci&oacute;n</option>
                    <option value="fiv">Fecundaci&oacute;n in vitro</option>
                    <option value="te">Transferencia de embriones</option>
                  </select>
                </div>
                <div class="form-group col-md-3" id="div_donadora">
                  <label>Donadora</label>
                  <input type="text" class="form-control" name="donadora" id="donadora" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3" id="div_inseminador">
                  <label>Inseminador</label>
                  <input type="text" class="form-control" name="inseminador" id="inseminador" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3" id="div_pajilla">
                  <label>Pajillas</label>
                  <select class="form-control" name="pajilla" id="pajilla" data-validation="required" data-validation-error-msg="Seleccione pajilla">
                    <option value="">Seleccione pajilla</option>
                    <?php foreach ($response_pajilla['items'] as $key_pajilla) { ?>
                    <option value="<?php echo $key_pajilla['codigo_pajilla']?>"><?php echo $key_pajilla['codigo_toro']?>-<?php echo $key_pajilla['codigo_pajilla']?></option>
                    <?php } ?>
                  </select>
              </fieldset>
              <fieldset class="col-md-12">
                <div class="form-group">
                  <label>Notas</label>
                  <textarea name="notas" class="form-control" rows="5"></textarea>
                </div>
              </fieldset>
              <div class="box-footer">
                <button type="button" onClick="location.href='?mod=inicio'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
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
<script type="text/javascript">
$(document).ready(function(){
  $("#donadora").prop('disable', true);
  $("#div_donadora").hide();
  $("#inseminador").prop('disable', true);
  $("#div_inseminador").hide();
  $("#pajilla").prop('disable', true);
  $("#div_pajilla").hide();
});
$("#tipo").on('change', function(){
  switch($(this).val()){
    case 'monta directa':
      $("#donadora").prop('disable', true);
      $("#div_donadora").hide();
      $("#inseminador").prop('disable', true);
      $("#div_inseminador").hide();
      $("#pajilla").prop('disable', true);
      $("#div_pajilla").hide();
    break;
    case 'inseminacion':
      $("#donadora").prop('disable', true);
      $("#div_donadora").hide();
      $("#div_inseminador").show();
      $("#inseminador").prop('disable', false);
      $("#div_pajilla").show();
      $("#pajilla").prop('disable', false);
      document.getElementById('donadora').value = '';
    break;
    case 'fiv':
      $("#div_donadora").show();
      $("#donadora").prop('disable', false);
      $("#div_inseminador").show();
      $("#inseminador").prop('disable', false);
      $("#div_pajilla").show();
      $("#pajilla").prop('disable', false);
    break;
    case 'te':
      $("#div_donadora").show();
      $("#donadora").prop('disable', false);
      $("#div_inseminador").show();
      $("#inseminador").prop('disable', false);
      $("#div_pajilla").show();
      $("#pajilla").prop('disable', false);
    break;
    case '':
      $("#donadora").prop('disable', true);
      $("#div_donadora").hide();
      $("#inseminador").prop('disable', true);
      $("#div_inseminador").hide();
      $("#pajilla").prop('disable', true);
      $("#div_pajilla").hide();
    break;
  }
});

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
       onSuccess : function(form) {
          var formulario = $('#frmcservicios').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/reproduccion/guardar_servicio.php',
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