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
             <table role="grid" id="tabla_servicios" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
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
                      Padre
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
                        <label class="btn btn-success" title="Detalle de servicios" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
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
<script type="text/javascript">
$(document).ready(function(){
  $("#tabla_servicios").dataTable({                
      "sPaginationType": "full_numbers"
  });
});
</script>