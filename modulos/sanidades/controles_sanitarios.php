<?php
$response_animales=$data->query("SELECT CONCAT(numero,'-',nombre) animales FROM animales");
$response_empleado=$data->query("SELECT nombre FROM contactos WHERE tipo='empleado'");
$response_eventos=$data->query("SELECT * FROM eventos_sanitarios");
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-yelp"></i>&nbsp;Administraci&oacute;n de controles sanitarios
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-yelp"></i>&nbsp;Administraci&oacute;n de controles sanitarios</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><label data-toggle="modal" data-target="#ccontroles_sanitarios"><i class="fa fa-plus-circle"></i>&nbsp;Ingresar control sanitario</label></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>Animal</center></th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_controles_sanitarios();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['animal'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle de control sanitario" data-toggle="modal" data-target="#info_controles_sanitarios" onclick="ver('<?php echo $datos['animal']?>')"><i class="fa white fa-eye"></i></label>
                    </center></td>
                  </tr>
                <?php } ?>
               </tbody>
            </table>
         </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="info_controles_sanitarios" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Registro sanitario de&nbsp;<span class="break"></span><label id="control_sanitario" style="color: #033FE7;"></label></h4>
      </div>
      <div class="modal-body">
        <table role="grid" id="tabla_control_sanitario" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
           <thead>
              <tr class="bg bg-info">
                <th>Fecha</th>
                <th>Hora</th>
                <th>Evento</th>
                <th>Realizado por</th>
              </tr>
           </thead>
           <tbody id="detalle_control_sanitario">
           </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="ccontroles_sanitarios" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear control sanitario</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmccontrolsanitario" id="frmccontrolsanitario" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-4">
              <label>Fecha</label>
              <input type="text" name="fecha" class="form-control datepicker" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
            </div>
            <div class="form-group col-md-4">
              <label>Hora</label>
              <input type="text" name="hora" class="form-control timepicker" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-4">
              <label>Evento</label>
              <select class="form-control" name="evento" id="evento" data-validation="required" data-validation-error-msg="Seleccione evento">
                <option value="">Seleccione evento</option>
                <?php foreach ($response_eventos['items'] as $key_eventos) { ?>
                <option value="<?php echo $key_eventos['nombre'] ?>"><?php echo $key_eventos['nombre'] ?></option>
                <?php } ?>
              </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-6">
              <label>Animal</label>
              <input type="text" class="form-control awesomplete" name="animal" id="animal" list="animales" data-minchars="1">
              <datalist id="animales">
                <?php foreach ($response_animales['items'] as $key_animales) { ?>
                <option value="<?php echo $key_animales['animales'] ?>"><?php echo $key_animales['animales'] ?></option>
                <?php } ?>
              </datalist>
            </div>
            <div class="form-group col-md-6">
              <label>Empleado</label>
              <select class="form-control" name="empleado" id="empleado" data-validation="required" data-validation-error-msg="Seleccione empleado">
                <option value="">Seleccione empleado</option>
                <?php foreach ($response_empleado['items'] as $key_empleado) { ?>
                <option value="<?php echo $key_empleado['nombre'] ?>"><?php echo $key_empleado['nombre'] ?></option>
                <?php } ?>
              </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas</label>
              <textarea name="notas" rows="5" class="form-control"></textarea>
            </div>
          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
        <button type="submit" id="guardar" name="guardar" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
function ver(id){
    $.ajax({
      url : 'procesos/sanidad/listar_control_sanitario.php',
      type: 'POST',
      data: {'id':id},
      dataType: 'json',
      success: function(response){
        if(response.success){
          $("#tabla_control_sanitario").DataTable().clear();
          $("#tabla_control_sanitario").DataTable().destroy();
          $.each(response.items, function(index, value){
            $("#detalle_control_sanitario").append("<tr><td>"+value.fecha+"</td>"
                                                      +"<td>"+value.hora+"</td>"
                                                      +"<td>"+value.evento+"</td>"
                                                      +"<td>"+value.empleado+"</td>"
                                                  +"</tr>");
          });
          document.getElementById('control_sanitario').innerHTML=id;
        }else{
          $.confirm({icon: 'fa fa-exclamation', title: '', content: 'response.error', type: 'orange', typeAnimated: true, buttons: { tryAgain: { text: 'Cerrar', btnClass: 'btn-warning', action: function(){close();}}}});
        }
        $("#tabla_control_sanitario").dataTable({
          "sPaginationType": "full_numbers"
        });
      },
      error: function(){
        $.confirm({icon: 'fa fa-exclamation', title: 'Hubo un error al ejecutar la acción', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Cerrar', btnClass: 'btn-danger', action: function(){close();}}}});
      }
  });
}

var animaleslist=Array();
$("#animales option").each(function(index,elem){
  animaleslist.push(elem.innerHTML);
});
//Guardar datos a la BD
$('#guardar').click(function () {
  if (animaleslist.indexOf($("[name=animal]").val())===-1) {
    $.confirm({icon:'fa fa-exclamation', title:'Error', content:'No es un animal de la lista', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
  }else{
    $.validate({
       onSuccess : function(form) {
          var formulario = $('#frmccontrolsanitario').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/sanidad/guardar_control_sanitario.php',
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
  }
});
</script>