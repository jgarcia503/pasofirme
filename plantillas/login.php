<?php
@session_start();
if (isset($_SESSION['helpdesk'])) {
    if ($_SESSION['helpdesk'] == true && $_SESSION['login'] == false) {
        header("Location:?mod=inicio");
    } else {
        header("Location:?mod=login");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>Paso Firme S.A de C.V</title>
        <link rel="icon" type="image/png" href="img/pie3.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="plugins/yop/css/login.css" media="all">
        <script type="text/javascript" src="plugins/jQuery/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="plugins/jQueryUI/jquery-ui.min.css" />
        <script type="text/javascript" src="plugins/jQuery/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="plugins/jQueryUI/jquery-ui.min.js"></script>
        <script type="text/javascript" src="plugins/jQueryUI/jquery.alerts.js"></script>
    </head>
    <body>
        <br>
        <br>
        <?php
        include(MODULO_PATH . "/" . $conf[$modulo]['archivo']);
        ?>  
        <br>
        <br>
    </body>
</html>