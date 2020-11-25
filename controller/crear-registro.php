<?php 

require_once("../model/base-datos-registros.php");
require_once("../model/base-datos.php");



if(isset($_POST["clave"]) && isset($_POST["nombre"])){

    session_start();

    $nombre = $_POST["nombre"];
    $nombre = strtolower($nombre);
    $clave = htmlentities(addslashes($_POST["clave"]));
    $consultar = new Consultar();

    $nombre_usuario = $_SESSION["nombre"];


    if($consultar->consultarNombre($nombre_usuario) && $consultar->verificarClave($clave)){



        $nombre_registro = $nombre."_".$_SESSION["identificador"];
        $nombre_registro = str_replace(" ", "_", $nombre_registro);

        $crear_registro = new Registro();

        if($crear_registro->crearTabla($nombre_registro) && $crear_registro->insertarRegistro($nombre, $_SESSION["identificador"])){

            header("location: ../index.php?pagina=1&mensaje=9");

        }else{

            header("location: ../index.php?pagina=2&mensaje=8");

        }


    }else{

        header("location: ../index.php?pagina=2&mensaje=7");

    }
    


}else{

    header("location: ../index.php?pagina=2&mensaje=2");


}

?>