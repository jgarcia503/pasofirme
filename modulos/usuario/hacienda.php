<?php
	$sql="SELECT * FROM haciendas";
    $response = $data->query($sql, array(), array());
    if ($response['total'] > 0) { ?>

<div class="box box-primary">
<div class="box-header with-border">
	<h3 class="box-title">Hacienda</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
<form action="" role="form" name="frmhacienda" id="frmhacienda" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
	<fieldset>
		<!-- <legend>title or explanatory caption</legend> -->
		<div class="form-group col-md-6">
		  <label>Nit</label>
		  <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $response['items'][0]['nit']?>" name="nit" id="nit">
		</div>
		<div class="form-group col-md-6">
		  <label>Nombre</label>
		  <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $response['items'][0]['nombre']?>" name="nombre" id="nombre">
		</div>
	</fieldset>
	<fieldset>
		<!-- <legend>title or explanatory caption</legend> -->
		<div class="form-group col-md-4">
		  <label>Propietario</label>
		  <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $response['items'][0]['propietario']?>" name="propietario" id="propietario">
		</div>
		<div class="form-group col-md-4">
		  <label>Tel&eacute;fono</label>
		  <input type="text" class="form-control " data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $response['items'][0]['telefono']?>" placeholder="####-####" name="telefono" id="telefono">
		</div>
		<div class="form-group col-md-4">
		  <label>Correo</label>
		  <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $response['items'][0]['correo']?>" placeholder="user@example.com" name="correo" id="correo">
		</div>
	</fieldset>
	<fieldset>
		<!-- <legend>title or explanatory caption</legend> -->
		<div class="form-group col-md-6">
		  <label>Notas</label>
		  <textarea class="form-control" rows="5" name="notas" id="notas"><?php echo $response['items'][0]['notas'] ?></textarea>
		</div>
		<div class="form-group col-md-6">
		  <label>Direcci&oacute;n</label>
		  <textarea class="form-control" rows="5" name="direccion" id="direccion"><?php echo $response['items'][0]['direccion'] ?></textarea>
		</div>
	</fieldset>
	<div class="box-footer">
		<button type="button" onClick="location.href='?mod=inicio'" class="btn btn-danger margin-right pull-left">Cancelar</button>
	    <button type="reset" class="btn btn-success pull-left" id="limpiar">Limpiar</button>
	    <button type="submit" name="guardar" class="btn btn-primary pull-right" id="guardar" name="guardar">Guardar</button>
	</div>
</form>
</div>
<!-- /.box-body -->
</div>
<?php } ?>
<script type="text/javascript">
// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmhacienda').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/usuario/crud_hacienda.php',
                    beforeSend: function () {
                        $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                    },
                    success: function(response){
                        if (response.success == true) {
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload(); }}}});
                        }else{
                            $.confirm({theme: 'supervan', iconc: 'fa fa-exclamation', title: 'Verifique su informacion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                        }
                    },
                    error: function() {
                        $.confirm({theme: 'supervan', iconc: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                    },
                    complete: function() {
                        $.unblockUI();
                    }
                });
            }
        });
    });
});

$(function () {
    $.mask.definitions['~'] = "[+-]";
    $("#telefono").mask("9999-9999");
    $("#nit").mask("9999-999999-999-9");
});
</script>
<script src="plugins/input-mask/jquery.maskedinput.min.js"></script>