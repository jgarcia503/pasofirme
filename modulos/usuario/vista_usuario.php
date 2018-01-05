<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-user"></i>&nbsp;Registro de usuarios
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-user"></i>&nbsp;Usuarios</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h5><a href="?mod=iusuarios" class="fa fa-plus-circle" style="color: #0C0303;">&nbsp;Ingresar usuario</a></h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <table id="tabla" class="datatable table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      N°
                    </center></th>
                    <th><center>
                      Nombre
                    </center></th>
                    <th><center>
                      Usuario
                    </center></th>
                    <th><center>
                      Estado
                    </center></th>
                    <th><center>
                      Acciones
                    </center></th>
                  </tr>
               </thead>
               <?php
                $cont = 1;  
                if ($_SESSION["tipo"] == 'admin') {
                    $response = $dataTable->obtener_usuarios(); 
                }
                ?>
               <tbody>
                <?php foreach($response['items'] as $datos){ ?>
                  <tr>
                    <td><center>
                        <?php echo $cont ?>
                    </center></td>
                    <td>
                        <?php echo $datos['nombre']?>
                    </td>
                    <td><center>
                        <?php echo $datos['usuario'] ?>
                    </center></td>
                    <td ><center>
                        <?php if ($datos['estado'] == 'Activo') { $clase = 'label label-success'; }elseif ($datos['estado'] == 'Inactivo') { $clase = 'label label-danger'; }else{ $clase = 'label label-default'; } ?>
                        <span class="<?php echo $clase ?>"><?php echo $datos['estado'] ?>
                        </span>
                    </center></td>
                    <td class="center"><center>
                        <?php if ($datos['estado'] == 'Activo' OR $datos['estado'] == 'Inactivo') { ?>
                            <form action="?mod=musuarios" method="POST">
                                <a class="btn btn-success" id="iusuario" data-toggle='tooltip' title="Informaci&oacute;n del usuario" onclick="datos_usuario('<?php echo $datos['nombre'] ?>','<?php echo $datos['correo'] ?>','<?php echo $datos['telefono'] ?>','<?php echo $datos['usuario'] ?>','<?php echo $datos['estado'] ?>');"><i class="fa white fa-info-circle"></i>
                                </a>
                                <a class="btn btn-warning" href="#" onclick="reset_pass('<?php echo $datos['id'] ?>');"><i class="fa white fa-lock"></i>
                                </a>
                                <a class="btn btn-danger" href="#" id="musuario" data-toggle='tooltip' title="Estado del usuario" onclick="modificar_estado('<?php echo $datos['id'] ?>', '<?php echo $datos['nombre'] ?>','<?php echo $datos['estado'] ?>');"><i class="fa white fa-retweet"></i>
                                </a>
                                <input type="hidden" name="id" value="<?php echo $datos['id'] ?>">
                                <button type="submit" class="btn btn-info" data-toggle='tooltip' title="Modificar datos del usuario"><i class="fa white fa-pencil-square-o"></i></button>
                            </form>
                        <?php }else{ ?>
                            <form action="?mod=musuarios" method="POST">
                                <a class="btn btn-success" data-toggle='tooltip' title="Informaci&oacute;n del usuario" onclick="datos_usuario('<?php echo $datos['nombre'] ?>','<?php echo $datos['correo'] ?>','<?php echo $datos['telefono'] ?>','<?php echo $datos['usuario'] ?>','<?php echo $datos['estado'] ?>');"><i class="fa white fa-info-circle"></i>
                                </a>
                                <input type="hidden" name="id" value="<?php echo $datos['id'] ?>">
                                <button type="submit" class="btn btn-info" data-toggle='tooltip' title="Modificar datos del usuario"><i class="fa white fa-pencil-square-o"></i></button>
                            </form>
                        <?php } ?>
                    </center></td>
                  </tr>
                  <?php  
                $cont ++;
                    } ?>
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
<!-- Venta modal para ver detalle del usuario -->
<div class="modal fade" id="datos_usuario" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Informaci&oacute;n del usuario</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Nombre Completo:</label>
            <input type="text" class="form-control" id="nombre" disabled="disable" style="width: 95%;">
        </div>
        <div class="form-group">
            <label>Correo:</label>
            <input type="text" class="form-control" id="mail" disabled="disable" style="width: 95%;">
        </div>
        <div class="form-group">
            <label>Tel&eacute;fono:</label>
            <input type="text" class="form-control" id="tel" disabled="disable" style="width: 95%;">
        </div>
        <div class="form-group">
            <label>Usuario:</label>
            <input type="text" class="form-control" id="usuario" disabled="disable" style="width: 95%;">
        </div>
        <div class="form-group">
            <label>Estado:</label>
            <input type="text" class="form-control" id="estado" disabled="disable" style="width: 95%;">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Ventana modal para el cambio de estado -->
<div class="modal fade" id="modal_usuario" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Cambio de estado</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" name="frmestado" id="frmestado" onSubmit="return false">
            <input type="hidden" id="id2" name="id2">
            <div class="form-group">
                <label>Nombre Completo:</label>
                <input type="text" class="form-control" name="txtNombre_Completo" id="txtNombre_Completo" disabled="disable">
            </div>
            <div class="form-group">
                <label>Estado:</label>
                <select name="estado" id="estado" class="form-control" placeholder="Seleccione" required="true">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
        <button type="submit" id="modificar_estado" name="modificar_estado" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
//Funcion para cargar el formulario
function datos_usuario(nombre, correo, telefono, usuario, estado) {
    document.getElementById('nombre').value = nombre;
    document.getElementById('mail').value = correo;
    document.getElementById('tel').value = telefono;
    document.getElementById('usuario').value = usuario;
    document.getElementById('estado').value = estado;
}

//Funcion para cargar los campos de la ventana modal
function modificar_estado(id, nombre, estado) {
    document.getElementById('id2').value = id;
    document.getElementById('txtNombre_Completo').value = nombre;
    document.getElementById('estado').value = estado;
}

//restablecer contraseña
function reset_pass(id){
    $.confirm({title: 'Reestablece contraseña?', content:'', icon: 'fa fa-info-circle', 
        buttons: {
            Si: function () {
                close();
                $.ajax({
                  type:"POST",
                  url:"procesos/usuario/restablecer_contrasena.php",
                  data: {'id': id},
                  dataType:"json",
                    success: function(response){
                        if(response.success){
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload(); }}}});
                        } else{
                            $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                        }
                    }
                });      
            }, No: function () {
                    close();
            }, 
        }
    });
}

// Funcion que nos permitira cambiar el estado del usuario
$(document).ready(function () {
    $('#modificar_estado').click(function () {
        var formulario = $('#frmestado').serializeArray();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'procesos/usuario/modificar_estado_usuario.php',
            data: formulario,
        }).done(function (response) {
            if(response.success == false) {
                $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
            }else{
                $('#modal_usuario').modal('hide');
                $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload(); }}}});
            }
        });
    });
});

$(document).ready(function(){
  $('#iusuario').on('click', function(){
      $('#datos_usuario').modal('show');
  });
  $('#musuario').on('click', function(){
      $('#modal_usuario').modal('show');
  });
});
</script>