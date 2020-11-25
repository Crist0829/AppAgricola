<?php 

require_once("../model/base-datos-registros.php");
session_start();


$identificador = $_SESSION["identificador"];
$registros = new Registro();
$nombre_usuario = $_SESSION["nombre"];


function cargarPlanillas($nombre, $identificador, $editor){

    $planillas = new Planilla();
    $almacenar_planillas = "";

    if($planillas->consultarPlanillas($identificador, $nombre)){

        foreach($planillas->cargarPlanillas($identificador, $nombre)  as $planilla){

            $almacenar_planillas .= "<li class='list-group-item'><a class= 'btn btn-outline-primary btn-sm' href='index.php?pagina=3&nombre_registro=".$nombre."&nombre_planilla=".$planilla["nombre"]."&nombre_editor=".$editor."'><strong>".strtoupper($planilla["nombre"])."</strong></a></li>";
        }

        return $almacenar_planillas;

    }else{

        return  "<li class='list-group-item texto-rojo'><strong>NO SE HAN AGREGADO PLANILLAS</strong></li>";

    }

}


if($registros->consultarUsuarioComun($nombre_usuario)){

    foreach($registros->registro as $registro){

        echo "<div class = 'registro col-md-6'>
        <div class='btn-group'>
            <button type='button' class='btn btn-light-primary'><h4>".strtoupper($registro["nombre_registro"])."</h4></button>
            
        </div>

        <div class = 'registro m-1'>
        <h5>EDITOR: ".$registro["nombre_editor"]." </h5>
        </div>

        <div>
        <h4 class = 'titulo-planillas'> PLANILLAS : </h4>
        <ul class='list-group'>
            ".cargarPlanillas($registro["nombre_registro"], $registro["identificador_editor"], str_replace(" ", "%20", $registro["nombre_editor"]))."
        </ul>

        </div>
        
    </div>";
    }
    

}else{

    echo "<h4> AUN NO TE HAN CONECTADO A NINGÚN REGISTRO </h4>";

}



?>