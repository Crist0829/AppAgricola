<?php 

require_once("../model/base-datos-registros.php");
require_once("../model/base-datos.php");
session_start();

if(isset($_POST["id"]) && isset($_POST["clave"]) && isset($_SESSION["nombre_registro"])){
    
    $identificador = $_POST["id"];
    $nombre_editor = $_SESSION["nombre"];
    $clave = htmlentities(addslashes($_POST["clave"]));
    $identi_editor = $_SESSION["identificador"];
    $nombre_registro = $_SESSION["nombre_registro"];
    $nombre_registro_tabla = str_replace(" ", "_", $nombre_registro);
    $nombre_registro_tabla = $nombre_registro_tabla."_".$_SESSION["identificador"];

    $consultar_editor = new Consultar();
    $consultar_usuario = new Consultar();
    $registro = new Registro();


    //Se verifica si la contaseña digitada es correcta y si el id pertenece a un usuario registrado
    if($consultar_editor->consultarNombre($_SESSION["nombre"]) && $consultar_editor->verificarClave($clave) && 
        $consultar_usuario->consultarIdentificador($identificador)){

        /*Se verifica si el id que tecleó el editor ya está asociado al registro
          si es así se redirige a la pagina de administración de usuarios con una 
          alerta*/
        //----------------------------------------------------------------------//
        if(!$registro->consultarUsuario($nombre_registro_tabla, $identificador)){

            
            $datos_usuario = $consultar_usuario->getRegistro();

            if($registro->conectarUsuario($nombre_registro_tabla, $datos_usuario["nombre"], $datos_usuario["identificador"], 
            $datos_usuario["correo"], $datos_usuario["imagen"])){

                if($registro->conectarUsuarioUB($datos_usuario["nombre"], $identificador, $nombre_editor, $identi_editor, $nombre_registro)){


                    header("location: ../index.php?pagina=5&mensaje=13");


                }else{


                    header("location: ../index.php?pagina=5&mensaje=11");

                }


            }


        }else{

            header("location: ../index.php?mensaje=11&pagina=5");

        }

    }else{

        header("location: ../index.php?mensaje=11&pagina=5");

    }

}else{

    header("location: ../index.php?mensaje=10&pagina=5");


}



?>