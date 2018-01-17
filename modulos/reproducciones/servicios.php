<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-joomla"></i>&nbsp;Administraci&oacute;n de servicios
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-joomla"></i>&nbsp;Administraci&oacute;n de sarvicios</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=cservicios" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar servicios</a></h5>
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
                      Tipo
                    </center></th>
                    <th><center>
                      Animal
                    </center></th>
                    <th><center>
                      Toro
                    </center></th>
                    <th><center>
                      Inseminador
                    </center></th>
                    <th><center>
                      Donadora
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_servicios();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['hora'] ?></td>
                    <td><?php echo $datos['tipo'] ?></td>
                    <td><?php echo $datos['animal'] ?></td>
                    <td><?php echo $datos['padre'] ?></td>
                    <td><?php echo $datos['inseminador'] ?></td>
                    <td><?php echo $datos['donadora'] ?></td>
                    <td><center>
                      <form action="?mod=mservicios" method="POST">
                        <label class="btn btn-success" title="Detalle de servicios" data-toggle="modal" data-target="#info_servicio" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
                        <input type="hidden" name="id_servicios" value="<?php echo $datos['id']?>" readonly>
                        <button type="submit" class="btn btn-primary" title="Actualizar informaci&oacute;n"><i class="fa white fa-edit"></i></button>
                        <label class="btn btn-danger" title="Eliminar" onclick="eliminar('<?php echo $datos['id']?>')"><i class="fa white fa-trash"></i></label>
                      </form>
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
<div class="modal fade" id="info_servicio" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n de Servicio</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <div class="form-group col-md-3">
            <label>Fecha</label>
            <input type="text" class="form-control" id="fecha" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Hora</label>
            <input type="text" class="form-control" id="hora" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Animal</label>
            <input type="text" class="form-control" id="animal" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Tipo</label>
            <input type="text" class="form-control" id="tipo" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-3">
            <label>Inseminador</label>
            <input type="text" class="form-control" id="inseminador" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Toro</label>
            <input type="text" class="form-control" id="padre" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Donadora</label>
            <input type="text" class="form-control" id="donadora" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>C&oacute;digo de Pajilla</label>
            <input type="text" class="form-control" id="pajilla" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-12">
            <label>Notas</label>
            <textarea class="form-control" id="notas" rows="5" readonly></textarea>
          </div>
        </fieldset>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
function ver(id){
  $.post("procesos/reproduccion/informacion_servicio.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('fecha').value=resultado[0].fecha;
      document.getElementById('hora').value=resultado[0].hora;
      document.getElementById('animal').value=resultado[0].animal;
      document.getElementById('tipo').value=resultado[0].tipo;
      document.getElementById('inseminador').value=resultado[0].inseminador;
      document.getElementById('padre').value=resultado[0].padre;
      document.getElementById('donadora').value=resultado[0].donadora;
      document.getElementById('pajilla').value=resultado[0].codigo_pajilla;
      document.getElementById('notas').value=resultado[0].notas;
    });
}

function eliminar(id){
  $.confirm({title: 'Desea elminar el servicio?', content:'', icon: 'fa fa-info-circle', 
    buttons: {
      Si: function () {
        close();
        $.ajax({
          type: 'POST',
          dataType: 'json',
          data: {'id_servicio':id},
          url: "procesos/reproduccion/eliminar_servicio.php",
          beforeSend: function(){
            $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
          },
          success: function(response){
            if (response.success == true) {
              $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href='?mod=vanimales'}}}});
            }else{
              $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
            }
          },
          error: function(){
            $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
          },
          complete: function(){
            $.unblockUI();
          }
        });
      }, No: function () {
        close();
      },
    }
  });
}
</script>