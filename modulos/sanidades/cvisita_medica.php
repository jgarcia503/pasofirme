<?php
$response_animales=$data->query("SELECT * FROM animales");
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Registrar visita m&eacute;dica
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=visita_medica"><i class="fa fa-user-md"></i>&nbsp;Visitas m&eacute;dicas</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Registrar visita m&eacute;dica</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmcvisitamedica" id="frmcvisitamedica" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <fieldset>
                <div class="form-group col-md-3">
                  <label>Localizaci&oacute;n</label>
                  <input type="text" class="form-control" name="localizacion" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3">
                  <label>T&eacute;cnico</label>
                  <input type="text" class="form-control" name="tecnico" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3">
                  <label>Vacas Prod.</label>
                  <input type="text" class="form-control" name="vacas" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3">
                  <label>Terneras</label>
                  <input type="text" class="form-control" name="terneras" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-3">
                  <label>Fecha</label>
                  <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
                </div>
                <div class="form-group col-md-3">
                  <label>Tipo de visita</label>
                  <select class="form-control" name="tipovisita" id="tipovisita" data-validation="required" data-validation-error-msg="Seleccione tipo de visita">
                    <option value="">Seleccione tipo de visita</option>
                    <option value="rutinaria">Rutinaria</option>
		            <option value="prueba">Prueba</option>
		            <option value="cirugia">Cirugia</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label>Novillas</label>
                  <input type="text" class="form-control" name="novillas" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3">
                  <label>Vacas horras</label>
                  <input type="text" class="form-control" name="vacashorras" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
              </fieldset>
              <fieldset>
              	<div class="form-group col-md-3" id="div_animal">
                  <label>Animal</label>
                  <select class="form-control" name="animal" id="animal" data-validation="required" data-validation-error-msg="Seleccione animal">
                    <option value="">Seleccione animal</option>
                    <?php foreach ($response_animales['items'] as $key_animales) { ?>
                      <option value="<?php echo $key_animales['numero'] ?>"><?php echo $key_animales['nombre'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label>Costo visita</label>
                  <input type="text" class="form-control" name="costovisita" id="costovisita" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3">
                  <label>Prod. Botellas</label>
                  <input type="text" class="form-control" name="botellas" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-3">
                  <label>Socio</label>
                  <select class="form-control" name="socio" id="socio" data-validation="required" data-validation-error-msg="Seleccione">
                    <option value="">Seleccione</option>
                    <option value="si">Si</option>
            		<option value="no">No</option>
                  </select>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-12">
                  <label>Notas</label>
                  <textarea name="notas" class="form-control" rows="9"></textarea>
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
$("#animal").prop('disable', true);
$("#div_animal").hide();
$("#tipovisita").on('change', function(){
	switch ($(this).val()){
		case 'rutinaria':
			$("#div_animal").show(1500);
			$("#animal").prop('disable', false);
		break;
		default:
			$("#animal").prop('disable', true);
			$("#div_animal").hide(2000);
		break;
	}
});

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
        onSuccess: function(form){
            var formulario = document.getElementById("frmcvisitamedica");
            var formData = new FormData(formulario);
            $.ajax({
                url: "procesos/sanidad/guardar_visita_medica.php",
                type: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                  $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                },
                success: function(response){
                    if (response.success == true) {
                      $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload(); }}}});
                    } else {
                      $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                    }
                },
                error: function() {
                    $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                },
                complete: function() {
                    $.unblockUI();
                }
            });
        }
    });
});
</script>