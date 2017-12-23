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
                      <label class="btn btn-success" title="Informaci&oacute;n general"><i class="fa white fa-eye"></i></label>
                      <a href="#" class="btn btn-primary" title="Actualizar informaci&oacute;n"><i class="fa white fa-edit"></i></a>
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
</script>