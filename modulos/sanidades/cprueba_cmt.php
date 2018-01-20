<?php
$response_animales=$data->query("SELECT nombre FROM animales");
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear prueba CMT
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=cmt"><i class="fa fa-ge"></i>&nbsp;Administraci&oacute;n de pruebas CMT</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear prueba CMT</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="box box-primary">
      <!-- /.box-header -->
      <div class="box-body">
        <div class="col-md-4" style="border-right: 1px solid;">
          <form action="" role="form" name="frmcparto" id="frmcparto" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
            <fieldset>
              <div class="form-group col-md-12">
                <label>Fecha</label>
                <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-12">
                <label>Animal</label>
                <input type="text" class="form-control awesomplete" name="animal" id="animal" list="animales" data-minchars="1">
                <datalist id="animales">
                  <?php foreach ($response_animales['items'] as $key_animales) { ?>
                    <option value="<?php echo $key_animales['nombre'] ?>"><?php echo $key_animales['nombre'] ?></option>
                  <?php } ?>
                </datalist>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-6">
                <label>DI</label>
                <select class="form-control" name="di" id="di" data-validation="required" data-validation-error-msg="Seleccione">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>DR</label>
                <select class="form-control" name="dr" id="dr" data-validation="required" data-validation-error-msg="Seleccione">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-6">
                <label>TI</label>
                <select class="form-control" name="ti" id="ti" data-validation="required" data-validation-error-msg="Seleccione">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>TR</label>
                <select class="form-control" name="tr" id="tr" data-validation="required" data-validation-error-msg="Seleccione">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </fieldset>
            <div class="box-footer">
              <button type="button" class="btn btn-primary pull-right" id="agregar" data-toggle="tooltip" title="Agregar a tabla"><i class="fa white fa-plus-square"></i></button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->