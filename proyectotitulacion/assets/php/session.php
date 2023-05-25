<?php

$v_Sistema = "Proyecto de titulación";

session_start();    

header_remove('x-powered-by');

$vinactivo = 900;

if(isset($_SESSION['tiempo'])){
    $vida_session = time() - $_SESSION['tiempo'];
    if($vida_session > $vinactivo){
        header($v_Sistema."_salir.php"); 
    }
}

$_SESSION['tiempo'] = time();

if(!isset($_SESSION[$v_Sistema.'Clave'])){
    header("Location: ".$v_Sistema."_home.php");
}else{
    $usrClave     = $_SESSION[$v_Sistema.'Clave'];
    $usrNombres   = $_SESSION[$v_Sistema.'Nombre'];
    $usrApellidos = $_SESSION[$v_Sistema.'Apellidos'];

    // Datos especiales
    $usrTipo       = $_SESSION[$v_Sistema.'Tipo'];
}

?>