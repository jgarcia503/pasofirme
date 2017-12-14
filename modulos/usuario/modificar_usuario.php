<?php
if (isset($_POST['id'])) {
	$params = $_POST;
	$sql="SELECT * FROM contactos WHERE	id=:id";
	$param_list=array("id");
	$response_select=$data->query($sql, $params, $param_list);
	if ($response_select['total'] > 0) { ?>
<section class="content-header">
  <h1>
    <i class="fa fa-user"></i>&nbsp;Modificar usuario
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=usuarios"><i class="fa fa-user"></i>&nbsp;Usuarios</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-pencil-square-o"></i>&nbsp;Modificar usuario</li>
  </ol>
</section>
<section class="content">
	<div class="box box-warning">
	<!-- /.box-header -->
	<div class="box-body">
	<form action="" role="form" name="frm_musuario" id="frm_musuario" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
		<fieldset>
			<legend>Informaci&oacute;n b&aacute;sica</legend>
			<div class="form-group col-md-4">
			  <label>Nombres</label>
			  <input type="text" class="form-control" data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $response_select['items'][0]['nombre']?>" name="nombre" id="nombre">
			</div>
			<div class="form-group col-md-4">
			  <label>Tel&eacute;fono</label>
			  <input type="text" class="form-control" value="<?php echo $response_select['items'][0]['telefono']?>" name="telefono" id="telefono">
			</div>
			<div class="form-group col-md-4">
			  <label>Correo</label>
			  <input type="text" class="form-control" value="<?php echo $response_select['items'][0]['correo']?>" name="correo" id="correo">
			</div>
		</fieldset>
		<br>
		<fieldset>
			<legend>Datos del usuario</legend>
			<div class="form-group col-md-6">
			  <label>Tipo de usuario</label>
			  <select class="form-control" name="tusuario" id="tusuario" data-validation="required" data-validation-error-msg="Seleccione este campo">
			  	<option value="">Seleccione</option>
			  	<?php 
                    $sql_select = "SELECT tipo FROM contactos WHERE id=:id"; 
                    $params_select = array("id");
                    $response_data = $data->query($sql_select, $params, $params_select);
                    foreach ($response_data['items'] as $key) {?>
                        <option value="admin" <?php echo $key['tipo']=='admin'?'selected':''?>>Administrador</option>
                        <option value="empleado" <?php echo $key['tipo']=='empleado'?'selected':''?>>Empleado</option>
                        <option value="cliente" <?php echo $key['tipo']=='cliente'?'selected':''?>>Cliente</option>
                        <option value="proveedor" <?php echo $key['tipo']=='proveedor'?'selected':''?>>Proveedor</option>
                    <?php } ?>
			  </select>
			</div>
			<div class="form-group col-md-6" id="div_usuario">
			  <label>Usuario</label>
			  <input type="text" class="form-control " data-validation="required" data-validation-error-msg="Complete este campo" value="<?php echo $response_select['items'][0]['usuario']?>" name="usuario" id="usuario">
			</div>
		</fieldset>
        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo($response_select['items'][0]['id']); ?>">
		<div class="box-footer">
			<button type="button" onClick="location.href='?mod=inicio'" class="btn btn-danger margin-right pull-left">Cancelar</button>
		    <button type="reset" class="btn btn-success pull-left" id="limpiar">Limpiar</button>
		    <button type="submit" name="guardar" class="btn btn-primary pull-right" id="guardar" name="guardar">Guardar</button>
		</div>
	</form>
	</div>
	<!-- /.box-body -->
	</div>
</section>
<script type="text/javascript">
// para ocultar o mostrar los campos de usuario y rol
$(document).ready(function(){ 
    var id_usuario ='<?php echo($response_select["items"][0]["id"]) ?>';
    if(id_usuario > 0){
        $('select[name="tusuario"]').change(function () {
            if ($('option:selected').val() == 'admin' || $('option:selected').val() == 'empleado') {
                $('#usuario').prop('disabled', false);
                $('#div_usuario').show();
            }else{
                $('#div_usuario').hide();
                $('#usuario').prop('disable', true);
            }
        });
    }
    $('select[name="tusuario"]').change(function () {
        if ($('option:selected').val() == 'admin' || $('option:selected').val() == 'empleado') {
            $('#usuario').prop('disabled', false);
            $('#div_usuario').show();
        }else{
            $('#div_usuario').hide();
            $('#usuario').prop('disable', true);
       }
    }); 
});

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
            onSuccess : function(form) {
                var formulario = $('#frm_musuario').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/usuario/modificar_usuario.php',
                    beforeSend: function () {
                        $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                    },
                    success: function(response){
                        if (response.success == true) {
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href = "?mod=usuarios";}}}});
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
<?php
	}else{
		header('Location:?mod=usuario');
	}
}else{
	header('Location:?mod=error');
}
?>