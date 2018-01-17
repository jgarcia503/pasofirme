<?php
$response_palpaciones=$data->query("SELECT * FROM resul_palpaciones", array(), array());
$response_contactos=$data->query("SELECT nombre FROM contactos WHERE tipo = 'empleado'", array(), array());
$response_animales=$data->query("SELECT DISTINCT CONCAT(a.numero,' ',a.nombre) animal FROM animales a INNER JOIN servicios s ON s.animal=a.numero ||' '|| a.nombre WHERE a.sexo='Hembra'", array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear palpaciones
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=palpaciones"><i class="fa fa-ils"></i>&nbsp;Administraci&oacute;n de palpaciones</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear palpaciones</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmcpalpaciones" id="frmcpalpaciones" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <fieldset>
                <div class="form-group col-md-4">
                  <label>Fecha</label>
                  <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label>Animal</label>
                  <select class="form-control" name="animal" id="animal" data-validation="required" data-validation-error-msg="Seleccione animal">
                    <option value="">Seleccione animal</option>
                    <?php foreach ($response_animales['items'] as $key_animales) { ?>
                      <option value="<?php echo $key_animales['animal'] ?>"><?php echo $key_animales['animal'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Palpador</label>
                  <select class="form-control" name="palpador" id="palpador" data-validation="required" data-validation-error-msg="Seleccione palpador">
                    <option value="">Seleccione palpador</option>
                    <?php foreach ($response_contactos['items'] as $key_contactos) { ?>
                    <option value="<?php echo $key_contactos['nombre']?>"><?php echo $key_contactos['nombre']?></option>
                    <?php } ?>
                  </select>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-5">
                  <label>Resultado</label>
                  <select class="form-control" name="resultado" id="resultado" data-validation="required" data-validation-error-msg="Seleccione resultado">
                    <option value="">Seleccione resultado</option>
                    <?php foreach ($response_palpaciones['items'] as $key_palpaciones) { ?>
                    <option value="<?php echo $key_palpaciones['id'] ?>"><?php echo $key_palpaciones['nombre'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-3" id="div_gsuciedad">
                  <label>Nivel del suciedad</label>
                  <select class="form-control" name="grado_suciedad" id="grado_suciedad" data-validation="required" data-validation-error-msg="Seleccione nivel de suciedad">
                    <option value="">Seleccione nivel de suciedad</option>
                    <option value="leve">Leve</option>
                    <option value="regular">Regular</option>
                    <option value="severo">Severo</option>
                  </select>
                </div>
                <div class="form-group col-md-3" id="div_cuerno">
                  <label>Cuerno uterino</label>
                  <select class="form-control" name="cuerno" id="cuerno" data-validation="required" data-validation-error-msg="Seleccione cuerno">
                    <option value="">Seleccione cuerno</option>
                    <option value="izquierdo">Izquierdo</option>
                    <option value="derecho">Derecho</option> 
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label>Pre&ntilde;ada&#63;</label>
                  <br>
                  <input type="radio" name="prenada" value="si">&nbsp;Si
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="prenada" value="no" checked>&nbsp;No
                </div>
                <div class="form-group col-md-2" id="div_meses">
                  <label>Meses de pre&ntilde;ez</label>
                  <input type="text" class="form-control" name="meses" id="meses" data-validation="required" data-validation-error-msg="Complete este campo">
              </fieldset>
              <fieldset>
                <div class="form-group col-md-12">
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
  $("#grado_suciedad").prop('disable', true);
  $("#div_gsuciedad").hide();
  $("#cuerno").prop('disable', true);
  $("#div_cuerno").hide();
  $("#meses").prop('disable', true);
  $("#div_meses").hide();
});

$("#resultado").on('change', function(){
  switch($(this).val()){
    case '11':
      $("#div_gsuciedad").show();
      $("#grado_suciedad").prop('disable', false);
      $("#cuerno").prop('disable', true);
      $("#div_cuerno").hide();
    break;
    case '9':
      $("#div_cuerno").show();
      $("#cuerno").prop('disable', false);
      $("#grado_suciedad").prop('disable', true);
      $("#div_gsuciedad").hide();
    break;
    default:
      $("#grado_suciedad").prop('disable', true);
      $("#div_gsuciedad").hide();
      $("#cuerno").prop('disable', true);
      $("#div_cuerno").hide();
      $("#meses").prop('disable', true);
      $("#div_meses").hide();
    break;
  }
});
$("[type=radio]").on('change', function(){
  switch($(this).val()){
    case 'si':
      $("#div_meses").show();
      $("#meses").prop('disable', false);
    break;
    case 'no':
      $("#meses").prop('disable', true);
      $("#div_meses").hide();
    break;
  }
});

//Guardar datos a la BD
$('#guardar').click(function () {
  $.validate({
    onSuccess : function(form) {
      var formulario = $('#frmcpalpaciones').serializeArray();
      $.ajax({
        data: formulario,
        type: 'POST',
        dataType: "Json",
        url: 'procesos/reproduccion/guardar_palpacion.php',
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