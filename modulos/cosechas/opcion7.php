<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-leaf"></i>&nbsp;Corte y reparto en verde
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
    <li class="active"><i class="fa fa-leaf"></i>&nbsp;Corte y reparto en verde</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
        <form action="" role="form" name="frmopcion7" id="frmopcion7" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <input type="hidden" name="enc_id" id="enc_id" readonly>
          <fieldset>
            <div class="form-group col-md-3">
                <label>Costo total de la siembra: </label>
                <input type="text" class="form-control" name="csiembra" id="csiembra" readonly placeholder="0.00">
            </div>
            <div class="form-group col-md-3">
                <label>Costo mano de obra cosecha </label>
                <input type="text" class="form-control" name="mano_obra" id="mano_obra" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
            <div class="form-group col-md-6">
                <label>Notas: </label>
                <textarea type="text" rows="1" class="form-control" name="notas" id="notas"></textarea>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Costo de picado: </label>
                <input type="text" class="form-control" name="picado" id="picado" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
            <div class="form-group col-md-4">
                <label>Costo de transporte: </label>
                <input type="text" class="form-control" name="ctransporte" id="ctransporte" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
            <div class="form-group col-md-4">
                <label>Toneladas estimadas: </label>
                <input type="text" class="form-control" name="testimadas" id="testimadas" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
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

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
        onSuccess: function(form){
            var formulario = document.getElementById("frmopcion7");
            var formData = new FormData(formulario);
            $.ajax({
                url: "procesos/cosecha/guardar_opcion7.php",
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