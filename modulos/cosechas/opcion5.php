<?php
  $sql_bodega="SELECT * FROM bodega";
  $response_bodega=$data->query($sql_bodega, array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-leaf"></i>&nbsp;Doblado y cosecha del grano
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=cosechas"><i class="fa fa-leaf"></i>&nbsp;Administraci&oacute;n de cosechas</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-leaf"></i>&nbsp;Doblado y cosecha del grano</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
        <form action="" role="form" name="frmopcion5" id="frmopcion5" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <input type="hidden" name="enc_id" id="enc_id" readonly>
          <fieldset>
            <div class="form-group col-md-3">
                <label>Costo total de la siembra: </label>
                <input type="text" class="form-control" name="csiembra" id="csiembra" readonly placeholder="0.00">
            </div>
            <div class="form-group col-md-3">
                <label>Bodega: </label>
                <select class="form-control" name="bodega" id="bodega" data-validation="required" data-validation-error-msg="Seleccione bodega">
                    <option value="">Seleccione bodega</option>
                    <?php foreach ($response_bodega['items'] as $key_bodega) { ?>
                    <option value="<?php echo $key_bodega['codigo']?>"><?php echo $key_bodega['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Costo tapizca: </label>
                <input type="text" class="form-control" name="ctapizca" id="ctapizca" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-3">
                <label>Costo desgranado: </label>
                <input type="text" class="form-control" name="cdesgranado" id="cdesgranado" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-1">
              <label style="color: #1645F1;">Es venta?&nbsp;&nbsp;</label>
              <input type='checkbox' name="venta" id="venta" data-validation="required" data-validation-error-msg="Seleccione este campo" value="si">
            </div>
            <div class="form-group col-md-2">
              <label>Precio de venta</label>
                <input type="text" class="form-control" name="pventa" id="pventa" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-3">
              <label>Reclamaci&oacute;n de costo &#40;&#37;&#41;</label>
              <input type="text" class="form-control" name="rcosto" id="rcosto" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-6">
                <label>Notas: </label>
                <textarea type="text" rows="1" class="form-control" name="notas" id="notas"></textarea>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-3">
              <label>Toneladas de rastrojo</label>
              <input type="text" class="form-control" name="trastrojo" id="trastrojo" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-3">
              <label>Costo oportunidad venta rastrojo</label>
              <input type="text" class="form-control" name="cvrastrojo" id="cvrastrojo" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-3">
              <label>Toneladas de tuza y olote</label>
              <input type="text" class="form-control" name="ttuza_olote" id="ttuza_olote" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-3">
              <label>Costo oportunidad venta tuza y olote</label>
              <input type="text" class="form-control" name="cvtuza_olote" id="cvtuza_olote" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
          </fieldset>
          <br>
          <fieldset>
            <legend>Procesado de productos</legend>
            <table class="table table-condensed table-responsive no-padding" style="width: 65%;">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Costo moler</th>
                  <th>Costo envasar</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Ma&iacute;z en grano</td>
                  <td><input type="text" name="cmoler1" id="cmoler1" placeholder="0.00"></td>
                  <td><input type="text" name="cenvasar1" id="cenvasar1" placeholder="0.00"></td>
                </tr>
                <tr>
                  <td>Tuza y olote para  moler</td>
                  <td><input type="text" name="cmoler2" id="cmoler2" placeholder="0.00"></td>
                  <td><input type="text" name="cenvasar2" id="cenvasar2" placeholder="0.00"></td>
                </tr>
                <tr>
                  <td>Rastrojo</td>
                  <td><input type="text" name="cmoler3" id="cmoler3" placeholder="0.00"></td>
                  <td><input type="text" name="cenvasar3" id="cenvasar3" placeholder="0.00"></td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        <div class="box-footer">
          <button type="button" onClick="location.href='?mod=cosechas'" class="btn btn-danger margin-right pull-left">Cancelar</button>
          <button type="reset" class="btn btn-success pull-left" id="limpiar">Limpiar</button>
          <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar">Guardar</button>
        </div>
        </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<script type="text/javascript">
$(document).ready(function(){
  $("#pventa").prop('readonly', true);
  $("#rcosto").prop('readonly', true);
  $("[name=venta]").on('click', function(){
    if ($(this).is(':checked')) {
      $("#pventa").prop('readonly', false);
      $("#rcosto").prop('readonly', false);
    }else{
      $("#pventa").prop('readonly', true);
      $("#rcosto").prop('readonly', true);
    }
  });
});

// Funcion que permite tomar variables que vienen por metodo get
function getGET(){
    var loc = document.location.href;
    if(loc.indexOf('?')>0){
        var getString = loc.split('?')[1];
        var GET = getString.split('&');
        var get = {};
        for(var i = 0, l = GET.length; i < l; i++){
            var tmp = GET[i].split('=');
            get[tmp[0]] = unescape(decodeURI(tmp[1]));
        }
        return get;
    }
}

//Declaracion de variable global
var get = getGET();

window.onload = function(){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'procesos/cosecha/total_general.php',
        data: { 'id_proyecto' : get.id },
    }).done(function (response) {
        document.getElementById('csiembra').value = response.total;
        document.getElementById('enc_id').value=get.id;
    });
}
</script>