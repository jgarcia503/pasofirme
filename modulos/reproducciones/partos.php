<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-stumbleupon-circle"></i>&nbsp;Administraci&oacute;n de partos
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-stumbleupon-circle"></i>&nbsp;Administraci&oacute;n de partos</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=cpartos" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar parto</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tablas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>Fecha</center></th>
                    <th><center>Hora</center></th>
                    <th><center>Animal</center></th>
                    <th><center>Cr&iacute;a</center></th>
                    <th><center>Empleado</center></th>
                    <th><center>Acciones</center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_partos();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['hora'] ?></td>
                    <td><?php echo $datos['animal'] ?></td>
                    <td><?php echo $datos['cria'] ?></td>
                    <td><?php echo $datos['contacto'] ?></td>
                    <td><center>
                        <label class="btn btn-success" title="Detalle de partos" data-toggle="modal" data-target="#info_partos" onclick="ver('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
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
<div class="modal fade" id="info_partos" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n partos</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <div class="form-group col-md-3">
            <label>Fecha</label>
            <input type="text" id="ifecha" class="form-control" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Animal</label>
            <input type="text" id="ianimal" class="form-control" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Cr&iacute;a</label>
            <input type="text" id="icria" class="form-control" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Hora</label>
            <input type="text" id="ihora" class="form-control" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-4">
            <label>Estado</label>
            <input type="text" id="iestado" class="form-control" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Sexo cr&iacute;a</label>
            <input type="text" id="isexo" class="form-control" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Empleado</label>
            <input type="text" id="iempleado" class="form-control" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-12">
            <label>Notas</label>
            <textarea id="inotas" class="form-control" rows="4" readonly></textarea>
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
  $.post("procesos/reproduccion/detalle_partos.php",
    {'id':id},
    function(data){
      var data=JSON.parse(data);
      var resultado=data.items;
      document.getElementById('ifecha').value=resultado[0].fecha;
      document.getElementById('ianimal').value=resultado[0].animal;
      document.getElementById('icria').value=resultado[0].cria;
      document.getElementById('ihora').value=resultado[0].hora;
      document.getElementById('iestado').value=resultado[0].estado;
      document.getElementById('iempleado').value=resultado[0].contacto;
      document.getElementById('isexo').value=resultado[0].sexo_cria;
      document.getElementById('inotas').value=resultado[0].notas;
  });
}
</script>