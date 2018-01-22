<?php
$response_animales=$data->query("SELECT numero, nombre FROM animales");
?>
<style type="text/css">
#uno {
  text-align: center;
}
</style>
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
          <form action="" role="form" name="frmcpruebacmt" id="frmcpruebacmt" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
            <fieldset>
              <div class="form-group col-md-12">
                <label>Fecha</label>
                <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-12">
                <label>Animal</label>
                <select class="form-control select2" name="animal" id="animal">
                  <option value="">Seleccione animal</option>
                  <?php foreach ($response_animales['items'] as $key_animales) { ?>
                  <option value="<?php echo $key_animales['numero'] ?>"><?php echo $key_animales['nombre'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-6">
                <label>DI</label>
                <select class="form-control" name="di" id="di">
                  <option value="">Seleccione</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="c">Cl&iacute;nico</option>
                  <option value="x">Cuarto ciego</option>
                  <option value="t">Traza</option>                
                  <option value="-">-</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>DD</label>
                <select class="form-control" name="dr" id="dr">
                  <option value="">Seleccione</option>
                  <option value="">Seleccione</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="c">Cl&iacute;nico</option>
                  <option value="x">Cuarto ciego</option>
                  <option value="t">Traza</option>                
                  <option value="-">-</option>
                </select>
              </div>
            </fieldset>
            <fieldset>
              <div class="form-group col-md-6">
                <label>TI</label>
                <select class="form-control" name="ti" id="ti">
                  <option value="">Seleccione</option>
                  <option value="">Seleccione</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="c">Cl&iacute;nico</option>
                  <option value="x">Cuarto ciego</option>
                  <option value="t">Traza</option>                
                  <option value="-">-</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>TD</label>
                <select class="form-control" name="tr" id="tr">
                  <option value="">Seleccione</option>
                  <option value="">Seleccione</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="c">Cl&iacute;nico</option>
                  <option value="x">Cuarto ciego</option>
                  <option value="t">Traza</option>                
                  <option value="-">-</option>
                </select>
              </div>
            </fieldset>
            <div class="box-footer">
              <button type="button" class="btn btn-primary pull-right" id="agregar" data-toggle="tooltip" title="Agregar a tabla"><i class="fa white fa-plus-square"></i></button>
            </div>
        </div>
        <div class="col-md-8">
          <fieldset class="form-group">
            <div style="clear:both;"></div>
            <div class="table-responsive">
              <table class='table table-condensed' style="margin-bottom:0;">
              <thead>
              <tr class="bg bg-navy">
                  <th width="16.8%"><center>Animal</center></th>
                  <th width="16.8%"><center>DI</center></th>
                  <th width="16.8%"><center>DR</center></th>
                  <th width="16.8%"><center>TI</center></th>
                  <th width="16.8%"><center>TR</center></th>
                  <th width="16%"><center>Acci&oacute;n</center></th>
              </tr>
              </thead>
              </table>
              <div style="height:234px; top: 0; overflow-y:scroll; overflow-x:hidden;">
                <table class='table table-condensed' id="tabla_pruebas_cmt">
                <tbody id="detalle_pruebas_cmt">
                </tbody>
                </table>
              </div>
            </div>
          </fieldset>
          <div class="box-footer">
            <button type="button" onClick="location.href='?mod=cmt'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
            <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa white fa-save"></i>&nbsp;Guardar</button>
          </div>
          </form>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<script type="text/javascript">
// Funcion que nos permite agregar datos a la tabla
$("#agregar").on('click', function(){
  var animal = $("#animal").val();
  var nombre_animal = document.getElementById('animal').options[document.getElementById('animal').selectedIndex].text;
  var di = $("#di").val();
  var dr = $("#dr").val();
  var ti = $("#ti").val();
  var tr = $("#tr").val();
  if (animal == '') {
    $("#agregar").blur();
    $("#animal").focus();
    $.confirm({icon:'fa fa-exclamation', title:'Error', content:'El campo animal esta vacio', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
  }else{
    if(di=='' || dr=='' || ti=='' || tr==''){
      $("#agregar").blur();
      $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Aun hay un campo &oacute; campos vacio', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
    }else{
      $.ajax({
          url: "procesos/sanidad/agregar_prueba_cmt.php",
          type: "POST",
          dataType: "json",
          data: {'numero':animal, 'nombre_animal':nombre_animal, 'di':di, 'dr':dr, 'ti':ti, 'tr':tr}
      }).done(function(data){
          if (data.success == true) {
              total=data.items.length;
              var datos=data.items;
              var opciones;
              if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td width='16.8%' id='uno'>"+datos[i].animal+"</td>"
                            +"<td width='16.8%' id='uno'>"+datos[i].di+"</td>"
                            +"<td width='16.8%' id='uno'>"+datos[i].dr+"</td>"
                            +"<td width='16.8%' id='uno'>"+datos[i].ti+"</td>"
                            +"<td width='16.8%' id='uno'>"+datos[i].tr+"</td>"
                            +"<td width='16%' id='uno'><a class='label label-danger' onsubmit='return false' onClick=\"quitar('"+datos[i].numero+"');\" title='Quitar'><i class='fa white fa-trash'></i></a></td></tr>";
                }
                $("#agregar").blur();
                $('#detalle_pruebas_cmt').html(opciones);
                $("#animal").select2("val", "");
                $("[name=dr]").val('');
                $("[name=di]").val('');
                $("[name=tr]").val('');
                $("[name=ti]").val('');
              }
          }else{
              $("#agregar").blur();
              $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Error al cargar los datos', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
          }
      });
    }
  }
});

//quita articulos de tabla
function quitar(numero){
    if(numero!=""){
        $.ajax({
            url: "procesos/sanidad/quitar_prueba_cmt.php",
            type: "POST",
            dataType: "json",
            data: {'numero': numero}
        }).done(function(data){
            total=data.length;
            var opciones;
            if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td width='16.8%' id='uno'>"+data[i].animal+"</td>"
                            +"<td width='16.8%' id='uno'>"+data[i].di+"</td>"
                            +"<td width='16.8%' id='uno'>"+data[i].dr+"</td>"
                            +"<td width='16.8%' id='uno'>"+data[i].ti+"</td>"
                            +"<td width='16.8%' id='uno'>"+data[i].tr+"</td>"
                            +"<td width='16%' id='uno'><a class='label label-danger' onsubmit='return false' onClick=\"quitar('"+data[i].numero+"');\" title='Quitar'><i class='fa white fa-trash'></i></a></td></tr>";
                }
                $('#detalle_pruebas_cmt').html(opciones);
            }else{
                $('#detalle_pruebas_cmt').html("");
            }
        });
    }
}

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
        onSuccess: function(form){
          if ($("#tabla_pruebas_cmt tr td").length > 0) {
            var formulario = document.getElementById("frmcpruebacmt");
            var formData = new FormData(formulario);
            $.ajax({
                url: "procesos/sanidad/guardar_prueba_cmt.php",
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
          }else{
            $("#guardar").blur();
            $.confirm({icon:'fa fa-warning', title:'Error', content:'La tabla no puede estar vacía', type:'orange', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-orange', action: function(){close();}}}});
          }
        }
    });
});
</script>