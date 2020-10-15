<?php 

require_once("../model/base-datos.php");
session_start();


/*Se captura la contraseña actual, la nueva y repite (que es la confirmación de la nueva contraseña)
luego se evalua, si cualquiera de las 3 variables está vacía se retorna con un error,
sino es así, se evalua: si la contraseña nueva y repite coinciden, si no es así, se retorna con un error,
si coinciden, se evalua si la contraseña actual coincide con el usuario que ha iniciado sesión,
si no es así se retorna un eror, si es así, se procede a actualizar la contraseña y a redirigr al 
usuario al la página con un mensaje de éxito*/

//---------------------------------------------------//
$clave = htmlentities(addslashes($_POST["clave"])); 
$nueva =  htmlentities(addslashes($_POST["nueva"]));
$repite = htmlentities(addslashes($_POST["repite"]));
//---------------------------------------------------//

//--------------------------------------------------- //
if($clave !== "" && $nueva !== "" && $repite !== ""){

    if($nueva == $repite){

        $actualizar = new Actualizar();

        $sesion_nombre = $_SESSION["nombre"];

        if(!$actualizar->consultarNombre($sesion_nombre)){

            header("location: ../index.php?pagiga=4&mensaje=2");

        }

        if($actualizar->verificarClave($clave)){

            $encriptada = password_hash($nueva, PASSWORD_DEFAULT);

            if($actualizar->actualizarClave($_SESSION["nombre"], $encriptada)){

                header("location: ../index.php?pagina=4&mensaje=5");

            }else{

                echo $_SESSION["nombre"];

            }

        }else{

            header("location: ../index.php?pagina=4&mensaje=1");

        }

    }else{

        header("location: ../index.php?pagina=4&mensaje=6");

    }

}else{

    header("location: ../index.php?pagina=4&mensaje=2");

}
//----------------------------------------------------//

?>