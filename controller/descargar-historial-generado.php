<?php 

require_once("../model/base-datos-registros.php");
session_start();

if(isset($_GET["usuario"]) && isset($_SESSION["nombre_registro"]) && isset($_SESSION["nombre_planilla"])){

    $identificador = $_SESSION["identificador"];
    $nombre_usuario = str_replace("%", " ", $_GET["usuario"]);
    $nombre_registro = $_SESSION["nombre_registro"];
    $nombre_planilla = $_SESSION["nombre_planilla"];
    $nombre_planilla_tabla = str_replace(" ", "_", $nombre_registro)."_".str_replace(" ", "_", $nombre_planilla)."_".$identificador;

    $planilla = new Planilla;
    $nombres_columnas = $planilla->nombresColumna($nombre_planilla_tabla);
    $contenido = $planilla->cargarContenido($nombre_planilla_tabla, $nombre_usuario);
    $filename =  $nombre_usuario.date("y-m-d").".xls";
    $headers = "";
    $content = "";
    $aux_content= "";

    

    foreach($nombres_columnas as $nombres){

        $headers .= strtoupper($nombres["Field"])."\t";

    }

    foreach($contenido as $registro){

        foreach($nombres_columnas as $nombres){

            $content .= $registro[$nombres["Field"]]."\t";
    
        }

        $content .= "\n";

    }

    echo $headers;
    echo "\n".$content;

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    


}else{

    header("location: ../index.php?mensaje=2");

}

?>