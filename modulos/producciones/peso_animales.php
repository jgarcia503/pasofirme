<style type="text/css">
#uno {
  text-align: center;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-balance-scale"></i>&nbsp;Administraci&oacute;n peso del animal
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-balance-scale"></i>&nbsp;Administraci&oacute;n peso del animal</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=cpanimal" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar peso del animal</a></h5>
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
                      Empleado
                    </center></th>
                    <th><center>
                      Peso de animales
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_peso_animal();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['empleado'] ?></td>
                    <td id="uno"><label data-toggle="modal" data-target="#peso_animales" onclick="ver('<?php echo $datos['id']?>')" style="color: #1930FF;">Animales</label></td>
                    <td><center>
                      <form action="?mod=mpeso_animal" method="POST">
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
<!-- Ventana modal para crear raza -->
<div class="modal fade" id="peso_animales" style="display: none;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Peso de animales</h4>
      </div>
      <div class="modal-body">
        <table role="grid" class="table table-condensed">
           <thead>
              <tr class="bg bg-info">
                <th><center>
                  N&uacute;mero
                </center></th>
                <th><center>
                  Nombre
                </center></th>
                <th><center>
                  Peso
                </center></th>
              </tr>
           </thead>
           <tbody id="detalle_peso_animal">
           </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
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

// Muestra el precion del tablon
function ver(id){
    $.ajax({
      url : 'procesos/produccion/listar_peso_animales.php',
      type: 'POST',
      data: {'id_peso':id},
      dataType: 'json',
      success: function(response){
        var opciones;
        if(response.success){
          $('#detalle_peso_animal tr').remove();
          $.each(response.items, function(index, value){
            opciones+="<tr><td>"+value.numero+"</td>"
                         +"<td>"+value.nombre+"</td>"
                         +"<td>"+value.peso+"</td>"
                    +"</tr>";
          });
          $('#detalle_peso_animal').html(opciones);
        }else{
          alert(response.error);
        }
      },
      error: function(){
        alert('hubo un error al ejecutar la accion');
      }
  });
}
</script>