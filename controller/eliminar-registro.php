<?php 

require_once("../model/base-datos-registros.php");
require_once("../model/base-datos.php");
session_start();

if(isset($_POST["clave"]) && isset($_SESSION["nombre"]) && isset($_GET["nombre_registro"])){

    $identificador = $_SESSION["identificador"];
    $nombre_registro = $_GET["nombre_registro"];
    $nombre_registro_tabla = $nombre_registro."_".$identificador;
    $nombre_registro_tabla = str_replace(" ", "_", $nombre_registro_tabla);
    $clave = htmlentities(addslashes($_POST["clave"]));
    $nombre = $_SESSION["nombre"];
    $consultar = new Consultar();

    if($consultar->consultarNombre($nombre) && $consultar->verificarClave($clave)){
    
    $registro = new Registro();
    $objeto_planilla = new Planilla();
    
    $planillas = $registro->extraerPlanillas($nombre_registro, $identificador);


    
    if(!empty($planillas)){

        //el Siguiente bloque elimina las planillas
        foreach($planillas as $planilla){

            //--------se establece los nombres de las tablas correspondientes a las planillas--------//
            $nombre_planilla_tabla = $nombre_registro."_".$planilla["nombre"]."_".$identificador;
            $nombre_planilla_tabla = str_replace(" ", "_", $nombre_planilla_tabla);
            
            $objeto_planilla->eliminarPlanilla($planilla["nombre"], $nombre_registro, $identificador); // se elimina la planilla de la tabla "planillas_base"
            $objeto_planilla->eliminarPlanillaTabla($nombre_planilla_tabla); // Se elimina la tabla correspondiente de esa planilla
    
            //----------------------------------------------------------------------------------------//
    
            }

    }

    
    //---------Se elimina todos la información del registro---------//
    $registro->eliminarRegistro($nombre_registro, $identificador); //Elimina el registro de la tabla "registros_base"
    $registro->eliminarRegistroUB($nombre_registro, $identificador);//Elimina el registro de la tabla "usuarios_base"
    $registro->eliminarRegistroTabla($nombre_registro_tabla);//Elimina la tabla del registro correspondiente
    //--------------------------------------------------------------//

    header("location: ../index.php?mensaje=10");

    
    }else{

        header("location: ../index.php?pagina=10&mensaje=7");

    }
    
}else{

    header("location: ../index.php?pagina=10&mensaje=2");

}

?>