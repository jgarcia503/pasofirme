<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Ingreso de nuevo usuario
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=usuarios"><i class="fa fa-user"></i>&nbsp;Registro de usuarios</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Ingreso de nuevo usuario</li>
  </ol>
</section>
<section class="content">
	<div class="box box-primary">
	<!-- /.box-header -->
	<div class="box-body">
	<form action="" role="form" name="frm_usuario" id="frm_usuario" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
		<fieldset>
			<legend>Informaci&oacute;n b&aacute;sica</legend>
			<div class="form-group col-md-4">
			  <label>Nombres</label>
			  <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo" name="nombre" id="nombre">
			</div>
			<div class="form-group col-md-4">
			  <label>Tel&eacute;fono</label>
			  <input type="text" class="form-control" name="telefono" id="telefono" placeholder="####-####">
			</div>
			<div class="form-group col-md-4">
			  <label>Correo</label>
			  <input type="text" class="form-control" name="correo" id="correo" placeholder="user@example.com">
			</div>
		</fieldset>
		<br>
		<fieldset>
			<legend>Datos del usuario</legend>
			<div class="form-group col-md-6">
			  <label>Tipo de usuario</label>
			  <select class="form-control" name="tipo" id="tipo" data-validation="required" data-validation-error-msg="Rellene este campo">
                <option value="">Seleccione</option>
                <option value="admin">Administrador</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
                <option value="proveedor">Proveedor</option>
              </select>
			</div>
			<div class="form-group col-md-6" id="div_usuario">
			  <label>Usuario</label>
			  <input type="text" class="form-control " data-validation="required" data-validation-error-msg="Complete este campo" name="usuario" id="usuario">
			</div>
		</fieldset>
		<div class="box-footer">
			<button type="button" onClick="location.href='?mod=inicio'" class="btn btn-danger margin-right pull-left"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
		    <button type="reset" class="btn btn-success pull-left" id="limpiar"><i class="fa fa-eraser"></i>&nbsp;Limpiar</button>
		    <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa fa-save"></i>&nbsp;Guardar</button>
		</div>
	</form>
	</div>
	<!-- /.box-body -->
	</div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    $('#div_usuario').hide();
    $('#usuario').prop('disable', true);
    $('#div_contrasena').hide();
    $('#contrasena').prop('disable', true);
    $('select[name="tipo"]').change(function () {
        if ($('option:selected').val() == 'admin' || $('option:selected').val() == 'empleado') {
            $('#usuario').prop('disabled', false);
            $('#div_usuario').show();
            $('#contrasena').prop('disabled', false);
            $('#div_contrasena').show();
        }else{
            $('#div_usuario').hide();
            $('#usuario').prop('disable', true);
            $('#div_contrasena').hide();
            $('#contrasena').prop('disable', true);
       }
    });
});
// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frm_usuario').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/usuario/guardar_usuario.php',
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
});

$(function () {
     $.mask.definitions['~'] = "[+-]";
     $("#telefono").mask("9999-9999");
});
</script>
<script src="plugins/input-mask/jquery.maskedinput.min.js"></script>