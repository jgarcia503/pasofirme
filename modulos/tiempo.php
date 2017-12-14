<?php 
 //Funcion para cerra sesion luego de 900 milisegundos 
$timeout = 900; 
    if (isset($_SESSION['start_time'])) {
        $elapsed_time = time() - $_SESSION['start_time'];
        if ($elapsed_time >= $timeout) {
            header('Location:?mod=logout');
        }
    }
    $_SESSION['start_time'] = time();  
?> 