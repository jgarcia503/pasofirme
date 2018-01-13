<?php
$params = $_POST;
$response_servicios=$data->query("SELECT * FROM servicios WHERE id = :id_servicios", $params, array("id_servicios"));
$response_hembra=$data->query("SELECT CONCAT(numero,' ',nombre) animal FROM animales WHERE sexo = 'Hembra'", array(), array());
$response_macho=$data->query("SELECT CONCAT(numero,'-',nombre) animal_macho FROM animales WHERE sexo = 'Macho'", array(), array());
$response_pajilla=$data->query("SELECT * FROM pajillas_toros", array(), array());
foreach ($response_servicios['items'] as $detalle) { ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-edit"></i>&nbsp;Modificar servicio
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
    <li class="active"><i class="fa fa-edit"></i>&nbsp;Modificar servicio</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmuservicios" id="frmuservicios" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <input type="hidden" name="id_servicios" value="<?php echo $_POST['id_servicios']?>" readonly>
              <fieldset>
                <div class="form-group col-md-3">
                  <label>Fecha</label>
                  <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly value="<?php echo $detalle['fecha']?>">
                </div>
                <div class="form-group col-md-3">
                  <label>Hora</label>
                  <input type="text" class="form-control timepicker" name="hora" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $detalle['hora']?>">
                </div>
                <div class="form-group col-md-3">
                  <label>Animal</label>
                  <select class="form-control" name="animal" id="animal" data-validation="required" data-validation-error-msg="Seleccione animal">
                    <option value="">Seleccione animal</option>
                    <?php foreach ($response_hembra['items'] as $key_hembra) { ?>
                    <?php if ($detalle['animal']==$key_hembra['animal']){ ?>
                    <option selected value="<?php echo $detalle['animal']?>"><?php echo $detalle['animal'] ?></option>
                    <?php }else{?>
                    <option value="<?php echo $key_hembra['animal']?>"><?php echo $key_hembra['animal']?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label>Padre</label>
                  <select class="form-control" name="padre" id="padre" data-validation="required" data-validation-error-msg="Seleccione padre">
                    <option value="">Seleccione padre</option>
                    <?php foreach ($response_macho['items'] as $key_macho) { ?>
                    <?php if ($detalle['padre']==$key_macho['animal_macho']){ ?>
                    <option selected value="<?php echo $detalle['padre']?>"><?php echo $detalle['padre'] ?></option>
                    <?php }else{?>
                    <option value="<?php echo $key_macho['animal_macho']?>"><?php echo $key_macho['animal_macho']?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-3">
                  <label>Tipo</label>
                  <select class="form-control" name="tipo" id="tipo" data-validation="required" data-validation-error-msg="Seleccione tipo" onchange="ocultar($(this).val());">
                    <option value="">Seleccione tipo</option>
                    <option value="monta directa" <?php echo $detalle['tipo']=='monta directa'?'selected':''?>>Monta directa</option>
                    <option value="inseminacion" <?php echo $detalle['tipo']=='inseminacion'?'selected':''?>>Inseminaci&oacute;n</option>
                    <option value="fiv" <?php echo $detalle['tipo']=='fiv'?'selected':''?>>Fecundaci&oacute;n in vitro</option>
                    <option value="te" <?php echo $detalle['tipo']=='te'?'selected':''?>>Transferencia de embriones</option>
                  </select>
                </div>
                <div class="form-group col-md-3" id="div_donadora">
                  <label>Donadora</label>
                  <input type="text" class="form-control" name="donadora" id="donadora" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $detalle['donadora']?>">
                </div>
                <div class="form-group col-md-3" id="div_inseminador">
                  <label>Inseminador</label>
                  <input type="text" class="form-control" name="inseminador" id="inseminador" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $detalle['inseminador']?>">
                </div>
                <div class="form-group col-md-3">
                  <label>Pajillas</label>
                  <input type="text" class="form-control" name="pajilla" id="pajilla" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $detalle['codigo_pajilla']?>" readonly>
              </fieldset>
              <fieldset class="col-md-12">
                <div class="form-group">
                  <label>Notas</label>
                  <textarea name="notas" class="form-control" rows="5"><?php echo $detalle['notas'] ?></textarea>
                </div>
              </fieldset>
              <div class="box-footer">
                <button type="button" onClick="location.href='?mod=servicios'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
                <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa white fa-refresh"></i>&nbsp;Actualizar</button>
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
  ocultar($("#tipo").val());
});
function ocultar(val){
  switch(val){
    case 'monta directa':
      $("#donadora").prop('disable', true);
      $("#div_donadora").hide();
      $("#inseminador").prop('disable', true);
      $("#div_inseminador").hide();
    break;
    case 'inseminacion':
      $("#donadora").prop('disable', true);
      $("#div_donadora").hide();
      $("#div_inseminador").show();
      $("#inseminador").prop('disable', false);
      document.getElementById('donadora').value = '';
    break;
    case 'fiv':
      $("#div_donadora").show();
      $("#donadora").prop('disable', false);
      $("#div_inseminador").show();
      $("#inseminador").prop('disable', false);
    break;
    case 'te':
      $("#div_donadora").show();
      $("#donadora").prop('disable', false);
      $("#div_inseminador").show();
      $("#inseminador").prop('disable', false);
    break;
    case '':
      $("#donadora").prop('disable', true);
      $("#div_donadora").hide();
      $("#inseminador").prop('disable', true);
      $("#div_inseminador").hide();
    break;
  }
}

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
       onSuccess : function(form) {
          var formulario = $('#frmuservicios').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/reproduccion/modificar_servicio.php',
              beforeSend: function () {
                  $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
              },
              success: function(response){
                  if (response.success == true) {
                      $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href='?mod=servicios';}}}});
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
<?php } ?>