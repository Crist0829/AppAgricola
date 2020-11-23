<?php 



/*Se evalua si los datos han sido pasados por el método GET correctamente 
si no es así, entonces retorna un mensaje de error, si es así, entonces
se procede a evaluar si el número de columnas es mayor que 20, si es así
se retorna con un error, sino es así, se procede a generar la planilla*/
if(isset($_GET["nombre"]) && isset($_GET["ncolumnas"]) && isset($_GET["frecuencia"]) && isset($_GET["observaciones"])){


    if($_GET["ncolumnas"] > 20){

        echo "Error al generar la planilla, revisa los datos y vuelve a intentarlo";

    }else{

        session_start();

        $nombre_editor = $_SESSION["nombre"];
        $nombre_registro = $_SESSION["nombre_registro"];
        $nombre_planilla = $_GET["nombre"];
        $ncolumnas = $_GET["ncolumnas"];
        $frecuencia = $_GET["frecuencia"];
        $observaciones = $_GET["observaciones"];
        $a_fecha = getdate();
        $fecha = $a_fecha["year"]."-".$a_fecha["mon"]."-".$a_fecha["mday"];
        

        function notasObservaciones(){
            global $observaciones;
            if($observaciones == "NOTAS U OBSERVACIONES" || $observaciones == "" ){

                return;

            }else{

                return "
                <div class = 'registro-2'>
                <p class = 'text-center'> <strong> OBSERVACIONES: </strong></p>
                <p class = 'p-per-2'> <strong> ".$observaciones." </strong></p>
                </div>";

            }


        }


        function columnas(){
            global $ncolumnas;
            $total_columnas = '';

            for($i = 1; $i <= $ncolumnas; $i++){

                $nombre = "n$i";
                $parrafo = "p$i";
                $tipo = "t$i";

            $total_columnas .=  "
            <div class = 'registro'>
            <h5 class = 'text-center texto-gris'> COLUMNA ".$i." </h5>
            <hr>

            <div class='form-group'>
                <label for='".$nombre."'>NOMBRE:</label>
                <p class = 'p-per-2' id = '$parrafo'></p>
                <input type='text'  class='form-control' name='".$nombre."' id = '".$nombre."' onchange = 'nombreColumna(".$i.")' required>
                <hr>
            </div>
            
            <div class='form-group'>
                
            <label for='".$tipo."'>TIPO DE INFORMACIÓN:</label>
                <select name='".$tipo."' id='".$tipo."' class='form-control'>
                    <option value = 'texto'>Texto</option>
                    <option value = 'numero'>Número</option>
                    <option value = 'imagen'>Imágen</option>
                </select>
            </div> 


            </div>
            
            ";

            }


            return $total_columnas;

        }

    

        echo "
        <h5 class = 'card-title'>PLANILLA GENERADA </h5>
        <div class = 'registro-2 col-md-6' id = 'planilla-generada'>

        <h4 class = 'titulo-planillas text-center'> DATOS PRINCIPALES </h4>      
        <hr>

        <div class = 'registro-2'>
            <p class = 'text-center p-per'> <strong> NOMBRE: </strong></p>
            <p class = 'text-center texto-verde' id = 'nombrePlanilla'><strong>".$nombre_planilla."</strong></p>
        </div>

        <div class = 'registro-2'>
            <p class = 'text-center p-per'> <strong> REGISTRO: </strong></p>
            <p class = 'text-center texto-verde' id = 'nombreRegistro'><strong>".$nombre_registro."</strong></p>
        </div>

        <div class = 'registro-2'>
            <p class = 'text-center p-per'> <strong> EDITOR O ENCARGADO: </strong></p>
            <p class = 'text-center texto-verde'><strong>".$nombre_editor."</strong></p>
        </div>
        
        <div class = 'registro-2'>
            <p class = 'text-center p-per'> <strong> FECHA DE CREACIÓN: </strong></p>
            <p class = 'text-center texto-verde' id = 'fecha'><strong>".$fecha."</strong></p>
        </div>

        <div class = 'registro-2'>
            <p class = 'text-center'> <strong> FRECUENCA CON QUE LA QUE DEBE LLENAR: </strong></p>
            <p class = 'text-center texto-verde' id = 'frecuenciaValor'><strong> ".strtoupper($frecuencia)."</strong></p>
        </div>

        ".notasObservaciones()."
        
        </div>";


        echo "<form onsubmit = 'return false'>
        <div class = 'registro-2 col-md-6'>
        <h5 class = 'text-center'> COLUMNAS </h5>
        <hr>
        
            ".columnas()."
        
        </div>

        <div class = 'form-group col-md-6'>

            <hr>
            <p class = 'p-per-2'>Al darle click o presionar el boton 'GUARDAR PLANILLA' la planilla se almacenará en la base de datos
                y será asociada al registro y por ende, todos los usuarios conectados al registro podrán consultarla
                y llenarla con los datos correspondientes, si te sales de esta página sin guardar, toda la información
                de la planilla se perderá. 
            <p>

            <hr>

            <a class = 'btn btn-primary btn-block' onclick = 'guardarPlanilla(".$ncolumnas.")' > GUARDAR PLANILLA</a>

        </div>
        </form>";

    }

}


?>