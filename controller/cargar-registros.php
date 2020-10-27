<?php 

require_once("../model/base-datos-registros.php");
session_start();


$identificador = $_SESSION["identificador"];
$registros = new Registro();


function cargarPlanillas(){

    $identificador = $_SESSION["identificador"];
    $planillas = new Planilla();

    if($planillas->consultarPlanilla($identificador)){

        foreach($planillas->cargarPlanilla($identificador)  as $planilla){

            return "<li class='list-group-item'>".$planilla["nombre"]."</li>";
        }

    }else{

        return  "<li class='list-group-item'>NO SE HAN AGREGADO PLANILLAS</li>";

    }

}


if($registros->cargarRegistrosBase($identificador)){

    foreach($registros->cargarRegistrosBase($identificador) as $registro){

        echo "<div class = 'registro col-md-6'>
        <div class='btn-group'>
            <button type='button' class='btn btn-light-primary'><h4>".$registro["nombre"]."</h4></button>
            <button type='button' class='btn btn-light-primary dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            <span class='sr-only'>Toggle Dropdown</span>
            </button>
            <div class='dropdown-menu'>
            <a class='dropdown-item' href='index.php?pagina=5&registro=".$registro["nombre"]."'>USUARIOS</a>
            <a class='dropdown-item' href='index.php?pagina=6&registro=".$registro["nombre"]."'>AGREGAR PLANILLA</a>
            <a class='dropdown-item' href='#'></a>
            <div class='dropdown-divider'></div>
            <a class='dropdown-item' href='#'>ELIMINAR REGISTRO</a>
            </div>
        </div>

        <div>
        <h4 class = 'titulo-planillas'> PLANILLAS : </h4>
        <ul class='list-group'>
            ".cargarPlanillas()."
        </ul>

        </div>
        
    </div>";
    }
    

}else{

    echo "<h4> AUN NO HAS CREADO NINGÚN REGISTRO </h4>";

}



?>