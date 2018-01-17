<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-ils"></i>&nbsp;Administraci&oacute;n de palpaciones
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-ils"></i>&nbsp;Administraci&oacute;n de palpaciones</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=cpalpaciones" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar palpaciones</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>Fecha</center></th>
                    <th><center>Animal</center></th>
                    <th><center>Resultado</center></th>
                    <th><center>Palpador</center></th>
                    <th><center>D&iacute;as Pre&ntilde;ez</center></th>
                    <th><center>Pre&ntilde;ada</center></th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_palpaciones();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['animal'] ?></td>
                    <td><?php echo $datos['resultado'] ?></td>
                    <td><?php echo $datos['palpador'] ?></td>
                    <td><?php echo $datos['dias_prenez'] ?></td>
                    <td><?php echo $datos['prenada'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle de servicios" data-toggle="modal" data-target="#detalle_palpacion" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
                      <label class="btn btn-danger" title="Eliminar" onclick="eliminar('<?php echo $datos['id']?>')"><i class="fa white fa-trash"></i></label>
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
<div class="modal fade" id="detalle_palpacion" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n de Palpaci&oacute;n</h4>
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
            <label>Pre&ntilde;ada</label>
            <input type="text" class="form-control" id="prenada" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-7">
            <label>Resultado</label>
            <input type="text" class="form-control" id="resultado" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Palpador</label>
            <input type="text" class="form-control" id="palpador" readonly>
          </div>
          <div class="form-group col-md-2">
            <label>D&iacute;as Pre&ntilde;ez</label>
            <input type="text" class="form-control" id="prenez" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-4">
            <label>Cuerno</label>
            <input type="text" class="form-control" id="cuerno" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Nivel de suciedad</label>
            <input type="text" class="form-control" id="nsuciedad" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Meses de pre&ntilde;ez</label>
            <input type="text" class="form-control" id="meses" readonly>
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
  $.post("procesos/reproduccion/detalle_palpacion.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('fecha').value=resultado[0].fecha;
      document.getElementById('hora').value=resultado[0].hora;
      document.getElementById('animal').value=resultado[0].animal;
      document.getElementById('resultado').value=resultado[0].resultado;
      document.getElementById('palpador').value=resultado[0].palpador;
      document.getElementById('prenez').value=resultado[0].dias_prenez;
      document.getElementById('prenada').value=resultado[0].prenada;
      document.getElementById('cuerno').value=resultado[0].cuerno;
      document.getElementById('nsuciedad').value=resultado[0].nivel_suciedad;
      document.getElementById('meses').value=resultado[0].meses_prenez;
      document.getElementById('notas').value=resultado[0].notas;
  });
}

function eliminar(id){
  $.confirm({title: 'Desea elminar la palpación?', content:'', icon: 'fa fa-info-circle', 
    buttons: {
      Si: function () {
        close();
        $.ajax({
          type: 'POST',
          dataType: 'json',
          data: {'id':id},
          url: "procesos/reproduccion/eliminar_palpacion.php",
          beforeSend: function(){
            $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
          },
          success: function(response){
            if (response.success == true) {
              $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href='?mod=palpaciones'}}}});
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