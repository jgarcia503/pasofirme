<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-leaf"></i>&nbsp;Administraci&oacute;n de proyectos
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-leaf"></i>&nbsp;Administraci&oacute;n de proyectos</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header">
          <h5><a href="?mod=cproyecto" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Crear proyecto siembra</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      N°
                    </center></th>
                    <th><center>
                      Nombre
                    </center></th>
                    <th><center>
                      Fecha inicio
                    </center></th>
                    <th><center>
                      Actividades
                    </center></th>
                    <th><center>
                      Finalizado
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $cont = 1;
                $response = $dataTable->obtener_siembras();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><center>
                        <?php echo $cont ?>
                    </center></td>
                    <td>
                        <?php echo $datos['nombre_proyecto']?>
                    </td>
                    <td><center>
                        <?php echo $datos['fecha_inicio'] ?>
                    </center></td>
                    <td ><center>
                        <!-- Evaluda el estado de las actividades depende del estado del proyecto -->
                        <?php if ($datos['cerrado'] == 'true') { ?>
                        <label class="label label-success">Actividades cerradas</label>
                        <?php } else { ?>
                        <!-- Lleva a la pantalla de ingreso de las actividades, envio de ID por formulario -->
                          <form action="?mod=actividades" method="POST">
                              <input type="hidden" name="proyecto_id" value="<?php echo $datos['id_proyecto'] ?>">
                              <button type="submit" class="btn btn-primary btn-xs" data-toggle='tooltip' title="Actividades sin cerrar">Actividades</button>
                          </form>
                        <?php } ?>
                    </center></td>
                    <td><center>
                        <!-- Evaluda el estado del proyecto si ha finalizado o no -->
                        <?php if ($datos['cerrado']=='false') { ?>
                        <input type="checkbox" class="flat-red" name="finalizado" id="finalizado" data-toggle='modal' data-target="#cerrar_proyecto" title="Proyecto sin cerrar" onclick="proyecto_cerrado('<?php echo $datos['id_proyecto']?>');">
                        <?php }else{ ?>
                        <i class="fa fa-check"></i>
                        <?php } ?>
                    </center></td>
                    <td><center>
                        <!-- Muestra la informacion del proyecto -->
                        <a name="detalle" style="color: #0629F6;" id="detalle_proyecto" data-toggle='modal' data-target="#modal_proyecto" title="Detalle del proyecto" onclick="detalle_siembra('<?php echo $datos['id_proyecto']?>');"><i class="fa fa-eye"></i></a>
                    </center></td>
                  </tr>
                  <?php  
                $cont ++;
                    } ?>
               </tbody>
            </table>
         </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<div class="form-group">
<!-- /.content -->
<!-- Venta modal para ver detalle del usuario -->
<div class="modal fade" id="cerrar_proyecto" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" name="frmcerrarproyecto" id="frmcerrarproyecto" onSubmit="return false">
          <input type="hidden" name="id_proyecto" id="id_proyecto" readonly>
        <fieldset>
            <legend style="color: #173BFF;">Desea cerrar &eacute;ste proyecto?</legend>
            <label style="width: 500px;">SI&nbsp;&nbsp;
                <input type='checkbox' name="proyecto" id="proyecto" data-validation="required" data-validation-error-msg="Seleccione este campo">
            </label>
        </fieldset>
        <br>
        <fieldset>
            <legend style="color: #173BFF;">Desea liberar el tabl&oacute;n?</legend>
            <label>SI&nbsp;&nbsp;
                <input type="radio" name="tablon" value="Si" data-validation="required" data-validation-error-msg="Seleccione Si o No">
            </label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label>NO&nbsp;&nbsp;
                <input type="radio" name="tablon" value="No">
            </label>
        </fieldset>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
        <button type="submit" id="cierre_proyecto" name="cierre_proyecto" class="btn btn-primary"><i class="fa fa-send"></i>&nbsp;Enviar</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Ventana modal detalle del proyecto -->
<div class="modal fade" id="modal_proyecto" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Detalle de proyecto</h4>
      </div>
      <div class="modal-body">
        <fieldset>
            <div class="form-group col-md-4">
                <label>Nombre proyecto:</label>
                <input type="text" class="form-control" name="nproyecto" id="nproyecto" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Fecha de inicio:</label>
                <input type="text" class="form-control" name="fechainicio" id="fechainicio" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Proyecto cerrado:</label>
                <input type="text" class="form-control" name="pcerrado" id="pcerrado" readonly>
            </div>
        </fieldset>
        <br>
        <fieldset>
            <div class="form-group col-md-4">
                <label>Fecha de finalizaci&oacute;n:</label>
                <input type="text" class="form-control" name="fechafinalizacion" id="fechafinalizacion" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Nombre de tabl&oacute;n:</label>
                <input type="text" class="form-control" name="ntablones" id="ntablones" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Correlativo del proyecto:</label>
                <input type="text" class="form-control" name="corr_proyecto" id="corr_proyecto" readonly>
            </div>
        </fieldset>
        <br>
        <fieldset>
            <div class="form-group col-md-5">
                <label>Bodega seleccionada:</label>
                <input type="text" class="form-control" name="bseleccionada" id="bseleccionada" readonly>
            </div>
            <div class="form-group col-md-7">
                <label>Tipo de cultivo:</label>
                <input type="text" class="form-control" name="tcultivo" id="tcultivo" readonly>
            </div>
        </fieldset>
        <br>
        <fieldset>
            <div class="form-group col-md-12">
                <label>Notas: </label>
                <textarea class="form-control" name="notas" id="notas" rows="5" readonly></textarea>
            </div>
        </fieldset>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('#cerrar_proyecto').on('hidden.bs.modal', function (e) {
    $('input[name=finalizado]').prop('checked', false);
    document.form.checkbox.blur();
  });
  $('#modal_proyecto').on('hidden.bs.modal', function (e) {
      $('[name=detalle]').blur();
    });
});

function detalle_siembra(id) {
  $.post("procesos/siembra/detalle_siembra.php", 
        { "proyecto_id": id }, 
        function(data){
        var data=JSON.parse(data);
        var resultado=data.items;
        document.getElementById('nproyecto').value = resultado[0].nombre_proyecto;
        document.getElementById('fechainicio').value = resultado[0].fecha_inicio;
        document.getElementById('pcerrado').value = resultado[0].cerrado;
        document.getElementById('fechafinalizacion').value = resultado[0].fecha_fin;
        document.getElementById('ntablones').value = resultado[0].nombre;
        document.getElementById('corr_proyecto').value = resultado[0].correlativo_proyecto;
        document.getElementById('bseleccionada').value = resultado[0].bodega_seleccionada+'-'+resultado[0].nombre_bodega;
        document.getElementById('tcultivo').value = resultado[0].tipo_cultivo+'-'+resultado[0].nombre_vegetacion;
        document.getElementById('notas').value = resultado[0].notas;
    });
} /*Muestra la informacion del proyecto*/

function proyecto_cerrado(id) {
    document.getElementById('id_proyecto').value = id;
} /*Muestra la informacion del proyecto*/

/*Ejecuta las consultas para el cierre del proyecto*/
$('#cierre_proyecto').click(function () {
    $.validate({
       onSuccess : function(form) {
            var formulario = $('#frmcerrarproyecto').serializeArray();
            $.ajax({
                data: formulario,
                type: 'POST',
                dataType: "Json",
                url: 'procesos/siembra/cerrar_proyecto.php',
                beforeSend: function () {
                    $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                },
                success: function(response){
                    if (response.success == true) {
                        $('#cerrar_proyecto').modal('hide');
                        $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload(); }}}});
                    }else{
                        $('#cerrar_proyecto').modal('hide');
                        $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload();}}}});
                    }
                },
                error: function() {
                    $('#cerrar_proyecto').modal('hide');
                    $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload();}}}});
                },
                complete: function() {
                    $.unblockUI();
                }
            });
        }
    });
});
</script>