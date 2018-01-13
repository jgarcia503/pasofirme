<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Paso Firme S.A de C.V</title>
      <link rel="stylesheet" href="plugins/awesomplete/awesomplete.css">
      <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="plugins/ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
      <link rel="stylesheet" href="plugins/iCheck/all.css">
      <!-- Bootstrap Color Picker -->
      <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
      <!-- Bootstrap time Picker -->
      <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
      <link rel="stylesheet" href="plugins/jtimepicker/jquery.timepicker.css">
      <link rel="shortcut icon" type='image/x-icon' href="img/favicon.ico"/>
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.css">
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
      
      <!-- iCheck -->
      <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
      <!-- Morris chart -->
      <link rel="stylesheet" href="plugins/morris/morris.css">
      <!-- jvectormap -->
      <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
      <!-- Date Picker -->
      <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
      <!-- bootstrap wysihtml5 - text editor -->
      <link href="bootstrap/css_input/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" type="text/css" href="bootstrap/css/design.css" media="all">
      <link rel="stylesheet" type="text/css" href="plugins/JqueryConfirm/css/jquery-confirm.css">
      <!-- jQuery 1.8.2 -->
      <script src="plugins/jQuery/jquery-1.8.2.min.js"></script>
      <script src="bootstrap/js_input/fileinput.min.js" type="text/javascript"></script>
      <script src="plugins/input-mask/jquery.maskedinput.min.js"></script>
      <!-- Bootstrap 3.3.5 -->
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jquery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap bootbox -->
<script src="plugins/bootbox/bootbox.js"></script>
<!-- jQuery validator -->
<script src="plugins/JQueryValidator/jquery.form-validator.js"></script>
<script type="text/javascript" src="plugins/jquery.blockUI.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<script src="plugins/select2/select2.full.min.js"></script>
   </head>
   <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
      <div class="wrapper">
         <!--  Start: header  -->
         <?php include ("modulos/header.php"); ?>
         <!-- End: header -->
         <!-- Start: Left side column. contains the logo and sidebar -->
         <?php
            if($_SESSION["tipo"] == 'admin'){
                  include("modulos/nav_bar.php");
              }
            ?>
         <!-- End: Left side column. contains the logo and sidebar -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper" style="background-color: #DFDFDF;">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content" style="font-size: 9pt;">
               <?php
                  include(MODULO_PATH . "/" . $conf[$modulo]['archivo']);
                  ?>
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <!-- Start: footer -->
         <?php include("modulos/footer.php"); ?>
         <!-- End: footer -->
         <!-- Start: right side column. contains the logo and sidebar -->
         <?php
            include("modulos/nav_bar_right.php");
            ?>
         <!-- End: right side column. contains the logo and sidebar -->
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg">
         </div>
      </div>
    
      <!-- ./wrapper -->
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     <script>
         $.widget.bridge('uibutton', $.ui.button);

$(function () {

//DatePicker, intsanciado para llamarlo mediante la clase
$.fn.datepicker.dates['es'] = {
    days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    daysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    daysMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    months:  ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort:  ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    today: 'Hoy',
    clear: "Limpiar",
    format: "yyyy-mm-dd",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};

//datepicker, intsanciado para llamarlo mediante la clase
$('.datepicker').datepicker({
    language: "es" 
});

//daterangepicker, intsanciado para llamarlo mediante la clase
$('.daterange').daterangepicker({
    language: "es" 
});

//Datatable, intsanciado para llamarlo mediante la clase
$('.datatable').DataTable();  

//Select2, intsanciado para llamarlo mediante la clase
$(".select2").select2({
    placeholder: "Seleccione una opcion"
});

$(".timepicker").timepicker({
  'disableTextInput': true
});

});
 </script>
 <!-- NUEVOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->
 <!-- Morris.js charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<script src="plugins/awesomplete/awesomplete.min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<!--<script src="plugins/fullcalendar/moment.min.js"></script>-->
<!--<script src="plugins/fullcalendar/fullcalendar.min.js"></script>-->
<!--<script src="plugins/fullcalendar/lang/es.js"></script>-->
    <!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<script src="plugins/JqueryConfirm/js/jquery-confirm.js"></script>
<script src="plugins/jtimepicker/jquery.timepicker.js"></script>
 <!-- -->
</body>
</html>
<?php unset($_SESSION['detalle_cosecha']); ?>
<?php unset($_SESSION['detalle_peso_animal']); ?>
<?php unset($_SESSION['peso_animal']); ?>