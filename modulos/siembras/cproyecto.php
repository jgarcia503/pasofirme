<?php 
$sql_potrero="SELECT * FROM potreros";
$response_potrero = $data->query($sql_potrero, array(), array());

$sql_vegetacion="SELECT * FROM tipo_vegetacion";
$response_vegetacion = $data->query($sql_vegetacion, array(), array());

$sql_bodegas="SELECT DISTINCT codigo, nombre FROM bodega b INNER JOIN existencias e ON b.codigo = e.codigo_bodega";
$response_bodega = $data->query($sql_bodegas, array(), array());
?>
<section class="content-header">
  <h1>
    <i class="fa fa-bookmark"></i>&nbsp;Creaci&oacute;n de proyecto
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=siembra"><i class="fa fa-leaf"></i>&nbsp;Administraci&oacute;n de proyectos</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-bookmark"></i>&nbsp;Creaci&oacute;n de proyecto</li>
  </ol>
</section>
<section class="content">
	<div class="box box-primary">
	<!-- /.box-header -->
	<div class="box-body">
	<form action="" role="form" name="frmproyecto" id="frmproyecto" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
		<fieldset>
            <div class="form-group col-md-6">
                <label>Nombre: </label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escriba el o los nombres del usuario" data-validation="required" data-validation-error-msg="Rellene este campo">
            </div>
            <div class="form-group col-md-6">
                <label>Fecha inicio: </label>
                <input type="text" class="form-control" data-provide="datepicker" name="fecha_inicio" id="fecha_inicio" data-validation="required" data-validation-error-msg="Rellene este campo" placeholder="dd-mm-yyyy" readonly>
            </div>
        </fieldset>
		<fieldset>
            <div class="form-group col-md-6">
                <label>Seleccione potrero: </label>
                <select class="form-control" name="potrero" id="potrero" data-validation="required" data-validation-error-msg="Seleccione potrero" onchange="lista_tablones($('#potrero').val())">
                    <option value="">Seleccione</option>
                    <?php foreach ($response_potrero['items'] as $key_potrero) { ?>
                    <option value="<?php echo $key_potrero['id']?>"><?php echo $key_potrero['nombre'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Seleccione tablones: </label>
                <select class="form-control" name="tablones[]" id="tablones"  multiple="true" data-placeholder="Seleccione tablones a usar" data-validation="required" data-validation-error-msg="rellene este campo" >
                </select>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group col-md-4">
                <label>Tipo de cultivo: </label>
                <select class="form-control" name="cultivo" id="cultivo" data-validation="required" data-validation-error-msg="Rellene este campo" onchange="subtipo($('#cultivo').val())">
                    <option value="">Seleccione</option>
                    <?php foreach ($response_vegetacion['items'] as $key_vegetacion) { ?>
                    <option value="<?php echo $key_vegetacion['id']?>"><?php echo $key_vegetacion['nombre'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label>Sub&#45;Tipo de cultivo: </label>
                <select class="form-control" name="subtipo_cultivo" id="subtipo_cultivo" data-validation="required" data-validation-error-msg="Rellene este campo">
                	<option value="">Seleccione</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Bodega: </label>
                <select class="form-control" name="bodega" id="bodega" data-validation="required" data-validation-error-msg="Seleccione bodega">
                    <option value="">Seleccione</option>
                    <?php foreach ($response_bodega['items'] as $key_bodega) { ?>
                    <option value="<?php echo $key_bodega['codigo']?>"><?php echo $key_bodega['nombre'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Notas: </label>
                <textarea class="form-control" name="notas" id="notas" rows="7"></textarea>
            </div>
        </fieldset>
		<div class="box-footer">
			<button type="button" onClick="location.href='?mod=siembra'" class="btn btn-danger margin-right pull-left"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
		    <button type="reset" class="btn btn-success pull-left" id="limpiar"><i class="fa fa-eraser"></i>&nbsp;Limpiar</button>
		    <button type="submit" name="guardar" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa fa-save"></i>&nbsp;Guardar</button>
		</div>
	</form>
	</div>
	<!-- /.box-body -->
	</div>
</section>
<script type="text/javascript">
function subtipo(tipo){
    $.post("procesos/siembra/subtipo.php", 
        { "tipo": tipo }, 
        function(data){
        var data=JSON.parse(data);
        var resultado=data.items;
        var opciones='';
    	opciones+="<option value=''>Seleccione</option>";
        for(var i=0; i<data.total; i++){
            opciones+="<option value='"+resultado[i].id+"'>"+resultado[i].nombre+"</option>";
        }
        $('#subtipo_cultivo').html(opciones);
    });         
}

//Carga de combo select2 de tablones
$(document).ready(function(){
    lista_tablones();
});

function lista_tablones(id){
    $.post("procesos/siembra/lista_tablones.php", 
        { "id": id }, 
        function(data){
        var data=JSON.parse(data);
        var resultado=data.items;
        var opciones='';
        for(var i=0; i<data.total; i++){
            opciones+="<option value='"+resultado[i].id+"'>"+resultado[i].nombre+"</option>";
        }
        $('#tablones').html(opciones);
        $('#tablones').select2();
    });
}

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmproyecto').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "Json",
                    url: 'procesos/siembra/guardar_proyecto.php',
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