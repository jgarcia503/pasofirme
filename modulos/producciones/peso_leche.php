<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-balance-scale"></i>&nbsp;Administraci&oacute;n peso de leche
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-balance-scale"></i>&nbsp;Administraci&oacute;n peso de leche</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=cpleche" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar peso de leche</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tabla_peso_leche" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Fecha
                    </center></th>
                    <th><center>
                      Animal
                    </center></th>
                    <th><center>
                      Botellas
                    </center></th>
                    <th><center>
                      Hora
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_peso_leche();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><?php echo $datos['fecha'] ?></td>
                    <td><?php echo $datos['animal'] ?></td>
                    <td><?php echo $datos['peso'] ?></td>
                    <td><?php echo $datos['hora'] ?></td>
                    <td><center>
                      <label class="btn btn-success" title="Detalle peso de leche" data-toggle="modal" data-target="#peso_leche" onclick="detalle_peso('<?php echo $datos['id']?>')"><i class="fa white fa-eye"></i></label>
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
<div class="modal fade" id="peso_leche" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Detalle del peso de leche</h4>
      </div>
      <div class="modal-body">
        <fieldset>
          <div class="form-group col-md-4">
            <label>Empleado</label>
            <input type="text" class="form-control" id="dempleado" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Fecha</label>
            <input type="text" class="form-control" id="dfecha" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Hora</label>
            <input type="text" class="form-control" id="dhora" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-6">
            <label>Peso</label>
            <input type="text" class="form-control" id="dpeso" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Animal</label>
            <input type="text" class="form-control" id="danimal" readonly>
          </div>
        </fieldset>
        <fieldset>
          <div class="form-group col-md-12">
            <label>Notas</label>
            <textarea id="dnotas" class="form-control" rows="5" readonly></textarea>
          </div>
        </fieldset>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#tabla_peso_leche").dataTable({                
      "sPaginationType": "full_numbers"
  });
});

function detalle_peso(id) {
  $.post("procesos/produccion/detalle_peso.php", 
    { "id_peso": id }, 
    function(data){
    var data=JSON.parse(data);
    var resultado=data.items;
    document.getElementById('dempleado').value = resultado[0].empleado;
    document.getElementById('dfecha').value = resultado[0].fecha;
    document.getElementById('dhora').value = resultado[0].hora;
    document.getElementById('dpeso').value = resultado[0].peso;
    document.getElementById('danimal').value = resultado[0].animal;
    document.getElementById('dnotas').value = resultado[0].notas;
  });
}
</script>