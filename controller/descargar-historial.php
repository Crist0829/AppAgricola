<?php 

require_once("../model/base-datos-registros.php");
require_once("../model/base-datos.php");
session_start();



if(isset($_GET["nombre_planilla"]) && isset($_GET["nombre_registro"])){

  $nombre_planilla = $_GET["nombre_planilla"];
  $identificador = $_SESSION["identificador"];
  $_SESSION["nombre_planilla"] = $nombre_planilla;
  $nombre_registro = $_GET["nombre_registro"];
  $nombre_registro_tabla = str_replace(" ", "_", $nombre_registro)."_".$identificador;
  
  $nombre_planilla_tabla = str_replace(" ", "_", $nombre_registro)."_".str_replace(" ", "_", $nombre_planilla)."_".$identificador;

  $planilla = new Planilla();

  if($planilla->consultarNombrePlanilla($nombre_planilla, $nombre_registro)){

    $info_planilla = $planilla->cargarPlanilla($nombre_registro, $nombre_planilla);
    $registro_planilla = $planilla->cargarRegistroPlanilla($nombre_planilla_tabla);
    $nombres_columna = $planilla->nombresColumna($nombre_planilla_tabla);



    /*Esta función cargar los usuarios conectados al registro y que han llenado la planilla */
    function usuarios(){
        global $planilla, $nombre_registro_tabla; 

        $aux = "";

        foreach($planilla->cargarUsuarios($nombre_registro_tabla) as $usuario){


            $aux .= "
            
                    <option value='".str_replace("", "%", $usuario["nombre"])."'>".$usuario["nombre"]." </option>

            
            ";


        }

        
        return $aux;


    }


    echo "<div class='card-per'> 

    <form action='controller/descargar-historial-generado.php?nombre_planilla=aasd' method='GET'>

    <div class='form-group'>
    <h3> Usuario </h3>
    <select class='form-control' name= 'usuario'> 
    ".usuarios()."
    </select>
    <div>

    <hr>

    <input class='btn btn-primary btn-sm' type='submit' value='DESCARGAR'>
    </form>
    
    </div>";


  }else{

    echo "<div>
    
        HUBO UN PROBLEMA CON LA CONEXIÓN EN LA BASE DE DATOS, RECARGA LA PÁGINA. 
    
    <div>
    ";
  }


}else{

    echo "<div>
    
    NO SE HA CARGADO LA INFORMACIÓN, RECARGA LA PÁGINA. 
    
    <div>
    ";

}


?>