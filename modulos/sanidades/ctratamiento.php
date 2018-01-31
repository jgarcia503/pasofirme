<?php
$response_animales=$data->query("SELECT * FROM animales");
$response_productos=$data->query("SELECT a.referencia, a.nombre, b.existencia, a.unidad_standar FROM existencias b INNER JOIN productos a ON a.referencia=b.codigo_producto WHERE b.codigo_bodega = '2'");
?>
<style type="text/css">
#uno {
  text-align: center;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear tratamiento m&eacute;dico
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=tratamiento"><i class="fa fa-stethoscope"></i>&nbsp;Administraci&oacute;n de tratamientos m&eacute;dicos</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear tratamiento m&eacute;dico</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
        <form action="" role="form" name="frmctratamiento" id="frmctratamiento" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-4">
              <label>Fecha: </label>
              <input type="text" class="form-control" data-provide="datepicker" name="fecha" id="fecha" readonly placeholder="dd-mm-yyyy">
            </div>
            <div class="form-group col-md-4">
              <label>Tipo tratamiento: </label>
              <select class="form-control" name="tipo" id="tipo">
                <option value="">Seleccione tratamiento</option>
                <option value="receta medica">Tratamiento por receta medica</option>
                <option value="eventual">Tratamiento eventual</option>
                <option value="rutinario">Tratamiento rutinario</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>Animal: </label>
              <select class="form-control" name="animal" id="animal">
                <option value="">Seleccione animal</option>
                <?php foreach ($response_animales['items'] as $key_animales) { ?>
                <option value="<?php echo $key_animales['numero'] ?>-<?php echo $key_animales['nombre']?>"><?php echo $key_animales['numero'] ?>-<?php echo $key_animales['nombre']?></option>
                <?php } ?>
              </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Descripci&oacute;n tratamiento: </label>
              <textarea type="text" rows="2" class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>
          </fieldset>
          <br>
          <fieldset>
            <div class="form-group col-md-3">
              <label>Producto: </label>
              <select class="form-control" name="producto" id="producto">
                <option value="">Seleccione producto</option>
                <?php foreach ($response_productos['items'] as $key_productos) { ?>
                <option value="<?php echo $key_productos['referencia'] ?>" data-unidad="<?php echo $key_productos['unidad_standar'] ?>" data-existencia="<?php echo $key_productos['existencia'] ?>" data-nombre="<?php echo $key_productos['nombre'] ?>"><?php echo $key_productos['referencia'] ?>-<?php echo $key_productos['nombre'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group col-md-1">
              <label>Cantidad: </label>
              <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="0.00">
            </div>
            <div class="form-group col-md-2">
              <label>Desde: </label>
              <input type="text" class="form-control" data-provide="datepicker" name="desde" id="desde" placeholder="dd-mm-yyyy" readonly>
            </div>
            <div class="form-group col-md-2">
              <label>Hasta: </label>
              <input type="text" class="form-control" data-provide="datepicker" name="hasta" id="hasta" placeholder="dd-mm-yyyy" readonly>
            </div>
            <div class="form-group col-md-1">
              <label>Medida: </label>
              <input type="text" class="form-control" name="medida" id="medida" placeholder="" readonly>
            </div>
            <div class="form-group col-md-2">
              <label>Veces x d&iacute;a: </label>
              <input type="text" class="form-control" name="vecesxdia" id="vecesxdia" placeholder="0.00">
            </div>
            <div class="form-group col-md-1">
              <label>Agregar</label>
              <button type="button" class="btn btn-success" title="Agregar" id="agregar"><i class="fa white fa-plus-square"></i></button>
            </div>
          </fieldset>
          <fieldset class="form-group">
            <div style="clear:both;"></div>
            <div class="table-responsive">
              <table class='table table-condensed' style="margin-bottom:0;">
              <thead>
              <tr class="bg bg-navy">
                <th width="23%"><center>Producto</center></th>
                <th width="13%"><center>Cantidad</center></th>
                <th width="14%"><center>Desde</center></th>
                <th width="14%"><center>Hasta</center></th>
                <th width="13%"><center>Medida</center></th>
                <th width="13%"><center>Veces</center></th>
                <th width="10%"><center>Acci&oacute;n</center></th>
              </tr>
              </thead>
              </table>
              <div style="height:200px; top: 0; overflow-y:scroll; overflow-x:hidden;">
                <table class='table table-condensed table-bordered' id="tabla_tratamiento_prueba">
                <tbody id="detalle_tratamiento_medico">
                </tbody>
                </table>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas</label>
              <textarea name="notas" class="form-control" rows="4"></textarea>
            </div>
          </fieldset>
        <div class="box-footer">
          <button type="button" onClick="location.href='?mod=cosechas'" class="btn btn-danger margin-right pull-left"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
          <button type="reset" class="btn btn-success pull-left" id="limpiar"><i class="fa fa-eraser"></i>&nbsp;Limpiar</button>
          <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa fa-save"></i>&nbsp;Guardar</button>
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
$('[name=producto]').on('change',function(){
  var unidad=$(this).find('option:selected').data('unidad');    
  $('[name=medida]').val(unidad);    
});

$("#agregar").on('click', function() {
  var disponible = $("[name=producto]").find('option:selected').data('existencia');
  var nproducto = $("[name=producto]").find('option:selected').data('nombre');
  var producto = $("[name=producto]").val();
  var cantidad = $("[name=cantidad]").val();
  var desde = $("[name=desde]").val();
  var hasta = $("[name=hasta]").val();
  var medida = $("[name=medida]").val();
  var vecesxdia = $("[name=vecesxdia]").val();
  if (producto==='' || cantidad==='' || desde==='' || hasta==='' || medida==='' || vecesxdia==='') {
    $.confirm({icon:'fa fa-warning', title:'Advertencia', content:'Complete todos los campos', type:'orange', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-orange', action: function(){close();}}}});
  }else{
    var f1 =moment(desde, 'DD-MM-YYYY');
    var f2 =moment(hasta, 'DD-MM-YYYY');
    var dias = parseInt(f2.diff(f1,'days'));
    if (disponible < (cantidad*vecesxdia*dias)) {
      $.confirm({icon:'fa fa-warning', title:'Advertencia', content:'Cantidad insuficiente, en existencia hay <strong>'+disponible+'</strong>', type:'orange', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-orange', action: function(){close();}}}});
    }else{
      $.ajax({
        url: "procesos/sanidad/agregar_tratamiento_medico.php",
        type: "POST",
        dataType: "json",
        data: {'producto':producto,'nproducto':nproducto,'cantidad':cantidad,'desde':desde,'hasta':hasta,'medida':medida,'vecesxdia':vecesxdia}
      }).done(function(data){
        if (data.success == true) {
          total=data.items.length;
          var datos=data.items;
          var opciones;
          if(total>0){
            for(var i=0; i<total; i++){
                opciones+="<tr><td width='23%' id='uno'>"+datos[i].nproducto+"</td>"
                        +"<td width='13%' id='uno'>"+datos[i].cantidad+"</td>"
                        +"<td width='14%' id='uno'>"+datos[i].desde+"</td>"
                        +"<td width='14%' id='uno'>"+datos[i].hasta+"</td>"
                        +"<td width='13%' id='uno'>"+datos[i].medida+"</td>"
                        +"<td width='13%' id='uno'>"+datos[i].vecesxdia+"</td>"
                        +"<td width='10%' id='uno'><a class='label label-danger' onsubmit='return false' onClick=\"quitar('"+datos[i].referencia+"');\" title='Quitar'><i class='fa white fa-trash'></i></a></td></tr>";
            }
            $('#detalle_tratamiento_medico').html(opciones);
            $("#agregar").blur();
            $("[name=producto],[name=cantidad],[name=desde],[name=hasta],[name=medida],[name=vecesxdia]").val('');
          }
        }else{
          $("#agregar").blur();
          $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Error al cargar los datos', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
        }
      });
    }
  }
});

//quita articulos de tabla
function quitar(referencia){
    if(referencia!=""){
        $.ajax({
            url: "procesos/sanidad/quitar_tratamiento_medico.php",
            type: "POST",
            dataType: "json",
            data: {'referencia': referencia}
        }).done(function(data){
            total=data.length;
            var opciones;
            if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td width='23%' id='uno'>"+data[i].nproducto+"</td>"
                            +"<td width='13%' id='uno'>"+data[i].cantidad+"</td>"
                            +"<td width='14%' id='uno'>"+data[i].desde+"</td>"
                            +"<td width='14%' id='uno'>"+data[i].hasta+"</td>"
                            +"<td width='13%' id='uno'>"+data[i].medida+"</td>"
                            +"<td width='13%' id='uno'>"+data[i].vecesxdia+"</td>"
                            +"<td width='10%' id='uno'><a class='label label-danger' onsubmit='return false' onClick=\"quitar('"+data[i].referencia+"');\" title='Quitar'><i class='fa white fa-trash'></i></a></td></tr>";
                }
                $('#detalle_tratamiento_medico').html(opciones);
            }else{
                $('#detalle_tratamiento_medico').html("");
            }
        });
    }
}

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
        onSuccess: function(form){
          if ($("#tabla_tratamiento_prueba tr td").length > 0) {
            var formulario = document.getElementById("frmctratamiento");
            var formData = new FormData(formulario);
            $.ajax({
                url: "procesos/sanidad/guardar_tratamiento_medico.php",
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
            $.confirm({icon:'fa fa-warning', title:'Error', content:'La tabla no puede estar vacía', type:'orange', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-orange', action: function(){close();}}}});
          }
        }
    });
});
</script>