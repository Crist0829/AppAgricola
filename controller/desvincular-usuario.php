<?php 

require_once("../model/base-datos-registros.php");

if(isset($_GET["id"])){

    session_start();

    $nombre_registro = str_replace(" ", "_", $_SESSION["nombre_registro"])."_".$_SESSION["identificador"];

    $identificador = $_GET["id"];
    $registro = new Registro();

    echo $registro->desvincularUsuario($identificador, $nombre_registro);


}else{


    echo 0;

}
















?>