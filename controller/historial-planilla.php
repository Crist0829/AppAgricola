<?php 

require_once("../model/base-datos-registros.php");
session_start();

if(isset($_GET["nombre_planilla"]) && isset($_GET["nombre_registro"])){

  $nombre_planilla = $_GET["nombre_planilla"];
  $nombre_registro = $_GET["nombre_registro"];
  $identificador = $_SESSION["identificador"];
  $nombre_planilla_tabla = str_replace(" ", "_", $nombre_registro)."_".str_replace(" ", "_", $nombre_planilla)."_".$identificador;

  $planilla = new Planilla();

  if($planilla->consultarNombrePlanilla($nombre_planilla, $nombre_registro)){

    $info_planilla = $planilla->cargarPlanilla($nombre_registro, $nombre_planilla);
    $registro_planilla = $planilla->cargarRegistroPlanilla($nombre_planilla_tabla);
    $nombres_columna = $planilla->nombresColumna($nombre_planilla_tabla);

    function nombresColumna(){
        global $nombres_columna;
        $aux = "";

        foreach($nombres_columna as $nombres){

            $aux .= "<th>".$nombres["Field"]."</th>"; 

        }

        return $aux;

    }

    function registroPlanilla(){
        global $planilla, $nombres_columna, $info_planilla, $nombre_planilla_tabla;

        $nombre = array();
        $tipo = array();
        $aux = 0;
        $aux_2 = "";
        $aux_3 = "";
        $aux_4 = "";

        foreach($nombres_columna as $nombres){
            
            $nombre[$aux] = $nombres["Field"];
            $tipo[$aux] = $nombres["Type"]; 
            $aux ++;

        }

        $aux = 0;

        if(!$planilla->cargarRegistroPlanilla($nombre_planilla_tabla)){

            return "<tr> <td colspan = ".$info_planilla["ncolumnas"].">NO HAY HISTORIAL PARA ESTA PLANILLA <td> <tr>";

        }

        foreach($planilla->cargarRegistroPlanilla($nombre_planilla_tabla) as $registro){

            foreach($nombre as $nombres => $valor){

                $aux_2 .= " <td>".$registro[$valor]." </td>";
                $aux ++;

            }
            
            $aux_3 = "<tr> $aux_2 </tr>";
            $aux_4 .= $aux_3;
            $aux_2 = "";

        }


        return $aux_4;

    }

    echo "
    <div class = 'table-responsive'>
    <table class = 'table'>
    <thead>
    <tr>
    ".nombresColumna()."
    </tr>
    </thead>

    <tbody>
        
        ".registroPlanilla()."
        
    </tbody>
    
    <table>
    <div>";

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