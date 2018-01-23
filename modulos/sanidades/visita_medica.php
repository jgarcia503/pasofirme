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
                      <label class="btn btn-success" title="Detalle de visita m&eacute;mida" data-toggle="modal" data-target="#idetalle_visitamedica" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
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
<div class="modal fade" id="idetalle_visitamedica" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n de evento sanitario</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <div class="form-group col-md-12">
            <label>Tratamiento</label>
            <textarea name="inotas" id="inotas" rows="30" class="form-control" readonly style="text-align: justify;"></textarea>
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
  $.post("procesos/sanidad/detalle_visita_medica.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('inotas').value = resultado[0].descripcion;
  });
}
</script>