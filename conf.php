<?php
$conf=array();
define('MODULO_DEFECTO', 'login');
define('LAYOUT_DEFECTO', 'login.php');
define('LAYOUT_DESKTOP', 'desktop.php');
define('MODULO_PATH', realpath('modulos'));
define('LAYOUT_PATH', realpath('plantillas'));

if (isset($_SESSION['helpdesk'])) {
   if ($_SESSION['tipo']=='admin'){
        include("modulos/permisos/administrador.php");
    }
    // start: Modulos por defecto del sistema
    $conf['inicio'] = array(
        'archivo' => 'inicio.php',
        'layout' => LAYOUT_DESKTOP
    );
    $conf['logout'] = array(
        'archivo' => 'logout.php',
        'layout' => LAYOUT_DESKTOP
    );
    $conf['error'] = array(
        'archivo' => '404.php',
        'layout' => LAYOUT_DESKTOP
    );
    $conf['contrasena'] = array(
        'archivo' => 'usuario/contrasena.php',
        'layout' => LAYOUT_DESKTOP
    );
    // end: Modulos por defecto del sistema
} else {
    $conf['login'] = array(
        'archivo' => 'login.php',
        'layout' => LAYOUT_DEFECTO
    );

}
?>