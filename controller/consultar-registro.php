<?php 

require_once("../model/base-datos-registros.php");


if(isset($_GET["nombre"])){

    session_start();

    $identificador = $_SESSION["identificador"];
    $nombre = $_GET["nombre"];
    
    $nombre_registro = $nombre."_".$identificador;
    $nombre_registro = str_replace(" ", "_", $nombre_registro);
    $consultar = New Registro();
    $respuesta = $consultar->consultarNombreRegistro($nombre_registro);
    echo $respuesta;

}else{

    echo 0;

}

?>