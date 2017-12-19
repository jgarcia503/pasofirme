<script language="javaScript">
//funcion enviar datos a agregar
    $(document).ready(function () {
        $("#guardar").click(function () {
            $.validate({
                onSuccess: function(form){
                    var formulario = $("#frmContrasena").serializeArray();
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: "procesos/usuario/cambiocontrasena.php",
                        data: formulario,
                    }).done(function (response) {
                        if (response.success == false) {
                            $.confirm({theme: 'supervan', icon: 'fa fa-exclamation', title: 'Verifique su informacion!', content: response.mensaje, type: 'red', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){close();}}}});

                        } else {
                            $.confirm({theme: 'supervan', icon: 'fa fa-check-circle', title: 'Operacion Exitosa!', content: response.mensaje, type: 'blue', typeAnimated: true, buttons: { tryAgain: { text: 'Aceptar', btnClass: 'btn-primary', action: function(){location.href = "?mod=logout"; }}}});
                        }
                    });
                },
            });
        });//click
    });//ready 

//funcion para comparar contraseñas
    function checkPass() {
        var pass1 = document.getElementById('txtPassword');
        var pass2 = document.getElementById('txtRePassword');
        var message = document.getElementById('confirmMessage');
        var messageOther = document.getElementById('OtherMessage');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        var otherColor = "#FF8000";
        if (pass1.value.length > 5) {
            if (pass1.value == pass2.value) {
                //pass2.style.backgroundColor = goodColor;
                messageOther.style.color = otherColor;
                messageOther.innerHTML = ""
                message.style.color = goodColor;
                message.innerHTML = "Contraseñas coinciden!"
            } else {
                //pass2.style.backgroundColor = badColor;
                messageOther.style.color = otherColor;
                messageOther.innerHTML = ""
                message.style.color = badColor;
                message.innerHTML = "Contraseñas no coinciden!"
            }
        } else {
            message.style.color = goodColor;
            message.innerHTML = ""
            messageOther.style.color = otherColor;
            messageOther.innerHTML = "contraseña muy corta!"
        }
        ;
    }
</script>
<style type="text/css">
    .mensaje{
        position: fixed;
        float: center;
        width: 500px;
    } 
    .titulo{
    text-align: center;
    text-shadow: 6px 6px 6px #aaa;
    font-size: 25px;
}
img.encabezado{
    height: 60px;
    width: 60px;
    vertical-align: middle;
    /* vertical-align: text-top; */
    /* vertical-align: text-bottom; */
}
</style>
<div class="box box-danger">
<div class="box-header with-border">
  <h3 class="box-title">Cambio de contrase&ntilde;a</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<form id="frmContrasena"  method="POST" name="frmContrasena" role="form" autocomplete="off">
  <div class="box-body">
    <div class="form-group col-md-12">
        <label class="control-label">Contraseña Actual: </label>
        <input type="password" name="txtActual" class="form-control" id="txtActual" placeholder="Digite su contraseña actual" data-validation="required" data-validation-error-msg="Complete este campo">
        <p class="help-block" style="height: 8px;"></p>
    </div>
    <div class="form-group col-md-12">
        <label class="control-label">Nueva Contraseña: </label>
        <input type="password" name="txtPassword" class="form-control" id="txtPassword" placeholder="Digite su nueva contraseña" onkeyup="checkPass(); return false;" data-validation="required" data-validation-error-msg="Complete este campo">
        <p class="help-block" style="height: 8px;"><span id="OtherMessage" class="mensaje"></span></p>
    </div>
    <div class="form-group col-md-12">
        <label class="control-label">Repetir Nueva Contraseña: </label>
        <input type="password" name="txtRePassword" class="form-control" id="txtRePassword" placeholder="Digita nuevamente tu nueva contraseña" onkeyup="checkPass(); return false;" data-validation="required" data-validation-error-msg="Complete este campo">
        <p class="help-block" style="height: 8px;"><span id="confirmMessage" class="mensaje"></span></p>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <button type="reset" class="btn btn-primary pull-left" id="limpiar">Limpiar</button>
    <button type="submit" name="guardar" class="btn btn-primary pull-right" id="guardar">Guardar</button>
  </div>
</form>
</div>