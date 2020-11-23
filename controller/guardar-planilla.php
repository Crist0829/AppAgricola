<?php 

require_once("../model/base-datos-registros.php");
session_start();




if(isset($_GET["ncolumnas"]) && isset($_GET["nombre_registro"]) && isset($_GET["nombre_planilla"]) && 
    isset($_GET["fecha"]) && isset($_GET["frecuencia"]) ){


    $identificador = $_SESSION["identificador"];
    $nombre_registro = $_GET["nombre_registro"];
    $nombre_planilla = $_GET["nombre_planilla"];
    $nombre_planilla = strtolower($nombre_planilla);

    $nombre_registro_aux = $nombre_registro."_";

    $nombre_planilla_tabla = $nombre_registro_aux.$nombre_planilla."_".$identificador;
    $nombre_planilla_tabla = str_replace(" ", "_", $nombre_planilla_tabla);
    $nombre_planilla_tabla = strtolower($nombre_planilla_tabla);


    $fecha = $_GET["fecha"];
    $frecuencia = $_GET["frecuencia"];
    $ncolumnas = $_GET["ncolumnas"];     
    $tabla = array();
    $texto = 0;
    $numero = 0;
    $imagen= 0;




    function generarConsulta($tabla, $nombre_planilla_tabla){
        global $texto, $numero, $imagen;

        $aux = "";
    
        foreach($tabla as $nombre => $tipo){
           
            switch($tipo){
    
                case "texto":
                    $aux .= "$nombre varchar(60),";
                    $texto ++;
                break;
    
                case "numero":
                    $aux .= "$nombre int(20),";
                    $numero ++;
                break;
    
                case "imagen":
                    $aux .= "$nombre varchar(100),";
                    $imagen ++;
                break;
            }
        }
    
    
        $aux = substr($aux, 0, -1);
    
        $consulta = "CREATE TABLE $nombre_planilla_tabla (usuario int(15), fecha varchar(10), $aux)";
    
        return $consulta;
    }




    if(isset($_GET["observaciones"])){

        $observaciones = $_GET["observaciones"];

    }else{

        $observaciones = "SIN OBSERVACIONES";

    }

    for($i = 1; $i <= $ncolumnas; $i++){

        $aux_nombre = "n".$i;
        $nombre_columna = strtolower($_GET["$aux_nombre"]);

        $aux_tipo = "t".$i;
        $tipo_columna = strtolower($_GET["$aux_tipo"]);


        $tabla += [$nombre_columna => $tipo_columna];

    }

    $consulta = generarConsulta($tabla, $nombre_planilla_tabla);

    $planilla = new Planilla();

    if($planilla->crearTabla($consulta) && $planilla->insertarPlanilla($nombre_planilla, $nombre_registro, $identificador, 
    $fecha, $observaciones, $frecuencia, $ncolumnas, $texto, $numero, $imagen)){

        echo "1";

    }else{

        echo "0";

    }


    
   

}else{

    echo "0";


}


















?>