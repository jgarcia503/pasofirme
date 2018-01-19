<?php
$response_animales=$data->query("SELECT CONCAT(numero,' ',nombre) animales FROM animales WHERE numero||' '||nombre NOT IN (SELECT animal FROM mortalidades)");
$response_causa=$data->query("SELECT * FROM causas_mortalidades");
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-warning"></i>&nbsp;Administraci&oacute;n de mortalidades
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-warning"></i>&nbsp;Administraci&oacute;n de mortalidades</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><label data-toggle="modal" data-target="#cmortalidad"><i class="fa fa-plus-circle"></i>&nbsp;Ingresar mortalidad</label></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Fecha
                    </center></th>
                    <th><center>
                      Hora
                    </center></th>
                    <th><center>
                      Animal
                    </center></th>
                    <th><center>
                      Causa
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_mortalidad();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['hora'] ?></td>
                    <td><?php echo $datos['animal'] ?></td>
                    <td><?php echo $datos['causa'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle de servicios" data-toggle="modal" data-target="#infor_mortalidad" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
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
<div class="modal fade" id="cmortalidad" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Crear resultado de palpaciones</h4>
      </div>
      <div class="modal-body">
        <form role="form" name="frmcmortalidad" id="frmcmortalidad" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-6">
              <label>Fecha</label>
              <input type="text" name="fecha" class="form-control datepicker" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Hora</label>
              <input type="text" name="hora" class="form-control timepicker" data-validation="required" data-validation-error-msg="Complete este campo">
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
              <label>Causa</label>
              <select class="form-control" name="causa" id="causa" data-validation="required" data-validation-error-msg="Seleccione causa">
                <option value="">Seleccione causa</option>
                <?php foreach ($response_causa['items'] as $key_causa) { ?>
                <option value="<?php echo $key_causa['nombre'] ?>"><?php echo $key_causa['nombre'] ?></option>
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
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="infor_mortalidad" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n de Mortalidad</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <div class="form-group col-md-6">
            <label>Fecha</label>
            <input type="text" class="form-control" id="ifecha" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Hora</label>
            <input type="text" class="form-control" id="ihora" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-6">
            <label>Animal</label>
            <input type="text" class="form-control" id="ianimal" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Causa</label>
            <input type="text" class="form-control" id="icausa" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-12">
            <label>Notas</label>
            <textarea class="form-control" id="inotas" rows="5" readonly></textarea>
          </div>
        </fieldset>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
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
          var formulario = $('#frmcmortalidad').serializeArray();
          $.ajax({
              data: formulario,
              type: 'POST',
              dataType: "Json",
              url: 'procesos/mortalidad/guardar_mortalidad.php',
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

function ver(id){
  $.post("procesos/mortalidad/detalle_mortalidad.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('ifecha').value = resultado[0].fecha;
      document.getElementById('ihora').value = resultado[0].hora;
      document.getElementById('ianimal').value = resultado[0].animal;
      document.getElementById('icausa').value = resultado[0].causa;
      document.getElementById('inotas').value = resultado[0].notas;
    });
}
</script>