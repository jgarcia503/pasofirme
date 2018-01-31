<?php
@ob_start();
@session_start();
@clearstatcache();
@date_default_timezone_set('America/El_Salvador'); 
@setlocale(LC_TIME, 'spanish');

if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

include('conf.php');
include('sql/class.data.php');
include('sql/class.dataTable.php');
include('sql/class.functions.php');

$data = new data();
$dataTable = new dataTable();
$kardex = new kardex();
if (isset($_GET['mod'])) {
    $modulo = $_GET['mod'];
} else {
    $modulo = MODULO_DEFECTO;
}
if (isset($conf[$modulo]['layout'])) {
    $path_layout = LAYOUT_PATH . '/' . $conf[$modulo]['layout'];
    if (!empty($conf[$modulo]['layout'])) {
        include($path_layout);
    }
} else {
    if (isset($_SESSION['pasofirme'])) {
        $modulo = 'error';
        $path_layout = LAYOUT_PATH . '/' . $conf[$modulo]['layout'];
        include($path_layout);
    } else {
        $modulo = 'login';
        $path_layout = LAYOUT_PATH . '/' . $conf[$modulo]['layout'];
        include($path_layout);
    }
}
?>