<?php
if (isset($_POST['proyecto_id'])) {
	$params =  $_POST;

    $sql_controles = "SELECT nombre FROM controles_potreros";
    $response_controles = $data->query($sql_controles, array(), array());

    $sql_productos = "SELECT e.codigo_producto, e.existencia, p.nombre, p.precio_promedio, p.unidad_standar FROM existencias e INNER JOIN productos p ON e.codigo_producto = p.referencia WHERE e.codigo_bodega IN (SELECT bodega_seleccionada FROM proyectos_enc WHERE id_proyecto = :proyecto_id)";
    $params_productos = array("proyecto_id");
    $response_productos = $data->query($sql_productos, $params, $params_productos);

    $sql_activos = "SELECT * FROM activo";
    $response_activos = $data->query($sql_activos, array(), array());
?>
<style type="text/css" media="screen">
	tbody, td {
    text-align: center;
  }
</style>
<section class="content-header">
  <h1>
    <i class="fa fa-list-alt"></i>&nbsp;Ingreso de actividades
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=siembra"><i class="fa fa-leaf"></i>&nbsp;Administraci&oacute;n de proyectos</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-list-alt"></i>&nbsp;Ingreso de actividades</li>
  </ol>
</section>
<section class="content">
	<div class="box box-success">
	<!-- /.box-header -->
	<div class="box-body">
	<form action="" role="form" name="frmactividades" id="frmactividades" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
		<input type="hidden" value="<?php echo $_POST['proyecto_id']?>" name="enc_id" id="enc_id" readonly>
		<fieldset>
                <!-- <legend>title or explanatory caption</legend> -->
            <div class="form-group col-md-2">
                <label>Fecha: </label>
                <input type="text" class="form-control" data-provide="datepicker" name="fecha" id="fecha" data-validation="required" data-validation-error-msg="Seleccione fecha" placeholder="dd-mm-yyyy" readonly>
            </div>
            <div class="form-group col-md-6">
                <label>Actvidad: </label>
                <select class="form-control" name="actividad" id="actividad" data-validation="required" data-validation-error-msg="Seleccione actividad">
                    <option value="">Seleccione actividad</option>
                    <?php foreach ($response_controles['items'] as $key_controles) { ?>
                        <option value="<?php echo $key_controles['nombre']?>"><?php echo $key_controles['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Tipo: </label>
                <select class="form-control" name="tipo" id="tipo" data-validation="required" data-validation-error-msg="Seleccione tipo" onchange="tipo_mostrar($('#tipo').val());">
                    <option value="">Seleccione tipo</option>
                    <option value="material">Material</option>
                    <option value="mano de obra">Mano de obra</option>
                    <option value="deterioro activo">Deterioro activo</option>
                </select>
            </div>
        </fieldset>
		<fieldset>
            <!-- <legend>title or explanatory caption</legend> -->
            <div class="form-group col-md-2" id="div_mano_obra">
                <label>Mano de obra: </label>
                <input type="text" class="form-control" name="costo" id="costo" placeholder="$0.00" data-validation="required" data-validation-error-msg="Ingrese cantidad" maxlength="6">
            </div>
            <div class="form-group col-md-3" id="div_activo">
                <label>Activo: </label>
                <select class="form-control" name="activo" id="activo" data-validation="required" data-validation-error-msg="Seleccione activo">
                    <option value="">Seleccione activo</option>
                    <?php foreach ($response_activos['items'] as $key_activos) { ?>
                    <option value="<?php echo $key_activos['nombre']?>"><?php echo $key_activos['nombre']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-3" id="div_producto">
                <label>Producto: </label>
                <select class="form-control" name="producto" id="producto" data-validation="required" data-validation-error-msg="Seleccione producto" onchange="change($('#producto').val());">
                    <option value="">Seleccione producto</option>
                    <?php foreach ($response_productos['items'] as $key_productos) { ?>
                    <option value="<?php echo $key_productos['nombre'].','.$key_productos['unidad_standar'] ?>"><?php echo $key_productos['nombre'] ?></option>
                        <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-3" id="div_unidad">
                <label>Unidad: </label>
                <select class="form-control" name="unidad" id="unidad" data-validation="required" data-validation-error-msg="Seleccione unidad">
                    <option value="">Seleccione unidad</option>
                </select>
            </div>
            <div class="form-group col-md-2" id="div_dias_cant">
                <label>D&iacute;as/Cantidad: </label>
                <input type="text" class="form-control solo_numeros" name="dias_cant" id="dias_cant" data-validation="required" data-validation-error-msg="Ingrese d&iacute;as o cantidad" maxlength="6" onkeyup="subtotales()" placeholder="0.00">
            </div>
            <div class="form-group col-md-2" id="div_horas_uso">
                <label>Horas de uso: </label>
                <input type="text" class="form-control" name="horas_uso" id="horas_uso" data-validation="required" data-validation-error-msg="Ingrese d&iacute;as o cantidad" onkeyup="subtotales()">
            </div>
            <div class="form-group col-md-2" id="div_subtotal">
                <label>Subtotal: </label>
                <input type="text" class="form-control solo_numeros" name="subtotal" id="subtotal" data-validation="required" data-validation-error-msg="Ingrese d&iacute;as o cantidad" readonly placeholder="0.00">
            </div>
            <div class="form-group col-md-1" id="div_boton">
                <label>Agregar</label>
                <button type="button" class="btn btn-success" onclick="add()"><i class="fa white fa-plus-square"></i></button>
            </div>
        </fieldset>
        <div style="clear:both;"></div>
        <div class="table-responsive">
        	<div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
              	<thead>
                  <tr class="bg bg-navy">
                    <th width="9.1%"><center>
                        Fecha
                    </center></th>
                    <th width="13.3%"><center>
                        Actvidad
                    </center></th>
                    <th width="9.3%"><center>
                        Tipo
                    </center></th>
                    <th width="9.3%"><center>
                        Mano de obra
                    </center></th>
                    <th width="12.3%"><center>
                        Activo
                    </center></th>
                    <th width="9.3%"><center>
                        Producto
                    </center></th>
                    <th width="6.1%"><center>
                        Horas uso
                    </center></th>
                    <th width="5.1%"><center>
                        Unidad
                    </center></th>
                    <th width="5.1%"><center>
                        Dias/Cantidad
                    </center></th>
                    <th width="7.1%"><center>
                        Subtotal
                    </center></th>
                    <th width="4.1%"><center>
                        Acci&oacute;n
                    </center></th>
                  </tr>
               </thead>
           	   </table>
               <div style="height:280px; top: 0; overflow-y:scroll; overflow-x:hidden;">
               	<table class="table table-condensed">
	                <tbody id="detalle_actividad">
	              	</tbody>
          	  	</table>
               </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="form-group col-md-12">
		  <label>Nota</label>
		  <textarea class="form-control" rows="4" name="notas" id="notas"></textarea>
		</div>
		<div class="box-footer">
			<button type="button" onClick="location.reload()" class="btn btn-danger pull-left">Cancelar</button>
		    <button type="submit" name="guardar" class="btn btn-primary pull-right" id="guardar" name="guardar">Guardar</button>
		</div>
	</form>
	</div>
	<!-- /.box-body -->
	</div>
</section>
<?php } ?>
<script type="text/javascript">
//Oculta todos los campos al entrar o recargar la pagina
$(document).ready(function(){
    $('#div_mano_obra').hide();
    $('#costo').prop('disable', true);
    $('#div_producto').hide();
    $('#producto').prop('disable', true);
    $('#div_unidad').hide();
    $('#unidad').prop('disable', true);
    $('#div_dias_cant').hide();
    $('#dias_cant').prop('disable', true);
    $('#div_subtotal').hide();
    $('#subtotal').prop('disable', true);
    $('#div_activo').hide();
    $('#activo').prop('disable', true);
    $('#div_horas_uso').hide();
    $('#horas_uso').prop('disable', true);
    $('#div_boton').hide();
});

// Nos identifica el tipo de unidad que se selecciona y muestra su equivalente standar
function change(standar){
    var unidad = standar.split(',');
    var tunidad = unidad[1];
    if (tunidad == 'kg') {
        $('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>,"
            +"<option value='qq'>Quintal</option>,"
            +"<option value='g'>Gramos</option>,"
            +"<option value='kg'>Kilogramos</option>,"
            +"<option value='oz'>Onzas</option>,"
            +"<option value='lb'>Libras</option>");
    } else if(tunidad == 'lt') {
        $('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>,"
            +"<option value='lt'>Litros</option>,"
            +"<option value='ml'>Mililitros</option>");
    } else {
        $('select[name="unidad"]').html("<option value=''>Seleccione unidad</option>")
    }
}

// Funcion que nos permite ocultar o mostrar campos segun sea la necesidad
function tipo_mostrar(value){
    switch(value){
        case 'material':
            $('#costo').prop('disable', true);
            $('#div_mano_obra').hide();
            $('#producto').attr('disabled', false);
            $('#div_producto').show();
            $('#unidad').attr('disabled', false);
            $('#div_unidad').show();
            $('#dias_cant').attr('disabled', false);
            $('#div_dias_cant').show();
            $('#div_boton').show();
            $('#div_activo').hide();
            $('#activo').prop('disable', true);
            $('#div_horas_uso').hide();
            $('#horas_uso').prop('disable', true);
            $('#div_subtotal').show();
            $('#subtotal').attr('readonly', true);
        break;
        case 'mano de obra':
            $('#costo').attr('disabled', false);
            $('#div_mano_obra').show();
            $('#producto').attr('disabled', true);
            $('#div_producto').hide();
            $('#unidad').attr('disabled', true);
            $('#div_unidad').hide();
            $('#dias_cant').attr('disabled', false);
            $('#div_dias_cant').show();
            $('#div_boton').show();
            $('#div_activo').hide();
            $('#activo').prop('disable', true);
            $('#div_horas_uso').hide();
            $('#horas_uso').prop('disable', true);
            $('#div_subtotal').show();
            $('#subtotal').attr('readonly', false);
        break;
        case 'deterioro activo':
            $('#activo').attr('disable', false);
            $('#div_activo').show();
            $('#horas_uso').attr('disable', false);
            $('#div_horas_uso').show();
            $('#div_boton').show();
            $('#div_producto').hide();
            $('#producto').prop('disable', true);
            $('#div_unidad').hide();
            $('#unidad').prop('disable', true);
            $('#div_dias_cant').hide();
            $('#dias_cant').prop('disable', true);
            $('#div_mano_obra').hide();
            $('#costo').prop('disable', true);
            $('#div_subtotal').show();
            $('#subtotal').attr('readonly', true);
        break;
        case '':
            $('#div_mano_obra').hide();
            $('#costo').prop('disable', true);
            $('#div_producto').hide();
            $('#producto').prop('disable', true);
            $('#div_unidad').hide();
            $('#unidad').prop('disable', true);
            $('#div_dias_cant').hide();
            $('#dias_cant').prop('disable', true);
            $('#div_activo').hide();
            $('#activo').prop('disable', true);
            $('#div_horas_uso').hide();
            $('#horas_uso').prop('disable', true);
            $('#div_boton').hide();
            $('#div_subtotal').hide();
            $('#subtotal').prop('disable', true);
    }
}

//Funcion que nos permite limpiar los campos dias_cant y subtotal al hacer cambio en producto o unidad
$(document).ready(function(){
    $('select[name="tipo"]').change(function () {
        $("#dias_cant").val('');
        $("#horas_uso").val('');
        $("#subtotal").val('');
    });
    $('select[name="activo"]').change(function () {
        $("#horas_uso").val('');
        $("#subtotal").val('');
    });
    $('select[name="producto"]').change(function () {
        $("#dias_cant").val('');
        $("#subtotal").val('');
    });
    $('select[name="unidad"]').change(function () {
        $("#dias_cant").val('');
        $("#subtotal").val('');
    });
    $('.solo_numeros').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9\.]/g, '');
    });
});

// Funcion que nos calcula los subtotales
function subtotales(){
    var tipo = $("#tipo").val();
    var product = $("#producto").val();
    var tunidad = product.split(',');
    var producto = tunidad[0];
    var unidad = $("#unidad").val();
    var cantidad = $("#dias_cant").val();
    var activo = $("#activo").val();
    var horas_uso = $("#horas_uso").val();
    //var num = $("#number").val();
    $.ajax({
        url: "procesos/siembra/subtotales.php",
        type:"POST",
        dataType:"json",
        data:{'tipo':tipo, 'producto':producto, 'unidad':unidad, 'cantidad':cantidad, 'activo':activo, 'horas_uso':horas_uso/*, 'numver':num*/},
        success: function(response){
            $("#subtotal").val(response.subtotal);
        }
    });
}

// Funcion que nos permite agregar actividades a la tabla
function add(){
    var fecha = $("#fecha").val();
    var actividad = $("#actividad").val();
    var tipo = $("#tipo").val();
    var costo = $("#costo").val();
    var activo = $("#activo").val();
    var product = $("#producto").val();
    var tunidad = product.split(',');
    var producto = tunidad[0];
    var unidad = $("#unidad").val();
    var dia_cant = $("#dias_cant").val();
    var hora_uso = $("#horas_uso").val();
    var subtotal = $("#subtotal").val();
    if(fecha == ""){
        $("#fecha").focus();
    } else if (actividad == "") {
        $("#actividad").focus();
    }else{
        $.ajax({
            url: "procesos/siembra/agregar_actividades.php",
            type: "POST",
            dataType: "json",
            data: {'fecha':fecha,'actividad':actividad,'tipo':tipo,'costo':costo,'activo':activo,'producto':producto,'unidad':unidad,'dias_cant':dia_cant,'horas_uso':hora_uso,'subtotal':subtotal}
        }).done(function(data){
            total=data.length;
            var opciones;
            if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td width='9.1%'>"+data[i].fecha+"</td>"
                            +"<td width='13.1%'>"+data[i].actividad+"</td>"
                            +"<td width='9.1%'>"+data[i].tipo+"</td>"
                            +"<td width='9.1%'>"+data[i].costo+"</td>"
                            +"<td width='12.1%'>"+data[i].activo+"</td>"
                            +"<td width='9.1%'>"+data[i].producto+"</td>"
                            +"<td width='6.1%'>"+data[i].horas_uso+"</td>"
                            +"<td width='5.1%'>"+data[i].unidad+"</td>"
                            +"<td width='9.1%'>"+data[i].dias_cant+"</td>"
                            +"<td width='7.1%'>"+data[i].subtotal+"</td>"
                            +"<td width='4.1%'><a href='#' class='label label-danger' onsubmit='return false' onClick=\"quitar('"+data[i].actividad+"','"+data[i].tipo+"');\"><i class='fa white fa-trash'></i></a></td></tr>";
                }
                $('#detalle_actividad').html(opciones);
            }            
        });
    }
}

// quitar articulos de tabla
function quitar(actividad,tipo){
    //incluir alert confirm y hacer accion en caso de YES
    if(actividad!="" || tipo!=""){
        $.ajax({
            url: "procesos/siembra/quitar_actividad.php",
            type: "POST",
            dataType: "json",
            data: {'actividad':actividad,'tipo':tipo}
        }).done(function(data){
            total=data.length;
            var opciones;
            if(total>0){
                for(var i=0; i<total; i++){
                    opciones+="<tr><td width='9.1%'>"+data[i].fecha+"</td>"
                            +"<td width='13.1%'>"+data[i].actividad+"</td>"
                            +"<td width='9.1%'>"+data[i].tipo+"</td>"
                            +"<td width='9.1%'>"+data[i].costo+"</td>"
                            +"<td width='12.1%'>"+data[i].activo+"</td>"
                            +"<td width='9.1%'>"+data[i].producto+"</td>"
                            +"<td width='6.1%'>"+data[i].horas_uso+"</td>"
                            +"<td width='5.1%'>"+data[i].unidad+"</td>"
                            +"<td width='9.1%'>"+data[i].dias_cant+"</td>"
                            +"<td width='7.1%'>"+data[i].subtotal+"</td>"
                            +"<td width='4.1%'><a href='#' class='label label-danger' onsubmit='return false' onClick=\"quitar('"+data[i].actividad+"','"+data[i].tipo+"');\"><i class='fa white fa-trash'></i></a></td></tr>";
                }
                $('#detalle_actividad').html(opciones);
            }else{
                $('#detalle_actividad').html("");
            }
        });
    }
}

//Guardar datos a la BD
$('#guardar').click(function () {
    var formulario = document.getElementById("frmactividades");
    var formData = new FormData(formulario);
    $.ajax({
        url: "procesos/siembra/guardar_actividad.php",
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
});
</script>