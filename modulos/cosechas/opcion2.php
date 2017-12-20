<?php
  $sql_bodega="SELECT * FROM bodega";
  $response_bodega=$data->query($sql_bodega, array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-leaf"></i>&nbsp;Venta de elote y ensilaje de zacate
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
    <li class="active"><i class="fa fa-leaf"></i>&nbsp;Venta de elote y ensilaje de zacate</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
        <form action="" role="form" name="frmopcion2" id="frmopcion2" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <input type="hidden" name="enc_id" id="enc_id" readonly>
          <fieldset>
            <div class="form-group col-md-3">
                <label>Costo total de la siembra: </label>
                <input type="text" class="form-control" name="siembra" id="siembra" readonly placeholder="0.00">
            </div>
            <div class="form-group col-md-3">
                <label>Redes cosechadas: </label>
                <input type="text" class="form-control" name="redes" id="redes" placeholder="0.00">
            </div>
            <div class="form-group col-md-6">
                <label>Calidad del zacate: </label>
                <textarea type="text" rows="1" class="form-control" name="zacate" id="zacate"></textarea>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-2">
                <label>Precio por red: </label>
                <input type="text" class="form-control" name="precio" id="precio" placeholder="0.00">
            </div>
            <div class="form-group col-md-2">
                <label>Venta de elote: </label>
                <input type="text" class="form-control" name="venta" id="venta" placeholder="0.00" readonly>
            </div>
            <div class="form-group col-md-2">
                <label>Reclamaci&oacute;n &#40;&#37;&#41;&#58; </label>
                <input type="text" class="form-control" name="reclamacion" id="reclamacion" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="Costo">
            </div>
            <div class="form-group col-md-6">
                <label>Calidad de elote: </label>
                <textarea type="text" rows="1" class="form-control" name="elote" id="elote"></textarea>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group col-md-2">
                <label>Costo mano de obra: </label>
                <input type="text" class="form-control" name="mano_obra" id="mano_obra" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="Cosecha">
            </div>
            <div class="form-group col-md-2">
                <label>Costo de picado: </label>
                <input type="text" class="form-control" name="picado" id="picado" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
            <div class="form-group col-md-2">
                <label>Costo de transporte: </label>
                <input type="text" class="form-control" name="transporte" id="transporte" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
            <div class="form-group col-md-6">
                <label>Notas silos: </label>
                <textarea type="text" rows="1" class="form-control" name="silos" id="silos"></textarea>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group col-md-4">
                <label>Costo de plastico: </label>
                <input type="text" class="form-control" name="plastico" id="plastico" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="Cosecha">
            </div>
            <div class="form-group col-md-4">
                <label>Toneladas de forraje: </label>
                <input type="text" class="form-control" name="forraje" id="forraje" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
            <div class="form-group col-md-4">
                <label>Costo de compactaci&oacute;n: </label>
                <input type="text" class="form-control" name="compactacion" id="compactacion" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group col-md-3">
                <label>Costo de insumos: </label>
                <input type="text" class="form-control" name="insumos" id="insumos" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="0.00">
            </div>
            <div class="form-group col-md-2">
                <label>Fecha de inicio: </label>
                <input type="text" class="form-control" data-provide="datepicker" name="finicio" id="finicio" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="dd-mm-yyyy" readonly>
            </div>
            <div class="form-group col-md-2">
                <label>Fecha de cierre: </label>
                <input type="text" class="form-control" data-provide="datepicker" name="fcierre" id="fcierre" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="dd-mm-yyyy" readonly>
            </div>
            <div class="form-group col-md-5">
                <label>Bodega: </label>
                <select class="form-control" name="bodega" id="bodega" data-validation="required" data-validation-error-msg="Seleccione bodega">
                    <option value="">Seleccione bodega</option>
                    <?php foreach ($response_bodega['items'] as $key_bodega) { ?>
                    <option value="<?php echo $key_bodega['codigo']?>"><?php echo $key_bodega['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <legend>Elaboraci&oacute;n de silo</legend>
            <div class="form-group col-md-3">
                <label>Codigo de silo: </label>
                <input type="text" class="form-control" name="silo" id="silo" placeholder="">
            </div>
            <div class="form-group col-md-3">
                <label>Toneladas de silo: </label>
                <input type="text" class="form-control" name="tsilo" id="tsilo" placeholder="0.00">
            </div>
            <div class="form-group col-md-5">
                <label>Descrinci&oacute;n: </label>
                <textarea type="text" rows="1" class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>
            <div class="form-group col-md-1">
                <label>Agregar</label>
                <button type="button" class="btn btn-success" title="Agregar" id="agregar"><i class="fa white fa-plus-square"></i></button>
            </div>
        </fieldset>
        <fieldset class="form-group">
            <div style="clear:both;"></div>
            <div class="table-responsive">
                <table class='table table-condensed' style="margin-bottom:0;">
                <thead>
                <tr class="bg bg-navy">
                    <th width="15%"><center>
                        Codigo
                    </center></th>
                    <th width="35%"><center>
                        Toneladas de silo
                    </center></th>
                    <th width="35%"><center>
                        Descripci&oacute;n
                    </center></th>
                    <th width="15%"><center>
                        Acci&oacute;n
                    </center></th>
                </tr>
                </thead>
                </table>
                <div style="height:150px; top: 0; overflow-y:scroll; overflow-x:hidden;">
                    <table class='table table-condensed'>
                    <tbody id="detalle_cosecha">
                    </tbody>
                    </table>
                </div>
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
        document.getElementById('siembra').value = response.total;
        document.getElementById('enc_id').value=get.id;
    });
}
//Funcion que nos permite calcular la venta del elote
$("[name=precio]").on('change',function(){
  vta_elote=$(this).val();
  cvt=vta_elote*$("[name=redes]").val();
  cvta=parseFloat(cvt).toFixed(2);
  document.getElementById('venta').value = cvta;
});
$("[name=redes]").on('change',function(){
  vta_elote=$(this).val();
  cvt=vta_elote*$("[name=precio]").val();
  cvta=parseFloat(cvt).toFixed(2);
  document.getElementById('venta').value = cvta;
});

var tforraje;
$("[name=forraje]").on('change',function(){
    tforraje=parseFloat($(this).val());
});

// Funcion que nos permite agregar silos a la tabla
$("#agregar").on('click', function(){
    var silo = $("#silo").val();
    var tsilo = $("#tsilo").val();
    var descripcion = $("#descripcion").val();
    if (tforraje>=parseFloat(tsilo)) {
        if (silo!=='' && tsilo!=='') {
        $.ajax({
            url: "procesos/cosecha/agregar_silo.php",
            type: "POST",
            dataType: "json",
            data: {'silo':silo,'tsilo':tsilo,'descripcion':descripcion}
        }).done(function(data){
            if (data.success == true) {
                total=data.items.length;
                var datos=data.items;
                var opciones;
                if(total>0){
                    for(var i=0; i<total; i++){
                        opciones+="<tr><td width='9.1%'>"+datos[i].csilo+"</td>"
                                +"<td width='13.1%'>"+datos[i].tsilo+"</td>"
                                +"<td width='9.1%'>"+datos[i].descripcion+"</td>"
                                +"<td width='4.1%'><a class='label label-danger' onsubmit='return false' onClick=\"quitar('"+datos[i].csilo+"');\" title='Quitar'><i class='fa white fa-trash'></i></a></td></tr>";
                    }
                    $("#agregar").blur();
                    $('#detalle_cosecha').html(opciones);
                    tforraje-=tsilo;
                }
            }else{
                $("#agregar").blur();
                $.confirm({icon:'fa fa-exclamation', title:'Error', content:data.mensaje, type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
            }
        });
        }else{
            $("#agregar").blur();
            $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Campos vacios', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
        }
    }else{
        $("#agregar").blur();
        $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Cantidad insuficiente', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
    }
});

//qutias articulos de tabla
function quitar(codigo){
    //incluir alert confirm y hacer accion en caso de YES
    if(codigo!=""){
        $.ajax({
            url: "procesos/cosecha/quitar_silo.php",
            type: "POST",
            dataType: "json",
            data: {'codigo': codigo}
        }).done(function(data){
            total=data.length;
            var opciones;
            if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td width='9.1%'>"+data[i].csilo+"</td>"
                                +"<td width='13.1%'>"+data[i].tsilo+"</td>"
                                +"<td width='9.1%'>"+data[i].descripcion+"</td>"
                                +"<td width='4.1%'><a class='label label-danger' onsubmit='return false' onClick=\"quitar('"+data[i].csilo+"');\" title='Quitar'><i class='fa white fa-trash'></i></a></td></tr>";
                }
                $('#detalle_cosecha').html(opciones);
            }else{
                $('#detalle_cosecha').html("");
            }
        });
    }
}

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
        onSuccess: function(form){
            var formulario = document.getElementById("frmopcion2");
            var formData = new FormData(formulario);
            $.ajax({
                url: "procesos/cosecha/guardar_opcion2.php",
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