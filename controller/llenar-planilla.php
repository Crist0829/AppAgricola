<?php 
require_once("../model/base-datos-registros.php");
session_start();

if(isset($_GET["nombre_planilla"]) && isset($_GET["nombre_registro"]) && isset($_GET["nombre_editor"])){


    $nombre_planilla = $_GET["nombre_planilla"];
    $nombre_registro = $_GET["nombre_registro"];
    $nombre_editor = $_GET["nombre_editor"];

    $registro = new Registro();
    $planilla = new Planilla();


    if($registro->consultarUsuarioComun($_SESSION["nombre"], $nombre_editor, $nombre_registro)){
        
        foreach($registro->registro as $reg){

            $identificador_editor = $reg["identificador_editor"];

        }

        $nombre_planilla_tabla = $nombre_registro."_".$nombre_planilla."_".$identificador_editor;
        $nombre_planilla_tabla = str_replace(" ", "_", $nombre_planilla_tabla);

        $nombres_columnas = $planilla->nombresColumna($nombre_planilla_tabla);

    }

    



    echo "<div class = 'registro-2'>

        <form>

        <p> aquí va la información <p>

        </form>
    
    </div>";

    echo $_GET["nombre_editor"];



}else{

    echo "<div class = 'registro'>

        <p> No se ha cargado la información, recarga la página para intentarlo nuevamente</p>
    
    </div";


}


?>