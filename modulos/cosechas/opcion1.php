<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-leaf"></i>&nbsp;Venta de elote y zacate
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
    <li class="active"><i class="fa fa-leaf"></i>&nbsp;Venta de elote y zacate</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
    	<form action="" role="form" name="frmopcion1" id="frmopcion1" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
    		<input type="hidden" name="enc_id" id="enc_id" readonly>
			<fieldset>
                <div class="form-group col-md-6">
                    <label>Costo total de la siembra: </label>
                    <input type="text" class="form-control" name="costo" id="costo" readonly placeholder="0.00">
                </div>
                <div class="form-group col-md-6">
                    <label>Precion de venta: </label>
                    <input type="text" class="form-control" name="precio" id="precio" placeholder="0.00" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
            </fieldset>
			<fieldset>
                <div class="form-group col-md-6">
                    <label>Toneladas de zacate: </label>
                    <input type="text" class="form-control" name="toneladas" id="toneladas" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
                <div class="form-group col-md-6">
                    <label>Utilidad de venta: </label>
                    <input type="text" class="form-control" name="utilidad" id="utilidad" data-validation="required" data-validation-error-msg="Complete este campo">
                </div>
            </fieldset>
			<div class="box-footer">
				<button type="button" onClick="location.href='?mod=cosechas'" class="btn btn-danger margin-right pull-left"><i class="fa fa-remove"></i>&nbsp;Cancelar</button>
			    <button type="reset" class="btn btn-success pull-left" id="limpiar"><i class="fa fa-eraser"></i>&nbsp;Limpiar</button>
			    <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa fa-save"></i>&nbsp;Guardar</button>
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
        url: 'procesos/cosecha/opcion1.php',
        data: { 'id_proyecto' : get.id },
    }).done(function (response) {
        if(response.total > 0 && get.id > 0) {
            data = response.items;
            document.getElementById('costo').value = data[0].total;
            document.getElementById('enc_id').value=get.id;
        }
    });
}

// Funcion que nos permitira mandar los datos a ingresar
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
           onSuccess : function(form) {
                var formulario = $('#frmopcion1').serializeArray();
                $.ajax({
                    data: formulario,
                    type: 'POST',
                    dataType: "json",
                    url: 'procesos/cosecha/guardar_opcion1.php',
                    beforeSend: function () {
                        $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                    },
                    success: function(response){
                        if (response.success == true) {
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.reload(); }}}});
                        }else{
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
});
</script>