<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-paw"></i>&nbsp;Administraci&oacute;n de animales
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-paw"></i>&nbsp;Administraci&oacute;n de animales</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=canimales" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar animal</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tabla_animales" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      N&uacute;mero
                    </center></th>
                    <th><center>
                      Nombre
                    </center></th>
                    <th><center>
                      Sexo
                    </center></th>
                    <th><center>
                      Estado
                    </center></th>
                    <th><center>
                      Registro
                    </center></th>
                    <th><center>
                      Color
                    </center></th>
                    <th><center>
                      Procedencia
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_animales();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['numero'] ?></td>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td><?php echo $datos['sexo'] ?></td>
                    <td><?php echo $datos['estado'] ?></td>
                    <td><?php echo $datos['registro'] ?></td>
                    <td><?php echo $datos['color'] ?></td>
                    <td><?php echo $datos['procedencia'] ?></td>
                    <td><center>
                      <form action="?mod=manimales" method="POST">
                        <label class="btn btn-success" title="Informaci&oacute;n general" data-toggle="modal" data-target="#vista_animal" onclick="dgenerales('<?php echo $datos['id']?>','<?php echo $datos['nombre']?>')"><i class="fa white fa-eye"></i></label>
                        <input type="hidden" name="id_animal" value="<?php echo $datos['id']?>" readonly>
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
<!-- Ventana modal detalle de los animales -->
<div class="modal fade" id="vista_animal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detalle de animal:&nbsp;<span class="break"></span><label id="ianimal" style="color: #033FE7;"></label></h4>
      </div>
      <div class="modal-body">
            <!-- Custom Tabs -->
            <span><img src="" class="img-rounded" width="120" height="100"></span>
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Datos Generales</a></li>
                <li><a href="#tab_2" data-toggle="tab">Genealog&iacute;a</a></li>
                <li><a href="#tab_3" data-toggle="tab">Fenotipo</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <!-- /.col -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#tabla_animales").dataTable({                
      "sPaginationType": "full_numbers"
  });
});

function eliminar(id){
  $.confirm({title: 'Desea elminar el animal?', content:'', icon: 'fa fa-info-circle', 
        buttons: {
          Si: function () {
            close();
            $.ajax({
              type: 'POST',
              dataType: 'json',
              data: {'id_animal':id},
              url: "procesos/ganado/eliminar_animal.php",
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

function dgenerales(id, nombre){
  document.getElementById('ianimal').innerHTML = nombre;
  $.ajax({
    type: 'POST',
    data: {'id_animal': id},
    url: "procesos/ganado/detalle_general.php",
    success: function(datos){
      $("#vista_animal span img").attr('src','upload/ganado/'+$.trim(datos.split('|')[0]));
      $("#vista_animal #tab_1").html(datos.split('|')[1]);
      $("#vista_animal #tab_2").html(datos.split('|')[2]);
      $("#vista_animal #tab_3").html(datos.split('|')[3]);
    }
  });
}
</script>