<?php
session_start();
include('conexion.php');
if(!isset($_SESSION['registro'])){ // Debe ser 'registro', no 'usuario'
    header('Location: login.php');
    exit();
}
session_destroy();
header("Location:login.php");
exit();
?>