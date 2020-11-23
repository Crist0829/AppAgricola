<?php 

require_once("../model/base-datos-registros.php");
session_start();

if(isset($_GET["nombre_planilla"]) && isset($_GET["nombre_registro"])){

  $nombre_planilla = $_GET["nombre_planilla"];
  $nombre_registro = $_GET["nombre_registro"];
  $identificador = $_SESSION["identificador"];

  $planilla = new Planilla();

  if($planilla->consultarNombrePlanilla($nombre_planilla, $nombre_registro)){


    $registro_planilla = $planilla->cargarPlanilla($nombre_registro, $nombre_planilla);


    echo  "<div>

    <div class = 'registro-2'>
        <p class = 'text-center p-per'> <strong> NOMBRE: </strong></p>
        <p class = 'text-center texto-verde' id = 'nombrePlanilla'><strong>".strtoupper($registro_planilla["nombre"])."</strong></p>
    </div>
    <div class = 'registro-2'>
        <p class = 'text-center p-per'> <strong> FECHA DE CREACIÓN: </strong></p>
        <p class = 'text-center texto-verde' id = 'fecha'><strong>".$registro_planilla["fecha"]."</strong></p>
    </div>

    <div class = 'registro-2'>
        <p class = 'text-center'> <strong> FRECUENCA CON QUE LA QUE DEBE LLENAR: </strong></p>
        <p class = 'text-center texto-verde' id = 'frecuenciaValor'><strong> ".$registro_planilla["frecuencia"]."</strong></p>
    </div>

    <div class = 'registro-2'>
        <p class = 'text-center'> <strong> OBSERVACIONES: </strong></p>
        <p class = 'text-center texto-verde' id = 'frecuenciaValor'><strong> ".$registro_planilla["observaciones"]."</strong></p>
    </div>


    
    </div>";
    


  }else{

    echo "<div>
    
        HA HABIDO UN PROBLEMA CON LA CONEXIÓN EN LA BASE DE DATOS, RECARGA LA PÁGINA Y VUELVE A INTENTARLO  
    
    <div>
    ";


  }


}else{

    echo "<div>
    
    NO SE HA CARGADO LA INFORMACIÓN
    
    <div>
    ";

}











?>