<?php 

require_once("../model/base-datos-registros.php");
session_start();

if(isset($_GET["nombre_planilla"]) && isset($_GET["nombre_registro"])){


    $nombre_planilla = $_GET["nombre_planilla"];
    $nombre_registro = $_GET["nombre_registro"];
    $identificador = $_SESSION["identificador"];

    $nombre_planilla_tabla = $nombre_registro."_".$nombre_planilla."_".$identificador;
    $nombre_planilla_tabla = str_replace(" ", "_", $nombre_planilla_tabla);

    $planilla = new Planilla();

    $planilla->eliminarPlanilla($nombre_planilla, $nombre_registro, $identificador);
    $planilla->eliminarPlanillaTabla($nombre_planilla_tabla);

    header("location: ../index.php?pagina=1&mensaje=17");



}else{


    header("location: ../index.php?pagina=7&mensaje=16");


}


?>