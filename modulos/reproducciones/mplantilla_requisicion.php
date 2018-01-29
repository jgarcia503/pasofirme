<?php
if (isset($_POST['id_plantilla'])) {
$params = $_POST;
$response_productos=$data->query("SELECT * FROM productos");
?>
<style type="text/css">
#uno {
  text-align: center;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-edit"></i>&nbsp;Plantilla requisiciones servicios
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=plantilla_requisicion"><i class="fa fa-file-text-o"></i>&nbsp;Plantilla requisiciones servicios</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-edit"></i>&nbsp;Plantilla requisiciones servicios</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmplantillarequisicion" id="frmplantillarequisicion" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <input type="hidden" name="id_enc" id="id_enc" value="<?php echo $_POST['id_plantilla']?>" readonly>
              <fieldset>
                <div class="form-group col-md-4">
					<label>Producto</label>
					<select class="form-control" name="referencia" id="referencia" onchange="unidadstandar($('#referencia').val());">
						<option value="">Seleccion producto</option>
						<?php foreach ($response_productos['items'] as $key_productos) { ?>
						<option value="<?php echo $key_productos['referencia'].','.$key_productos['unidad_standar'] ?>"><?php echo $key_productos['nombre'] ?></option>
						<?php } ?>
					</select>
                </div>
                <div class="form-group col-md-3">
					<label>Cantidad</label>
					<input type="text" class="form-control" name="cantidad" id="cantidad">
                </div>
                <div class="form-group col-md-4">
					<label>Unidad</label>
					<select class="form-control" name="unidad" id="unidad">
						<option value="">Seleccione unidad</option>
					</select>
                </div>
                <div class="form-group col-md-1">
                  <label>Agregar</label>
                  <button type="button" class="btn btn-success" data-toggle="tooltip" title="Agregar" id="agregar"><i class="fa white fa-plus-square"></i></button>
                </div>
              </fieldset>
              <br>
              <fieldset class="form-group col-md-12">
                <div style="clear:both;"></div>
                <div class="table-responsive">
                  <table class='table table-condensed' style="margin-bottom:0;">
                  <thead>
                  <tr class="bg bg-navy">
                      <th width="25%"><center>Nombre</center></th>
                      <th width="25%"><center>Cantidad</center></th>
                      <th width="25%"><center>Unidad</center></th>
                      <th width="25%"><center>Acci&oacute;n</center></th>
                  </tr>
                  </thead>
                  </table>
                  <div style="height:350px; top: 0; overflow-y:scroll; overflow-x:hidden;">
                      <table class='table table-condensed' id="tabla_plantilla_requisiciones">
                      <tbody id="detalle_plantilla_requisicion">
                      </tbody>
                      </table>
                  </div>
                </div>
              </fieldset>
              <div class="box-footer">
                <button type="button" onClick="location.href='?mod=plantilla_requisicion'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
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
function unidadstandar(producto){
	var unidad = producto.split(',');
	var ustandar = unidad[1];
	if (ustandar == 'kg') {
		$('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>,"
	        +"<option value='qq'>Quintal</option>,"
	        +"<option value='g'>Gramos</option>,"
	        +"<option value='kg'>Kilogramos</option>,"
	        +"<option value='oz'>Onzas</option>,"
	        +"<option value='lb'>Libras</option>");	
	}else if (ustandar == 'lt') {
		$('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>,"
	        +"<option value='lt'>Litros</option>,"
	        +"<option value='ml'>Mililitros</option>");
	}else if (ustandar == 'cc') {
		$('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>,"
        	+"<option value='cc'>Centimetros cubicos</option>");
	}else if (ustandar == 'unidad') {
		$('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>,"
        	+"<option value='unidad'>Unidad</option>");
	}else{
        $('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>");
    }
}

$(document).ready(function(){
	$.ajax({
      url: 'procesos/reproduccion/mostrar_plantilla_requisicion.php',
      type: 'POST',
      dataType: 'json',
      data: {"id": $("#id_enc").val()}
  	}).done(function(data){
        if (data.success == true) {
            total=data.items.length;
            var datos=data.items;
            var opciones;
            if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td id='uno' width='25%'>"+datos[i].nombre+"</td>"
                                 +"<td id='uno' width='25%'>"+datos[i].cantidad+"</td>"
                                 +"<td id='uno' width='25%'>"+datos[i].unidad+"</td>"
                                 +"<td id='uno' width='25%'><label class='btn btn-danger' onsubmit='return false' onClick=\"quitar('"+datos[i].nombre+"');\" title='Quitar'><i class='fa white fa-trash'></i></label></td></tr>";
                }
                $('#detalle_plantilla_requisicion').html(opciones);
            }
        }
    });
});

// Funcion que nos permite agregar los datos a la tabla
$("#agregar").on('click', function(){
	var referencia = $("#referencia").val();
	var preferencia = referencia.split(',');
	var producto = preferencia[0];
	var nombre_producto = document.getElementById('referencia').options[document.getElementById('referencia').selectedIndex].text;
	var cantidad = $("#cantidad").val();
	var unidad = $("#unidad").val();
	$.ajax({
	  url: "procesos/reproduccion/modificar_detalle_plantilla_requisicion.php",
	  type: "POST",
	  dataType: "json",
	  data: {'producto':producto,'nombre_producto':nombre_producto,'cantidad':cantidad,'unidad':unidad,'id_enc':$("#id_prequisicion").val()}
	}).done(function(data){
	  if (data.success == true) {
	      total=data.items.length;
	      var datos=data.items;
	      var opciones;
	      if(total>0){
	          for(var i=0; i<total; i++){
	              opciones+="<tr><td id='uno' width='25%'>"+datos[i].nombre+"</td>"
	                           +"<td id='uno' width='25%'>"+datos[i].cantidad+"</td>"
	                           +"<td id='uno' width='25%'>"+datos[i].unidad+"</td>"
	                           +"<td id='uno' width='25%'><label class='btn btn-danger' onsubmit='return false' onClick=\"quitar('"+datos[i].nombre+"');\" title='Quitar'><i class='fa white fa-trash'></i></label></td></tr>";
	          }
	          $("#agregar").blur();
	          $('#detalle_plantilla_requisicion').html(opciones);
	          $("[name=referencia],[name=cantidad],[name=unidad]").val('');
	      }
	  }
	});
});

// quitar articulos de tabla
function quitar(nombre){
    if(nombre!=""){
        $.ajax({
            url: "procesos/reproduccion/quitar_detalle_plantilla_requisicion.php",
            type: "POST",
            dataType: "json",
            data: {"nombre": nombre}
        }).done(function(response){
            $("#detalle_plantilla_requisicion").html("");
            var data=response.items;
            $.each(data, function(index, value){
              $("#detalle_plantilla_requisicion").append("<tr><td id='uno' width='25%'>"+value.nombre+"</td>"
                                                  +"<td id='uno' width='25%'>"+value.cantidad+"</td>"
                                                  +"<td id='uno' width='25%'>"+value.unidad+"</td>"
                                                  +"<td id='uno' width='25%'><label class='btn btn-danger' onsubmit='return false' onClick=\"quitar('"+value.nombre+"');\" title='Quitar'><i class='fa white fa-trash'></i></label></td></tr>");
            });
        });
    }
}

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
        onSuccess: function(form){
          if ($("#tabla_plantilla_requisiciones tr td").length > 0) {
            var formulario = document.getElementById("frmplantillarequisicion");
            var formData = new FormData(formulario);
            $.ajax({
                url: "procesos/reproduccion/modificar_plantilla_requisicion.php",
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
          }else{
            $("#guardar").blur();
            $.confirm({icon:'fa fa-warning', title:'Error', content:'La tabla no puede estar vacía', type:'orange', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
          }
        }
    });
});
</script>
<?php
}else{
	header('Location:?mod=error');
}
?>