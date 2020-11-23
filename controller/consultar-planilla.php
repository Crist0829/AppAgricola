<?php 

require_once("../model/base-datos-registros.php");
session_start();

if(isset($_GET["nombre"]) && isset($_SESSION["nombre_registro"])){

    $nombre = $_GET["nombre"];
    $nombre = strtolower($nombre);
    $nombre_registro = $_SESSION["nombre_registro"];

    $consultar = New Planilla();
    $respuesta = $consultar->consultarNombrePlanilla($nombre, $nombre_registro);
    echo $respuesta;

}else{

    echo 0;

}

?>