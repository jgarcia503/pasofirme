<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-leaf"></i>&nbsp;Administraci&oacute;n de cosechas
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-leaf"></i>&nbsp;Administraci&oacute;n de cosechas</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- <div class="box-header">
          <h5><a href="?mod=cproyecto" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Crear proyecto siembra</a></h5>
        </div> -->
        <!-- /.box-header -->
        <div class="box-body">
             <table role="grid" id="tabla_cosechas" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      Nombre
                    </center></th>
                    <th><center>
                      Fecha de inicio
                    </center></th>
                    <th><center>
                      Fecha de finalizaci&oacute;n
                    </center></th>
                  </tr>
               </thead>
               <?php
                $response = $dataTable->obtener_cosechas();
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td>
                        <a href="#" class="<?php echo ($datos['opcion']===NULL)? 'Elegir':'' ?>" data-toggle='modal' data-target='#opciones' style="color: #1086FE;" onclick="opciones_cosechas('<?php echo $datos['id_proyecto']?>','<?php echo $datos['nombre_proyecto']?>')" name="ocosechas">
                            <?php echo $datos['nombre_proyecto'] ?>
                        </a>
                    </td>
                    <td><center>
                        <?php echo $datos['fecha_inicio']?>
                    </center></td>
                    <td><center>
                        <?php echo $datos['fecha_fin'] ?>
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
<!-- Ventana modal tareas de la cosecha -->
<div class="modal fade" id="opciones" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4>Opciones</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" name="frmopciones" id="frmopciones" onSubmit="return false">
          <input type="hidden" name="proyecto_id" id="proyecto_id" readonly>
          <div class="form-group">
              <label>Opciones de cosechas:&nbsp;<span class="break"></span><label id="proyecto" style="color: #033FE7;"></label></label>
              <select class="form-control" name="options" id="options" data-validation="required" data-validation-error-msg="Seleccione activo">
                  <option value="">Seleccione</option>
                  <option value="?mod=opcion1">1-Venta del zacate con grano</option>
                  <option value="?mod=opcion2">2-Venta de elote y ensilaje de zacate</option>
                  <option value="?mod=opcion3">3-Ensilado con grano</option>
                  <option value="?mod=opcion4">4-Venta elote y zacate (prematuro)</option>
                  <option value="?mod=opcion5">5-Cosecha del grano</option>
                  <option value="?mod=opcion6">6-Ensilado antes del tiempo</option>            
                  <option value="?mod=opcion7">7-Corte y reparte en verde</option>            
                  <option value="?mod=opcion8">8-Otro tipo de cultivo</option>   
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button type="submit" id="continuar" name="continuar" class="btn btn-primary">Enviar</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#tabla_cosechas").dataTable({                
      "sPaginationType": "full_numbers"
  });
});

//Carga el id y nombre de la cosecha en la modal
function opciones_cosechas(id_proyecto, nombre){
  document.getElementById('proyecto_id').value=id_proyecto;
  document.getElementById('proyecto').innerHTML=nombre;
}

//Hace la navegacion de los modulos en la modal
$("#continuar").on('click',function(){
    var id_proyecto = '&id='+$("#proyecto_id").val();
    if ($("#options option:selected").val() != '') {
      window.location=$("#options option:selected").val()+id_proyecto;
    }else{
      $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion', content: 'Seleccione una opción de cosecha', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
    }
});
</script>