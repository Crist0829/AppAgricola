<?php 

require_once("../model/base-datos.php");
require_once("../model/base-datos-registros.php");

session_start();

$nombre = $_SESSION["nombre"];

if($_SESSION["imagen"] !== null){

    $eliminar_a = "../".$_SESSION["imagen"];
    unlink($eliminar_a);

    $eliminar = new Actualizar();

    if($eliminar->eliminarImagen($nombre)){

        $registro = new Registro();

        if($registro->consultarUsuarioComun($nombre)){

            foreach($registro->registro as $reg);

            $nombre_registro_tabla = $reg["nombre_registro"]."_".$reg["identificador_editor"];
            $nombre_registro_tabla = str_replace(" ", "_", $nombre_registro_tabla);

            $registro->eliminarImagen($nombre_registro_tabla, $nombre);

        }

        if(isset($_COOKIE["imagen"])){

            setcookie("imagen", "", time()-1, "/");

        }

        $_SESSION["imagen"] = null;

        setcookie("imagen", $_SESSION["imagen"], time()+86400, "/");

        header("location: ../index.php?pagina=4");

    }else{

        header("location: ../index.php?page=4&mensaje=2");

    }

}else{

    header("location: ../index.php?paginga=4&mensaje=2");

}





?>