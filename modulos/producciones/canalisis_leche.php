<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Crear an&aacute;lisis de leche
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=analisis_leche"><i class="fa fa-tasks"></i>&nbsp;An&aacute;lisis de leche</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Crear an&aacute;lisis de leche</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmaleche" id="frmaleche" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <fieldset>
                <div class="form-group col-md-4">
                  <label>Fecha</label>
                  <input type="text" class="form-control" data-provide="datepicker" name="fecha" id="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label>Cantidad</label>
                  <input type="text" class="form-control" name="cantidad" id="cantidad" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-4">
                  <label>Recepci&oacute;n No.</label>
                  <input type="text" class="form-control" name="recepcion" id="recepcion" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
              </fieldset>
              <br>
              <fieldset>
                <fieldset class="col-md-3">
                  <legend style="color: #2D57FF;">Grasa</legend>
                  <div class="form-group">
                    <label>&#37;</label>
                    <input type="text" class="form-control" name="grasa" id="grasa">
                  </div>
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" name="grasa_val" id="grasa_val" readonly>
                  </div>
                </fieldset>
                <fieldset class="col-md-3">
                  <legend style="color: #2D57FF;">Prote&iacute;na</legend>
                  <div class="form-group">
                    <label>&#37;</label>
                    <input type="text" class="form-control" name="proteina" id="proteina">
                  </div>
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" name="proteina_val" id="proteina_val" readonly>
                  </div>
                </fieldset>
                <fieldset class="col-md-3">
                  <legend style="color: #2D57FF;">RCS</legend>
                  <div class="form-group">
                    <label>x1000</label>
                    <input type="text" class="form-control" name="rcs" id="rcs">
                  </div>
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" name="rcs_val" id="rcs_val" readonly>
                  </div>
                </fieldset>
                <fieldset class="col-md-3">
                  <legend style="color: #2D57FF;">Reductasa</legend>
                  <div class="form-group">
                    <label>&#37;</label>
                    <input type="text" class="form-control" name="reductasa" id="reductasa">
                  </div>
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" name="reductasa_val" id="reductasa_val">
                  </div>
                </fieldset>
              </fieldset>
              <br>
              <fieldset>
                <fieldset class="col-md-4">
                  <legend style="color: #2D57FF;">Acidez</legend>
                  <div class="form-group">
                    <label>&#37;</label>
                    <input type="text" class="form-control" name="acidez" id="acidez">
                  </div>
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" name="acidez_val" id="acidez_val">
                  </div>
                </fieldset>
                <fieldset class="col-md-4">
                  <legend style="color: #2D57FF;">Temperatura</legend>
                  <div class="form-group">
                    <label>&#37;</label>
                    <input type="text" class="form-control" name="temperatura" id="temperatura">
                  </div>
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" name="temperatura_val" id="temperatura_val">
                  </div>
                </fieldset>
                <fieldset class="col-md-4">
                  <legend style="color: #2D57FF;">&#37; de agua</legend>
                  <div class="form-group">
                    <label>&#37;</label>
                    <input type="text" class="form-control" name="agua" id="agua">
                  </div>
                  <div class="form-group">
                    <label>Valor</label>
                    <input type="text" class="form-control" name="agua_val" id="agua_val">
                  </div>
                </fieldset>
              </fieldset>
              <div class="box-footer">
                <button type="button" onClick="location.href='?mod=inicio'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
                <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa white fa-save"></i>&nbsp;Guardar</button>
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
$('[name=grasa]').on('change',function(){
  base_grasa=3.5;//es porcentaje  abajo castigo, arriba premio
  grasa_val=parseFloat($('[name=grasa]').val());
  valor_x_botella=(grasa_val-base_grasa)/100;
  num_botellas=parseInt($('[name=cantidad]').val());
  total=num_botellas*valor_x_botella;
  $("[name=grasa_val]").val(total.toFixed(4));
});
  
$('[name=proteina]').on('change',function(){
valores=[3.11,3.12,3.13,3.14,3.15];    
proteina_val=parseFloat($('[name=proteina]').val());
if(valores.indexOf(valores,proteina_val)===-1){
  //castigo
  if(proteina_val<3.11){
    valor_x_botella=(3.11-proteina_val)/100;
    num_botellas=parseInt($('[name=cantidad]').val());
    total=num_botellas*valor_x_botella;
    $("[name=proteina_val]").val(Math.abs(total.toFixed(4)));
  }
  //premio
  if(proteina_val>3.15){
    valor_x_botella=(3.15-proteina_val)/100;
    num_botellas=parseInt($('[name=cantidad]').val());
    total=num_botellas*valor_x_botella;
    $("[name=proteina_val]").val(Math.abs(total.toFixed(4)));
  }
}else{
  valor_x_botella=(valores[_.indexOf(valores,proteina_val)]-proteina_val)/100;
  num_botellas=parseInt($('[name=cantidad]').val());
  total=num_botellas*valor_x_botella;
  $("[name=proteina_val]").val(Math.abs(total.toFixed(4)));
}
});
  
$('[name=rcs]').on('change',function(){
  base_rcs=600;//x1000 abajo premio,arriba castigo
  rcs_val=parseFloat($('[name=rcs]').val());
  valor_x_botella=((rcs_val-base_rcs)/1000)/20;//se divide entre 20 porque cada 20 es un punto
  num_botellas=parseInt($('[name=cantidad]').val());
  total=num_botellas*valor_x_botella;
  $("[name=rcs_val]").val(Math.abs(total.toFixed(4)));
});

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
      onSuccess: function(form){
        var formulario = document.getElementById("frmaleche");
        var formData = new FormData(formulario);
        $.ajax({
            url: "procesos/produccion/guardar_analisis_leche.php",
            type: "POST",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
            },
            success: function(response){
                if (response.success == true) {
                    $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload(); }}}});
                } else {
                    $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                }
            },
            error: function() {
                $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error!', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
            },
            complete: function() {
                $.unblockUI();
            }
        });
      }
  });
});
</script>