<?php 

require_once("../model/base-datos-registros.php");

if(isset($_GET["id"])){

    session_start();

    $nombre_registro = str_replace(" ", "_", $_SESSION["nombre_registro"])."_".$_SESSION["identificador"];

    $identificador_usuario = $_GET["id"];
    $identificador_editor = $_SESSION["identificador"];
    $registro = new Registro();

    $registro->desvincularUsuarioUB($identificador_usuario, $identificador_editor, $_SESSION["nombre_registro"]);
    echo $registro->desvincularUsuario($identificador_usuario, $nombre_registro);


}else{


    echo 0;

}
















?>