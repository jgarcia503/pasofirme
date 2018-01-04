<?php
$sql_animales="SELECT a.* FROM animales a INNER JOIN grupos b ON a.grupo=b.id::varchar";
$response_animales=$data->query($sql_animales, array(), array());
$sql_empleados="SELECT nombre FROM contactos WHERE tipo = 'empleado'";
$response_empleados=$data->query($sql_empleados, array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear peso del animal
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=panimales"><i class="fa fa-balance-scale"></i>&nbsp;Administraci&oacute;n peso del animal</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear peso del animal</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frm_usuario" id="frm_usuario" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <fieldset>
                <div class="form-group col-md-6">
                  <label>Fecha</label>
                    <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label>Empleado</label>
                    <select class="form-control" name="empleado" id="empleado" data-validation="required" data-validation-error-msg="Seleccione empleado">
                      <option value="">Seleccione empleado</option>
                      <?php foreach ($response_empleados['items'] as $key_empleados) { ?>
                      <option value="<?php echo $key_empleados['nombre']?>"><?php echo $key_empleados['nombre']?></option>
                      <?php } ?>
                    </select>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-6">
                  <label>Animal</label>
                    <input type="text" class="form-control awesomplete" name="animal" id="animal" list="animales" data-validation="required" data-validation-error-msg="Complete este campo" data-minchars="1">
                    <datalist id="animales">
                      <?php foreach ($response_animales['items'] as $key_animales) { ?>
                        <option value="<?php echo $key_animales['numero']?>-<?php echo $key_animales['nombre']?>"><?php echo $key_animales['numero']?>-<?php echo $key_animales['nombre']?></option>
                      <?php } ?>
                    </datalist>
                </div>
                <div class="form-group col-md-6">
                  <label>Peso</label>
                    <input type="text" class="form-control" name="peso" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-12">
                  
                </div>
              </fieldset>
              <div class="box-footer">
                <button type="button" onClick="location.href='?mod=inicio'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
                  <button type="reset" class="btn btn-success pull-left" id="limpiar"><i class="fa white fa-eraser"></i>&nbsp;Limpiar</button>
                  <button type="submit" name="guardar" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa white fa-save"></i>&nbsp;Guardar</button>
              </div>
            </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<script type="text/javascript">
</script>