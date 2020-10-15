<?php 

require_once("../model/base-datos.php");
session_start();

$nombre = htmlentities(addslashes($_POST["nombre"]));
$correo = htmlentities(addslashes($_POST["correo"]));
$clave = htmlentities(addslashes($_POST["clave"]));


//---Se evalua si se ha iniciado sesión, capturando el nombre y el correo sino es así se redirige a la página con un error---//
if(htmlentities(addslashes($_SESSION["nombre"])) == $nombre && htmlentities(addslashes($_SESSION["correo"])) == $correo){

    header("location: ../index.php?pagina=4&mensaje=1");

}elseif($nombre == "" || $correo == "" || $clave == ""){ /* Si alguna de las variables capturadas están vacías, es decir, si por
                                                            error se llega a este archivo con estas variables vacías,  
                                                            se redirige a la pàgina con un error */
    header("location: ../index.php?pagiga=4&mensaje=2");

}else{
    
/*Si se ha iniciado sesión y las variables contienen información, se procede a actualizar los datos
primero se captura la el nombre de la sesión para utilizarlo en la consulta, luego se actualizan los datos
y finalmente se evalua si hay cookies creadas, si es así, se destruyen y se vuelven a crear con los nuevos datos
y se redirige a la pagina con */

        $actualizar = new Actualizar();

        $sesion_nombre = $_SESSION["nombre"];

        if(!$actualizar->consultarNombre($sesion_nombre)){

            header("location: ../index.php?pagiga=4&mensaje=2");

        }

        if($actualizar->verificarClave($clave)){

            if($actualizar->actualizarDatos($nombre, $correo)){

                $actualizar->nuevaConsulta($nombre, $correo);

                $registro = $actualizar->getRegistro();

                $_SESSION["nombre"] = $registro["nombre"];
                $_SESSION["correo"] = $registro["correo"];
                $_SESSION["perfil"] = $registro["perfil"];
                $_SESSION["imagen"] = $registro["imagen"];
                $_SESSION["identificador"] = $registro["identificador"];
            
                /*--Este bloque evalua si existen cookies y si es así
                    las elimina y las vuelve a crear con la información
                 actualizada--*/
                //----------------------------------------//
                if(isset($_COOKIE["nombre"])){

                    setcookie("nombre", "", time()-1, "/");
                    setcookie("correo", "", time()-1, "/");
                    setcookie("imagen", "", time()-1, "/");
                    setcookie("perfil", "", time()-1, "/");
                    setcookie("identificador", "", time()-1, "/");
            
                }else{
            
                    setcookie("nombre", $registro["nombre"], time()+86400, "/");
                    setcookie("correo", $registro["correo"], time()+86400, "/");
                    setcookie("imagen", $registro["imagen"], time()+86400, "/");
                    setcookie("perfil", $registro["perfil"], time()+86400, "/");
                    setcookie("identificador", $registro["identificador"], time()+86400, "/");

                }
                //----------------------------------------//
                  

                header("location: ../index.php?pagina=4");
                

            }else{

                header("location: ../index.php?pagina=4&mensaje=1");

            }

        }else{

            header("location: ../index.php?page=4&mensaje=1");

        }
    }




?>