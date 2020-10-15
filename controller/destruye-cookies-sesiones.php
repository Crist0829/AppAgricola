<?php
//Destruye la sesión y las actual
session_start();
session_destroy();


//Evalua si existen cookies de inicio de sessión y si es así, las destruye 
if(isset($_COOKIE["nombre"])){

    setcookie("nombre", "", time()-1, "/");
    setcookie("correo", "", time()-1, "/");
    setcookie("perfil", "", time()-1, "/");
    setcookie("imagen", "", time()-1, "/");
    setcookie("identificador", "", time()-1, "/");
    
}

header("location:../index.php"); // Redirige al index una vez se hayan eliminado las cookies y las sesiones existentes


?>