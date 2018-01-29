<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-file-text-o"></i>&nbsp;Plantilla requisiciones servicios
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-file-text-o"></i>&nbsp;Plantilla requisiciones servicios</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>Nombre</center></th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_plantilla_requisicion();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['nombre'] ?></td>
                    <td><center>
                      <form action="?mod=mplantilla_requisicion" method="POST">
                        <label class="btn btn-success" title="Detalle de palpaciones" data-toggle="modal" data-target="#info_plantilla" onclick="ver('<?php echo $datos['id']?>', '<?php echo $datos['nombre']?>')"><i class="fa white fa-eye"></i></label>
                        <input type="hidden" name="id_plantilla" value="<?php echo $datos['id']?>" readonly>
                        <button type="submit" class="btn btn-primary" title="Actualizar informaci&oacute;n"><i class="fa white fa-edit"></i></button>
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
<div class="modal fade" id="info_plantilla" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Productos de&#58;&nbsp;<span class="break"></span><label id="plantilla" style="color: #033FE7;"></label></h4>
      </div>
      <div class="modal-body">
        <table role="grid" class="table table-condensed table-bordered table-responsive">
           <thead>
              <tr class="bg bg-info">
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Unidad</th>
              </tr>
           </thead>
           <tbody id="detalle_productos_plantilla">
           </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
// Muestra el precion del tablon
function ver(id, nombre){
    $.ajax({
      url : 'procesos/reproduccion/listar_productos_plantilla.php',
      type: 'POST',
      data: {'id':id},
      dataType: 'json',
      success: function(response){
        var opciones;
        if(response.success){
          $('#detalle_productos_plantilla tr').remove();
          $.each(response.items, function(index, value){
            opciones+="<tr><td>"+value.nombre+"</td>"
                         +"<td>"+value.cantidad+"</td>"
                         +"<td>"+value.unidad+"</td>"
                     +"</tr>";
          });
          $('#detalle_productos_plantilla').html(opciones);
          document.getElementById('plantilla').innerHTML=nombre;
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