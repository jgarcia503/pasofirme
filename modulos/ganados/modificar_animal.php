<?php
if (isset($_POST['id_animal'])) {
  $params=$_POST;
  $sql_animales="SELECT * FROM animales WHERE id = :id_animal";
  $params_animales=array("id_animal");
  $response_animales=$data->query($sql_animales, $params, $params_animales);
  $sql_razas="SELECT nombre FROM razas";
  $response_razas=$data->query($sql_razas, array(), array());
  $sql_colores="SELECT nombre FROM colores";
  $response_colores=$data->query($sql_colores, array(), array());
  $sql_grupo="SELECT *FROM grupos";
  $response_grupo=$data->query($sql_grupo, array(), array());
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-pencil-square-o"></i>&nbsp;Modificar animal
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
    <li class="active"><i class="fa fa-pencil-square-o"></i>&nbsp;Modificar animal</li>
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
        <li><a href="#tab_4" data-toggle="tab">Clase</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
        <form action="" role="form" name="frmmodanimales" id="frmmodanimales" enctype="multipart/form-data" autocomplete="off" onsubmit="return false">
          <fieldset>
            <div class="form-group col-md-4">
                <label>Arete Paso Firme: </label>
                <input type="text" class="form-control" name="arete" id="arete" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['numero']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Peso destete: </label>
                <input type="text" class="form-control" name="pesodestete" id="pesodestete" placeholder="0.00" value="<?php echo $response_animales['items'][0]['peso_deteste']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Sexo: </label>
                <select class="form-control" name="sexo" id="sexo" data-validation="required" data-validation-error-msg="Seleccione sexo">
                  <option value="">Seleccione sexo</option>
                  <option value="Hembra" <?php if ($response_animales['items'][0]['sexo']=='Hembra') echo 'selected' ?>>Hembra</option>
                  <option value="Macho" <?php if ($response_animales['items'][0]['sexo']=='Macho') echo 'selected' ?>>Macho</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Nombre: </label>
                <input type="text" class="form-control" name="nombre" id="nombre" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['nombre']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Arete MAG: </label>
                <input type="text" class="form-control" name="aretemag" id="aretemag" placeholder="" value="<?php echo $response_animales['items'][0]['marca_oreja']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Estado: </label>
                <select class="form-control" name="estado" id="estado" data-validation="required" data-validation-error-msg="Seleccione estado">
                  <option value="">Seleccione estado</option>
                  <option value="Muerto" <?php if($response_animales['items'][0]['estado']=='Muerto') echo 'selected' ?>>Muerto</option>
                  <option value="Activo" <?php if($response_animales['items'][0]['estado']=='Activo') echo 'selected' ?>>Activo</option>
                  <option value="Vendido" <?php if($response_animales['items'][0]['estado']=='Vendido') echo 'selected' ?>>Vendido</option>
                  <option value="Externo" <?php if($response_animales['items'][0]['estado']=='Externo') echo 'selected' ?>>Externo</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Fecha de nacimiento: </label>
                <input type="text" class="form-control datepicker" name="fnacimiento" id="fnacimiento" data-validation="required" data-validation-error-msg="" placeholder="yyyy-mm-dd" value="<?php echo $response_animales['items'][0]['fecha_nacimiento']?>" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Procedencia: </label>
                <input type="text" class="form-control" name="procedencia" id="procedencia" placeholder="" value="<?php echo $response_animales['items'][0]['procedencia']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Raza: </label>
                <select class="form-control" name="raza" id="raza" data-validation="required" data-validation-error-msg="Seleccione raza">
                  <option value="">Seleccione raza</option>
                  <?php foreach ($response_razas['items'] as $key_razas) { ?>
                  <option value="<?php echo $key_razas['nombre']?>" <?php ($key_razas['nombre']==$response_animales['items'][0]['raza'])?'selected':''?>><?php echo $key_razas['nombre'] ?></option>
                  <?php } ?>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Fecha de destete: </label>
                <input type="text" class="form-control datepicker" name="fdestete" id="fdestete" data-validation="required" data-validation-error-msg="" placeholder="yyyy-mm-dd" value="<?php echo $response_animales['items'][0]['fecha_deteste']?>" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Precio compra: </label>
                <input type="text" class="form-control" name="pcompra" id="pcompra" placeholder="0.00" value="<?php echo $response_animales['items'][0]['precio_venta']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Tipo: </label>
                <select class="form-control" name="tipo" id="tipo" data-validation="required" data-validation-error-msg="Seleccione tipo">
                  <option value="">Seleccione tipo</option>
                  <option value="lechero"  <?php if($response_animales['items'][0]['tipo']=='lechero') echo 'selected' ?>>Lechero</option>
                  <option value="carne" <?php if($response_animales['items'][0]['tipo']=='carne') echo 'selected' ?>>Carne</option>
                  <option value="doble proposito" <?php if($response_animales['items'][0]['tipo']=='doble proposito') echo 'selected' ?>>Doble proposito</option>
                  <option value="puro" <?php if($response_animales['items'][0]['tipo']=='puro') echo 'selected' ?>>Puro</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Peso de nacimiento: </label>
                <input type="text" class="form-control" name="pnacimiento" id="pnacimiento" data-validation="required" data-validation-error-msg="" placeholder="0.00" value="<?php echo $response_animales['items'][0]['peso_nacimiento']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Parto: </label>
                <select class="form-control" name="parto" id="parto" data-validation="required" data-validation-error-msg="Seleccione parto">
                  <option value="">Seleccione parto</option>
                  <option value="primero"  <?php if($response_animales['items'][0]['parto']=='primero') echo 'selected' ?>>Primero</option>
                  <option value="segundo" <?php if($response_animales['items'][0]['parto']=='segundo') echo 'selected' ?>>Segundo</option>
                  <option value="tercero" <?php if($response_animales['items'][0]['parto']=='tercero') echo 'selected' ?>>Tercero</option>
                  <option value="cuarto" <?php if($response_animales['items'][0]['parto']=='cuarto') echo 'selected' ?>>Cuarto</option>
                  <option value="quinto" <?php if($response_animales['items'][0]['parto']=='quinto') echo 'selected' ?>>Quinto</option>
                  <option value="sexto" <?php if($response_animales['items'][0]['parto']=='sexto') echo 'selected' ?>>Sexto</option>
                  <option value="septimo" <?php if($response_animales['items'][0]['parto']=='septimo') echo 'selected' ?>>Septimo</option>
                  <option value="octavo" <?php if($response_animales['items'][0]['parto']=='octavo') echo 'selected' ?>>Octavo</option>
                  <option value="noveno" <?php if($response_animales['items'][0]['parto']=='noveno') echo 'selected' ?>>Noveno</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Color: </label>
                <select class="form-control" name="color" id="color" data-validation="required" data-validation-error-msg="Seleccione color">
                  <option value="">Seleccione color</option>
                  <?php foreach ($response_colores['items'] as $key_colores) { ?>
                  <option value="<?php echo $key_colores['nombre']?>" <?php ($key_colores['nombre']==$response_animales['items'][0]['color'])?'selected':''?>><?php echo $key_colores['nombre']?></option>
                  <?php } ?>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
              <input type="checkbox" name="" value="si">
              &nbsp;&nbsp;
              <label class="form-check-label">Marca de Hierro</label>
            </div>
            <div class="form-group col-md-4">
                <label>Grupo: </label>
                <select class="form-control" name="grupo" id="grupo" data-validation="required" data-validation-error-msg="Seleccione grupo">
                  <option value="">Seleccione grupo</option>
                  <?php foreach ($response_grupo['items'] as $key_grupo) { ?>
                  <option value="<?php echo $key_grupo['id']?>" <?php ($key_grupo['id']==$response_animales['items'][0]['grupo'])?'selected':''?>><?php echo $key_grupo['nombre']?></option>
                  <?php } ?>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas: </label>
              <textarea class="form-control" name="notas" id="notas" rows="7"><?php echo $response_animales['items'][0]['notas'] ?></textarea>
            </div>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <fieldset>
            <div class="form-group col-md-4">
                <label>Padre: </label>
                <input type="text" class="form-control" name="padre" id="padre" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['padre']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Madre: </label>
                <input type="text" class="form-control" name="madre" id="madre" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['madre']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Concepci&oacute;n: </label>
                <select class="form-control" name="concepcion" id="concepcion" data-validation="required" data-validation-error-msg="Seleccione concepcion">
                  <option value="">Seleccione concepcion</option>
                  <option value="monta">monta</option>
                  <option value="inseminacion">inseminacion</option>
                  <option value="te">tranferencia embriones</option>
                  <option value="fiv">fecundacion in vitro</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Abuelo materno: </label>
                <input type="text" class="form-control" name="amaterno" id="amaterno" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['abuelo_materno']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Abuelo paterno: </label>
                <input type="text" class="form-control" name="apaterno" id="apaterno" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['abuelo_paterno']?>">
            </div>
            <div class="form-group col-md-4" id="div_donadora">
                <label>Donadora: </label>
                <input type="text" class="form-control" name="donadora" id="donadora" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['donadora']?>">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-6">
                <label>Abuela materna: </label>
                <input type="text" class="form-control" name="amaterna" id="amaterna" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['abuela_materna']?>">
            </div>
            <div class="form-group col-md-6">
                <label>Abuela paterna: </label>
                <input type="text" class="form-control" name="apaterna" id="apaterna" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['abuela_paterna']?>">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas: </label>
              <textarea class="form-control" name="notas" id="notas" rows="7"><?php echo $response_animales['items'][0]['notas'] ?></textarea>
            </div>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          <fieldset>
            <div class="form-group col-md-4">
                <label>Condici&oacute;n corporal: </label>
                <select class="form-control" name="ccorporal" id="ccorporal" data-validation="required" data-validation-error-msg="Seleccione condici&oacute;n corporal">
                  <option value="">Seleccione condici&oacute;n corporal</option>
                  <?php $cc=1; for (; $cc <= 5 ; $cc+=0.25) { ?>
                    <option value="<?php echo $cc?>" <?php ($cc==$response_animales['items'][0]['estructura'])?'selected':'' ?>><?php echo $cc ?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Aplomos corvej&oacute;n: </label>
                <input type="text" class="form-control" name="acorvejon" id="acorvejon" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['aplomos_corvejon']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Grupa ancho: </label>
                <select class="form-control" name="gancho" id="gancho" data-validation="required" data-validation-error-msg="Seleccione grupa ancho">
                  <option value="">Seleccione grupa ancho</option>
                  <option value="ancha" <?php echo $response_animales['items'][0]['grupa_ancho']=='ancha'?'selected':'' ?>>Ancha</option>
                  <option value="media" <?php echo $response_animales['items'][0]['grupa_ancho']=='media'?'selected':'' ?>>Media</option>
                  <option value="estrecha" <?php echo $response_animales['items'][0]['grupa_ancho']=='estrecha'?'selected':'' ?>>Estrecha</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Temperamento: </label>
                <input type="text" class="form-control" name="temperamento" id="temperamento" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['temperamento']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Aplomos cuartillas: </label>
                <input type="text" class="form-control" name="acuartillas" id="acuartillas" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['aplomos_cuartillas']?>">
            </div>
            <div class="form-group col-md-4">
                <label>Grupa angulo: </label>
                <select class="form-control" name="gangulo" id="gangulo" data-validation="required" data-validation-error-msg="Seleccione grupa angulo">
                  <option value="">Seleccione grupa angulo</option>
                  <option value="plana" <?php echo $response_animales['items'][0]['grupa_angulo']=='plana'?'selected':'' ?>>Plana</option>
                  <option value="leve" <?php echo $response_animales['items'][0]['grupa_ancho']=='leve'?'selected':'' ?>>Leve</option>
                  <option value="pronunciada" <?php echo $response_animales['items'][0]['grupa_ancho']=='pronunciada'?'selected':'' ?>>Pronunciada</option>
                </select>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-4">
                <label>Estado de los cachos: </label>
                <select class="form-control" name="estado_cachos" id="estado_cachos" data-validation="required" data-validation-error-msg="Seleccione estado de los cachos">
                  <option value="">Seleccione estado de los cachos</option>
                  <option value="cuernos" <?php if($response_animales['items'][0]['estado_cachos']=='cuernos') echo 'selected' ?>>Cuernos</option>
                  <option value="descornado" <?php if($response_animales['items'][0]['estado_cachos']=='descornado') echo 'selected' ?>>Descornado</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Aplomos cascos: </label>
                <input type="text" class="form-control" name="acascos" id="acascos" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['aplomos_cascos']?>">
            </div>
          </fieldset>
          <fieldset>
            <div class="form-group col-md-12">
              <label>Notas: </label>
              <textarea class="form-control" name="notas" id="notas" rows="7"><?php echo $response_animales['items'][0]['notas'] ?></textarea>
            </div>
          </fieldset>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
          <fieldset>
            <div class="form-group col-md-4">
                <label>Cuenta contable: </label>
                <input type="text" class="form-control" name="ccontable" id="ccontable" data-validation="required" data-validation-error-msg="" placeholder="" value="<?php echo $response_animales['items'][0]['cc']?>" readonly>
            </div>
          </fieldset>
          <fieldset>
            <table role="grid" id="tabla_cuenta" class="table table-bordered table-responsive table-stripped table-hover table-condensed">
               <thead>
                  <tr class="bg bg-info">
                    <th><center>
                      N°
                    </center></th>
                    <th><center>
                      Cuenta
                    </center></th>
                    <th><center>
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
          <button type="button" onClick="?mod=vanimales" class="btn btn-danger pull-left">Cancelar</button>
          <button type="submit" name="guardar" class="btn btn-primary pull-right" id="guardar" name="guardar">Guardar</button>
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
$(document).ready(function(){
  $("#div_donadora").hide();
  $("#donadora").prop('disable', true);
  $("#tabla_cuenta").dataTable({                
      "sPaginationType": "full_numbers"
  });
});
$("[name=concepcion]").on('change', function(){
  var valor=$(this).val();
  if (valor=='te' || valor=='fiv') {
    $("#donadora").prop('disable', false);
    $("#div_donadora").show();
  }else{
    $("#div_donadora").hide();
    $("#donadora").prop('disable', true);
  }
});

//Funcion para pasar el valor al input de la cuenta contable
$('.table').on('click','.cuenta_id',function(e){
    e.preventDefault();
    $('#ccontable').val( $(this).html());
});
</script>