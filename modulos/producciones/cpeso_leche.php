<?php
$response_empleados=$data->query("SELECT nombre FROM contactos WHERE tipo='empleado'", array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear peso de leche
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=peso_leche"><i class="fa fa-balance-scale"></i>&nbsp;Administraci&oacute;n peso de leche</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear peso de leche</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmpesoleche" id="frmpesoleche" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <fieldset>
                <div class="form-group col-md-6">
                  <label>Empleado</label>
                    <select class="form-control" name="empleado" id="empleado" data-validation="required" data-validation-error-msg="Seleccione empleado">
                      <option value="">Seleccione empleado</option>
                      <?php foreach ($response_empleados['items'] as $key_empleados) { ?>
                      <option value="<?php echo $key_empleados['nombre']?>"><?php echo $key_empleados['nombre']?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                  <label>Fecha</label>
                    <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-4">
                  <label>Animal</label>
                  <select class="form-control" name="animal" id="animal" data-validation="required" data-validation-error-msg="Seleccione animal">
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Botellas</label>
                    <input type="text" class="form-control" name="peso" id="peso" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-4">
                  <label>Hora</label>
                  <select class="form-control" name="hora" id="hora" data-validation="required" data-validation-error-msg="Seleccione hora">
                    <option value="">Seleccione hora</option>
                    <option value="manana">Ma&ntilde;ana</option>
                    <option value="medio dia">Medio d&iacute;a</option>
                    <option value="tarde">Tarde</option>
                    <option value="dia">D&iacute;a</option>
                  </select>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-12">
                  <label>Notas</label>
                  <textarea name="notas" class="form-control" rows="7"></textarea>
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
$(document).ready(function () {
    $.post("procesos/produccion/listar_animales.php", 
        function(data){
        var data=JSON.parse(data);
        var resultado=data.items;
        var total=resultado.length;
        var opciones='<option value="">Seleccione una opcion</option>';
        for(var i=0; i<total; i++){
            opciones+="<option value='"+resultado[i].numero+"-"+resultado[i].nombre+"'>"+resultado[i].numero+"-"+resultado[i].nombre+"</option>";
        }
        $('#animal').html(opciones);
    });         
});

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
       onSuccess : function(form) {
          var formulario = $('#frmpesoleche').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/produccion/guardar_peso_leche.php',
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