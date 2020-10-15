<?php 

require_once("../model/base-datos.php");

$valor = htmlentities(addslashes($_POST["valor"]));
$clave = htmlentities(addslashes($_POST["clave"]));

$usuario = new Consultar();

if($usuario->consultarNombreTemp($valor) || $usuario->consultarCorreoTemp($valor)){

    if($usuario->verificarClave($clave)){

        header("location: ../view/verificacion.php");

    }

}

$validar = new Validar(); //Objeto que tiene los métodos necesarios para validar y almacenar datos del login


/*--Inicia sesión a función del valor devuelto 
por el método validate del objeto conexion--*/

if($validar->validarNombre($valor, $clave) || $validar->validarCorreo($valor, $clave)){

//----------Para un usuario común o negocio---------//
   
        $registro = $validar->getRegistro();

        /*---Este bloque evalua si se ha marcado la casilla de recordar
             y si es así crea una cookie para almacenar la información
             que luego se a a utilizar para que después no tenga que 
             hacer el login nuevamente---*/
        if(isset($_POST["recordar"])){

            setcookie("nombre", $registro["nombre"], time()+86400, "/");
            setcookie("perfil", $registro["perfil"], time()+86400, "/");
            setcookie("correo", $registro["correo"], time()+86400, "/");
            setcookie("identificador", $registro["identificador"], time()+86400, "/");
            setcookie("imagen", $registro["imagen"], time()+86400, "/");

        }
        //---------------------------------/
        
        session_start();
        $_SESSION["nombre"] = $registro["nombre"];
        $_SESSION["perfil"] = $registro["perfil"];
        $_SESSION["correo"] = $registro["correo"];
        $_SESSION["identificador"] = $registro["identificador"];
        $_SESSION["imagen"] = $registro["imagen"];
        header("location:../index.php");

        //-------------------------------------------------//

    
}else{

    //--------Para cuando haya un error en los datos--------//

        
    header("location: ../index.php?mensaje=0");


    
    //------------------------------------------------------//


}

?>