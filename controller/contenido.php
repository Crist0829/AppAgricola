<?php 
require_once("mensajes.php");


session_start();

if(isset($_SESSION["nombre"]) && isset($_SESSION["correo"]) && isset($_SESSION["perfil"])){

    if($_SESSION["perfil"] == 0){

        $nav = 1;

    }else{

        $nav = 2;

    }

}else{

    if(isset($_COOKIE["nombre"]) && isset($_COOKIE["correo"]) && isset($_COOKIE["perfil"]) && isset($_COOKIE["identificador"])){

        $_SESSION["nombre"] = $_COOKIE["nombre"];
        $_SESSION["correo"] = $_COOKIE["correo"];
        $_SESSION["perfil"] = $_COOKIE["perfil"];
        $_SESSION["identificador"] = $_COOKIE["identificador"];
        $_SESSION["imagen"] = $_COOKIE["imagen"];

        if($_SESSION["perfil"] == 0){

            $nav = 1;

        }else{

            $nav = 2;

        }

    }else{

        $nav = 0;

    }

}


if(!isset($_GET["pagina"])){

    $pagina = 0;

}else{

    $pagina = $_GET["pagina"];

}


function cargarContenido(){
    global $nav;
    global $pagina;

    switch($nav){

        case 0:

            require_once("view/html/default/default.html");
            
        break;

        case 1:

            switch($pagina){

                case 0:
                    require_once("view/html/usuario-editor/editor.html");
                break;

                case 1:
                    require_once("view/html/usuario-editor/ajustes.html");
                break;

                case 2:
                    require_once("view/html/usuario-editor/editor.html");
                break;

                case 3:
                    require_once("view/html/usuario-editor/editor.html");
                break;

            }

        break;

        case 2:

            switch($pagina){

                case 0:
                    require_once("view/html/usuario-editor/default.html");
                break;

                case 1:
                    require_once("view/html/usuario-editor/mis-registros.html");
                break;

                case 2:
                    require_once("view/html/usuario-editor/crear-registro.html");
                break;

                case 3:
                    require_once("view/html/usuario-editor/ajustes.html");
                break;

                case 4:
                    require_once("view/html/usuario-editor/actualizar-info.html");
                break;

                case 5:
                    require_once("view/html/usuario-editor/administrar-usuarios.html");
                break;
                

            }

        break;


    }

}

function cargarImagen(){

    if($_SESSION["imagen"] == null){

        echo "view/assets/media/image/user/default.png";

    }else{

        echo $_SESSION["imagen"];

    }
}



?>