<?php 

require_once("../model/base-datos.php");

/*--- Este bloque consulta si existe un usuario con el nombre que el usuario digitó
      si es así, devuelve 1, sino devuelve 0 y luego en el archivo validar.js 
      está la función para hacer la acción a realizar dependiendo la respuesta ---*/
//---------------------------//
if(isset($_GET["nombre"])){

    $nombre = $_GET["nombre"];

    $consulta = new Consultar();

    $respuesta = $consulta->consultarNombre($nombre);

    echo $respuesta;

}
//--------------------------//



/*--- Este bloque consulta si existe un usuario con el correo que el usuario digitó
      si es así, devuelve 1, sino devuelve 0 y luego en el archivo validar.js 
      está la función para hacer la acción a realizar dependiendo la respuesta ---*/
//---------------------------//
if(isset($_GET["correo"])){

    $correo = $_GET["correo"];

    $consulta = new Consultar();

    $respuesta = $consulta->consultarCorreo($correo);

    echo $respuesta;

}
//---------------------------//




/*--- Este bloque consulta si existe un usuario con el correo que el usuario digitó
      si es así, devuelve 1, sino devuelve 0 y luego en el archivo validar.js 
      está la función para hacer la acción a realizar dependiendo la respuesta ---*/
//---------------------------//
if(isset($_GET["valor"])){

    $valor = $_GET["valor"];

    $consulta = new Consultar();

    if($consulta->consultarNombre($valor) || $consulta->consultarCorreo($valor)){

        echo "1";

    }else{

        echo "0";

    }

}
//---------------------------//

















?>