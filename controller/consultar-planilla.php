<?php 

require_once("../model/base-datos-registros.php");
session_start();

if(isset($_GET["nombre"]) && isset($_SESSION["nombre_registro"])){

    $nombre = $_GET["nombre"];
    $identificador = $_SESSION["identificador"];
    $nombre_registro = strtoupper($_SESSION["nombre_registro"]);
    $nombre_registro = str_replace(" ", "", $nombre_registro)."_";
    

    $nombre_planilla = $nombre_registro.$nombre."_".$identificador;
    $nombre_planilla = str_replace(" ", "_", $nombre_planilla);

    $consultar = New Planilla();

    $respuesta = $consultar->consultarPlanillaTabla($nombre_planilla);
    echo $respuesta;

}else{

    echo 0;

}

?>