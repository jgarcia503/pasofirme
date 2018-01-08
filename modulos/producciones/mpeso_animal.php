<?php
$params = $_POST;
$sql_animales="SELECT * FROM animales";
$response_animales=$data->query($sql_animales, array(), array());
$sql_peso="SELECT * FROM bit_peso_animal WHERE id =:id_animal";
$params_peso=array("id_animal");
$response_peso=$data->query($sql_peso, $params, $params_peso);
?>
<style type="text/css">
#uno {
  text-align: center;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-edit"></i>&nbsp;Modificar peso del animal
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
    <li class="active"><i class="fa fa-edit"></i>&nbsp;Modificar peso del animal</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" role="form" name="frmmodpanimal" id="frmmodpanimal" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
              <input type="hidden" name="id_panimal" id="id_panimal" value="<?php echo $_POST['id_animal']?>" readonly>
              <fieldset>
                <div class="form-group col-md-6">
                  <label>Fecha</label>
                    <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-validation="required" data-validation-error-msg="Complete este campo" readonly value="<?php echo $response_peso['items'][0]['fecha']?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Empleado</label>
                    <select class="form-control" name="empleado" id="empleado" data-validation="required" data-validation-error-msg="Seleccione empleado">
                      <option value="yo">Yo</option>
                    </select>
                </div>
              </fieldset>
              <fieldset>
                <div class="form-group col-md-6">
                  <label>Animal</label>
                    <input type="text" class="form-control awesomplete" name="animal" id="animal" list="animales" data-minchars="1">
                    <datalist id="animales">
                      <?php foreach ($response_animales['items'] as $key_animales) { ?>
                        <option value="<?php echo $key_animales['numero']?>-<?php echo $key_animales['nombre']?>"><?php echo $key_animales['numero']?>-<?php echo $key_animales['nombre']?></option>
                      <?php } ?>
                    </datalist>
                </div>
                <div class="form-group col-md-5">
                  <label>Peso</label>
                    <input type="text" class="form-control" name="peso" id="peso">
                </div>
                <div class="form-group col-md-1">
                  <label>Agregar</label>
                  <button type="button" class="btn btn-success" data-toggle="tooltip" title="Agregar" id="agregar"><i class="fa white fa-plus-square"></i></button>
                </div>
              </fieldset>
              <fieldset class="form-group col-md-12">
                <div style="clear:both;"></div>
                <div class="table-responsive">
                  <table class='table table-condensed' style="margin-bottom:0;">
                  <thead>
                  <tr class="bg bg-navy">
                      <th width="25%"><center>
                          N&uacute;mero
                      </center></th>
                      <th width="25%"><center>
                          Nombre
                      </center></th>
                      <th width="25%"><center>
                          Peso
                      </center></th>
                      <th width="25%"><center>
                          Acci&oacute;n
                      </center></th>
                  </tr>
                  </thead>
                  </table>
                  <div style="height:250px; top: 0; overflow-y:scroll; overflow-x:hidden;">
                      <table class='table table-condensed' id="tabla_pesos_animales">
                      <tbody id="detalle_peso_animal">
                      </tbody>
                      </table>
                  </div>
                </div>
              </fieldset>
              <fieldset class="col-md-12">
                <div class="form-group">
                  <label>Notas</label>
                  <textarea name="notas" class="form-control" rows="5"></textarea>
                </div>
              </fieldset>
              <div class="box-footer">
                <button type="button" onClick="location.href='?mod=inicio'" class="btn btn-danger margin-right pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
                <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa white fa-refresh"></i>&nbsp;Actualizar</button>
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
$(document).ready(function () {
  $.ajax({
      url: 'procesos/produccion/mostrar_peso_animal.php',
      type: 'POST',
      dataType: 'json',
      data: {"id_panimal": $("#id_panimal").val()}
  }).done(function(data){
        if (data.success == true) {
            total=data.items.length;
            var datos=data.items;
            var opciones;
            if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td id='uno' width='25%'>"+datos[i].num_animal+"</td>"
                                 +"<td id='uno' width='25%'>"+datos[i].animal+"</td>"
                                 +"<td id='uno' width='25%'>"+datos[i].peso+"</td>"
                                 +"<td id='uno' width='25%'><label class='btn btn-danger' onsubmit='return false' onClick=\"quitar('"+datos[i].num_animal+"');\" title='Quitar'><i class='fa white fa-trash'></i></label></td></tr>";
                }
                $('#detalle_peso_animal').html(opciones);
            }
        }
    });
});

var animaleslist=Array();
$("#animales option").each(function(index,elem){
  animaleslist.push(elem.innerHTML);
});
var animalespeso=Array();
// Funcion que nos permite agregar los datos a la tabla
$("#agregar").on('click', function(){
    var num_animal=$("[name=animal]").val().trim().split('-')[0];
    var animal=$("[name=animal]").val().trim().split('-')[1];
    var peso=$("[name=peso]").val();
    if (peso=='' || animal=='') {
      $("#agregar").blur();
      $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Animal o peso vacio', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
    }else{
      if (animaleslist.indexOf($("[name=animal]").val())===-1) {
        $("#agregar").blur();
        $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Elemento no coincide', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
      }else{
        if (animalespeso.indexOf(num_animal)!==-1) {
          $("#agregar").blur();
          $.confirm({icon:'fa fa-exclamation', title:'Error', content:'Elemento repetido', type:'red', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
        }else{
          $.ajax({
              url: "procesos/produccion/modificar_detalle_peso_animal.php",
              type: "POST",
              dataType: "json",
              data: {'num_animal':num_animal,'animal':animal,'peso':peso}
          }).done(function(data){
              if (data.success == true) {
                  total=data.items.length;
                  var datos=data.items;
                  var opciones;
                  if(total>0){
                      for(var i=0; i<total; i++){
                          opciones+="<tr><td id='uno' width='25%'>"+datos[i].num_animal+"</td>"
                                       +"<td id='uno' width='25%'>"+datos[i].animal+"</td>"
                                       +"<td id='uno' width='25%'>"+datos[i].peso+"</td>"
                                       +"<td id='uno' width='25%'><label class='btn btn-danger' onsubmit='return false' onClick=\"quitar('"+datos[i].num_animal+"');\" title='Quitar'><i class='fa white fa-trash'></i></label></td></tr>";
                      }
                      $("#agregar").blur();
                      $('#detalle_peso_animal').html(opciones);
                      $("[name=peso],[name=animal]").val('');
                  }
              }
          });
        }
      }
    }
});

// quitar articulos de tabla
function quitar(animal_num){
    //incluir alert confirm y hacer accion en caso de YES
    if(animal_num!=""){
        $.ajax({
            url: "procesos/produccion/quitar_detalle_peso_animal.php",
            type: "POST",
            dataType: "json",
            data: {"animal_num": animal_num}
        }).done(function(response){
            $("#detalle_peso_animal").html("");
            var data=response.items;
            $.each(data, function(index, value){
              $("#detalle_peso_animal").append("<tr><td id='uno' width='25%'>"+value.num_animal+"</td>"
                                                  +"<td id='uno' width='25%'>"+value.animal+"</td>"
                                                  +"<td id='uno' width='25%'>"+value.peso+"</td>"
                                                  +"<td id='uno' width='25%'><label class='btn btn-danger' onsubmit='return false' onClick=\"quitar('"+value.num_animal+"');\" title='Quitar'><i class='fa white fa-trash'></i></label></td></tr>");
            });
        });
    }
}

//Guardar datos a la BD
$('#guardar').click(function () {
    $.validate({
        onSuccess: function(form){
          if ($("#tabla_pesos_animales tr td").length > 0) {
            var formulario = document.getElementById("frmmodpanimal");
            var formData = new FormData(formulario);
            $.ajax({
                url: "procesos/produccion/guardar_peso_animal.php",
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
            $.confirm({icon:'fa fa-warning', title:'Error', content:'La tabla no puede estar vacía', type:'orange', typeAnimated:true, buttons:{tryAgain:{text:'Cerrar', btnClass:'btn-red', action: function(){close();}}}});
          }
        }
    });
});
</script>