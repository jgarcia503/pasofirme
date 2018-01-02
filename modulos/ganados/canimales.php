<?php
$sql_razas="SELECT nombre FROM razas";
$response_razas=$data->query($sql_razas, array(), array());
$sql_colores="SELECT nombre FROM colores";
$response_colores=$data->query($sql_colores, array(), array());
$sql_grupo="SELECT * FROM grupos";
$response_grupo=$data->query($sql_grupo, array(), array());
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-plus-circle"></i>&nbsp;Ingreso de animales
  </h1>
  <ol class="breadcrumb">
    <li><a href="?mod=inicio"><i class="fa fa-home"></i>&nbsp;Inicio</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li><a href="?mod=vanimales"><i class="fa fa-paw"></i>&nbsp;Administraci&oacute;n de animales</a></li>
    &nbsp;&nbsp;
    <i class="fa fa-angle-right" style="color: #0C0303"></i>
    &nbsp;&nbsp;
    <li class="active"><i class="fa fa-plus-circle"></i>&nbsp;Ingreso de animales</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Datos Generales</a></li>
        <li><a href="#tab_2" data-toggle="tab">Genealog&iacute;a</a></li>
        <li><a href="#tab_3" data-toggle="tab">Fenotipo</a></li>
        <li><a href="#tab_4" data-toggle="tab">Foto</a></li>
        <li><a href="#tab_5" data-toggle="tab">Clase</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <form action="" role="form" name="frmanimales" id="frmanimales" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
            <fieldset>
            <div class="form-group col-md-4">
                <label>Arete Paso Firme: </label>
                <input type="text" class="form-control" name="arete" id="arete" data-validation="required" data-validation-error-msg="Complete este campo" placeholder="00">
            </div>
            <div class="form-group col-md-4">
                <label>Peso destete: </label>
                <input type="text" class="form-control" name="pesodestete" id="pesodestete" placeholder="0.00">
            </div>
            <div class="form-group col-md-4">
                <label>Sexo: </label>
                <select class="form-control" name="sexo" id="sexo" data-validation="required" data-validation-error-msg="Seleccione el sexo del animal">
                  <option value="">Seleccione sexo</option>
                  <option value="Hembra">Hembra</option>
                  <option value="Macho">Macho</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Nombre: </label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="" data-validation="required" data-validation-error-msg="Complete este campo">
            </div>
            <div class="form-group col-md-4">
                <label>Arete MAG: </label>
                <input type="text" class="form-control" name="aretemag" id="aretemag" placeholder="00">
            </div>
            <div class="form-group col-md-4">
                <label>Estado: </label>
                <select class="form-control" name="estado" id="estado" data-validation="required" data-validation-error-msg="Seleccione estado del animal">
                  <option value="">Seleccione estado</option>
                  <option value="Muerto">Muerto</option>
                  <option value="Activo">Activo</option>
                  <option value="Vendido">Vendido</option>
                  <option value="Externo">Externo</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Fecha de nacimiento: </label>
                <input type="text" class="form-control datepicker" name="fnacimiento" id="fnacimiento" placeholder="yyyy-mm-dd" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Procedencia: </label>
                <input type="text" class="form-control" name="procedencia" id="procedencia" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Raza: </label>
                <select class="form-control" name="raza" id="raza">
                  <option value="">Seleccione raza</option>
                  <?php foreach ($response_razas['items'] as $key_razas) { ?>
                  <option value="<?php echo $key_razas['nombre']?>"><?php echo $key_razas['nombre'] ?></option>
                  <?php } ?>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Fecha de destete: </label>
                <input type="text" class="form-control datepicker" name="fdestete" id="fdestete" placeholder="yyyy-mm-dd" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Precio compra: </label>
                <input type="text" class="form-control" name="pcompra" id="pcompra" placeholder="0.00">
            </div>
            <div class="form-group col-md-4">
                <label>Tipo: </label>
                <select class="form-control" name="tipo" id="tipo" data-validation="required" data-validation-error-msg="Seleccione tipo">
                  <option value="">Seleccione tipo</option>
                  <option value="lechero">Lechero</option>
                  <option value="carne">Carne</option>
                  <option value="doble proposito">Doble proposito</option>
                  <option value="puro">Puro</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Peso de nacimiento: </label>
                <input type="text" class="form-control" name="pnacimiento" id="pnacimiento" placeholder="0.00">
            </div>
            <div class="form-group col-md-4">
                <label>Parto: </label>
                <select class="form-control" name="parto" id="parto">
                  <option value="">Seleccione parto</option>
                  <option value="primero">Primero</option>
                  <option value="segundo">Segundo</option>
                  <option value="tercero">Tercero</option>
                  <option value="cuarto">Cuarto</option>
                  <option value="quinto">Quinto</option>
                  <option value="sexto">Sexto</option>
                  <option value="septimo">Septimo</option>
                  <option value="octavo">Octavo</option>
                  <option value="noveno">Noveno</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Color: </label>
                <select class="form-control" name="color" id="color">
                  <option value="">Seleccione color</option>
                  <?php foreach ($response_colores['items'] as $key_colores) { ?>
                  <option value="<?php echo $key_colores['nombre']?>"><?php echo $key_colores['nombre']?></option>
                  <?php } ?>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
              <input type="checkbox" name="marca_hierro" id="marca_hierro" value="si">
              &nbsp;&nbsp;
              <label class="form-check-label">Marca de Hierro</label>
            </div>
            <div class="form-group col-md-4">
                <label>Grupo: </label>
                <select class="form-control" name="grupo" id="grupo">
                  <option value="">Seleccione grupo</option>
                  <?php foreach ($response_grupo['items'] as $key_grupo) { ?>
                  <option value="<?php echo $key_grupo['id']?>"><?php echo $key_grupo['nombre']?></option>
                  <?php } ?>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas: </label>
              <textarea class="form-control" name="notas" id="notas" rows="7"></textarea>
            </div>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <fieldset>
            <div class="form-group col-md-4">
                <label>Padre: </label>
                <input type="text" class="form-control" name="padre" id="padre" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Madre: </label>
                <input type="text" class="form-control" name="madre" id="madre" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Concepci&oacute;n: </label>
                <select class="form-control" name="concepcion" id="concepcion">
                  <option value="">Seleccione concepcion</option>
                  <option value="monta">Monta</option>
                  <option value="inseminacion">Inseminaci&oacute;n</option>
                  <option value="te">Transferencia de embriones</option>
                  <option value="fiv">Fecundaci&oacute;n in vitro</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Abuelo materno: </label>
                <input type="text" class="form-control" name="amaterno" id="amaterno" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Abuelo paterno: </label>
                <input type="text" class="form-control" name="apaterno" id="apaterno" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Donadora: </label>
                <input type="text" class="form-control" name="donadora" id="donadora" placeholder="">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-6">
                <label>Abuela materna: </label>
                <input type="text" class="form-control" name="amaterna" id="amaterna" placeholder="">
            </div>
            <div class="form-group col-md-6">
                <label>Abuela paterna: </label>
                <input type="text" class="form-control" name="apaterna" id="apaterna" placeholder="">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas: </label>
              <textarea class="form-control" name="notas" id="notas" rows="7"></textarea>
            </div>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          <fieldset>
            <div class="form-group col-md-4">
                <label>Condici&oacute;n corporal: </label>
                <select class="form-control" name="ccorporal" id="ccorporal">
                  <option value="">Seleccione condici&oacute;n corporal</option>
                  <?php $cc=1; for (; $cc <= 5 ; $cc+=0.25) { ?>
                    <option value="<?php echo $cc?>"><?php echo $cc ?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Aplomos corvej&oacute;n: </label>
                <input type="text" class="form-control" name="acorvejon" id="acorvejon" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Grupa ancho: </label>
                <select class="form-control" name="gancho" id="gancho">
                  <option value="">Seleccione grupa ancho</option>
                  <option value="ancha">Ancha</option>
                  <option value="media">Media</option>
                  <option value="estrecha">Estrecha</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Temperamento: </label>
                <input type="text" class="form-control" name="temperamento" id="temperamento" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Aplomos cuartillas: </label>
                <input type="text" class="form-control" name="acuartillas" id="acuartillas" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>Grupa angulo: </label>
                <select class="form-control" name="gangulo" id="gangulo">
                  <option value="">Seleccione grupa angulo</option>
                  <option value="plana">Plana</option>
                  <option value="leve">Leve</option>
                  <option value="pronunciada">Pronunciada</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Estado de los cachos: </label>
                <select class="form-control" name="estado_cachos" id="estado_cachos">
                  <option value="">Seleccione estado de los cachos</option>
                  <option value="cuernos">Cuernos</option>
                  <option value="descornado">Descornado</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Aplomos cascos: </label>
                <input type="text" class="form-control" name="acascos" id="acascos" placeholder="">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas: </label>
              <textarea class="form-control" name="notas" id="notas" rows="7"></textarea>
            </div>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
          <fieldset>
            <div class="form-group col-md-12">
              <label>Foto a actualizar</label>
              <input type="file" name="ganado" id="ganado" accept="image/*" onchange="loadFile(event)">
              <img id="foto" width="240" height="200" class="img-rounded">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas: </label>
              <textarea class="form-control" name="notas" id="notas" rows="7"></textarea>
            </div>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_5">
          <fieldset>
            <div class="form-group col-md-4">
                <label>Cuenta contable: </label>
                <input type="text" class="form-control" name="ccontable" id="ccontable" data-validation="required" data-validation-error-msg="Carge el dato de la tabla" placeholder="" readonly>
            </div>
          </fieldset>
          <fieldset>
            <table role="grid" id="tabla_cuenta" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th width="10%"><center>
                      N°
                    </center></th>
                    <th width="40%"><center>
                      Cuenta
                    </center></th>
                    <th width="50%"><center>
                      Descripci&oacute;n
                    </center></th>
                  </tr>
               </thead>
               <?php
                $cont = 1;
                $response_ccontable = $dataTable->obtener_cuenta_contable();
                ?>
               <tbody>
                <?php foreach($response_ccontable['items'] as $datos_ccontable){ ?>
                  <tr>
                    <td><center>
                        <?php echo $cont ?>
                    </center></td>
                    <td>
                      <a href="#" class="cuenta_id"><?php echo $datos_ccontable['cuenta_id']?></a>
                      <input type="hidden" id="<?php echo $datos_ccontable['cuenta_id']?>" value="<?php echo $datos_ccontable['sumariza'].'/'.$datos_ccontable['descripcion']?>">
                    </td>
                    <td>
                      <?php echo $datos_ccontable['descripcion'] ?>
                    </td>
                  </tr>
                  <?php  
                $cont ++;
                    } ?>
               </tbody>
            </table>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="box-footer">
          <button type="button" onClick="?mod=vanimales" class="btn btn-danger pull-left"><i class="fa white fa-remove"></i>&nbsp;Cancelar</button>
          <button type="submit" class="btn btn-primary pull-right" id="guardar" name="guardar"><i class="fa white fa-save"></i>&nbsp;Guardar</button>
        </div>
        </form>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
</section>
<script type="text/javascript">
var loadFile = function(event) {
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('foto');
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
};

$(document).ready(function(){
  $("#tabla_cuenta").dataTable({                
      "sPaginationType": "full_numbers"
  });
});

//Funcion para pasar el valor al input de la cuenta contable
$('.table').on('click','.cuenta_id',function(e){
    e.preventDefault();
    $('#ccontable').val( $(this).html());
});

// Funcion que nos permitira almacenar en la BD
$(document).ready(function () {
    $('#guardar').click(function () {
        $.validate({
            onSuccess : function(form) {
                var formulario = document.getElementById("frmanimales");
                var formData = new FormData(formulario);
                $.ajax({
                    url: "procesos/ganado/guardar_animal.php",
                    type: "POST",
                    dataType: "Json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $.blockUI({ message: '<h1><img src="img/loading.gif"/> Espere un momento...</h1>' });
                    },
                    success: function(response){
                        if (response.success == true) {
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href = "?mod=vanimales";}}}});
                        }else{
                            $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
                        }
                    },
                    error: function() {
                        $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Ocurrio un error al realizar la transaccion', content: 'Error', type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});
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