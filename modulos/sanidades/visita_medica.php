<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-user-md"></i>&nbsp;Visitas m&eacute;dicas
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-user-md"></i>&nbsp;Visitas m&eacute;dicas</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=cvisita_medica" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar visita m&eacute;dica</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>Fecha</center></th>
                    <th><center>Tipo</center></th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_visita_medica();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['tipo_visita'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle de eventos" data-toggle="modal" data-target="#ieventos_sanitarios" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
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