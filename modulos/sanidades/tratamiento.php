<style type="text/css">
#uno {
  text-align: center;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-stethoscope"></i>&nbsp;Administraci&oacute;n de tratamientos m&eacute;dicos
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-stethoscope"></i>&nbsp;Administraci&oacute;n de tratamientos m&eacute;dicos</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=ctratamiento" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar tratamiento m&eacute;dico</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>Fecha</center></th>
                    <th><center>Animal</center></th>
                    <th><center>Productos</center></th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_tratamiento_medico();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['animal'] ?></td>
                    <td><a name="detalle" style="color: #0629F6;" id="detalle_proyecto" data-toggle='modal' data-target="#modal_tratamiento" title="Productos de tratamiento medico" onclick="detalle_tratamiento('<?php echo $datos['id']?>');">Productos</a></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle tratamiento m&eacute;dico" data-toggle="modal" data-target="#itratamiento_medico" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
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