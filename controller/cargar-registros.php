<?php 

require_once("../model/base-datos-registros.php");
session_start();


$identificador = $_SESSION["identificador"];
$registros = new Registro();


function cargarPlanillas($nombre){

    $identificador = $_SESSION["identificador"];
    $planillas = new Planilla();
    $almacenar_planillas = "";

    if($planillas->consultarPlanillas($identificador, $nombre)){

        foreach($planillas->cargarPlanillas($identificador, $nombre)  as $planilla){

            $almacenar_planillas .= "<li class='list-group-item'><a class= 'btn btn-outline-primary btn-sm' href='index.php?pagina=7&nombre_registro=".$nombre."&nombre_planilla=".$planilla["nombre"]."'><strong>".strtoupper($planilla["nombre"])."</strong></a></li>";
        }

        return $almacenar_planillas;

    }else{

        return  "<li class='list-group-item texto-rojo'><strong>NO SE HAN AGREGADO PLANILLAS</strong></li>";

    }

}


if($registros->cargarRegistrosBase($identificador)){

    foreach($registros->cargarRegistrosBase($identificador) as $registro){

        echo "<div class = 'registro col-md-6'>
        <div class='btn-group'>
            <button type='button' class='btn btn-light-primary'><h4>".strtoupper($registro["nombre"])."</h4></button>
            <button type='button' class='btn btn-light-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <span class='sr-only'>Toggle Dropdown</span>
            </button>
            <div class='dropdown-menu'>
            <a class='dropdown-item' href='index.php?pagina=5&registro=".$registro["nombre"]."'><strong>USUARIOS</strong></a>
            <a class='dropdown-item' href='index.php?pagina=6&registro=".$registro["nombre"]."'><strong>AGREGAR PLANILLA</strong></a>
            <a class='dropdown-item' href='#'></a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='index.php?pagina=10&nombre_registro=".str_replace(" ", "%20", $registro["nombre"])."'>ELIMINAR REGISTRO</a>
            </div>
        </div>

        <div>
        <h4 class = 'titulo-planillas'> PLANILLAS : </h4>
        <ul class='list-group'>
            ".cargarPlanillas($registro["nombre"])."
        </ul>

        </div>
        
    </div>";
    }
    

}else{

    echo "<h4> AUN NO HAS CREADO NINGÚN REGISTRO </h4>";

}



?>