<?php 

require_once("../model/base-datos-registros.php");
session_start();

if(isset($_SESSION["nombre_registro"])){

    $nombre_registro_normal = $_SESSION["nombre_registro"];
    $nombre_registro_tabla = str_replace(" ", "_", $nombre_registro_normal);
    $nombre_registro_tabla = $nombre_registro_tabla."_".$_SESSION["identificador"];
    $nombre_registro = strtolower($nombre_registro_normal);
    $nombre_registro_tabla = strtolower($nombre_registro_tabla);
    $registro = new Registro();

    if($registro->consultarNombreRegistro($nombre_registro_tabla)){

        function cargarImagen($a){

            if($a == null){

                return "view/assets/media/image/user/default.png";

            }else{

                return $a;

            }

        }
        echo "<div class = 'col-md-6'>
        <h1 class = 'texto-verde text-center'>".$nombre_registro_normal."</h1>
        <p class = 'text-center'><a  href = #conectar> dale aquí para conectar usuario </a></p>
        </div>";

        if($registro->cargarUsuarios($nombre_registro_tabla)){

            echo "<div class = 'registro-2 col-md-6'>
        
            <div>
            <h5 class='titulo-usuarios text-center'> USUARIOS CONECTADOS</h5>
            <hr>
            <div>";

            foreach($registro->cargarUsuarios($nombre_registro_tabla) as $registro){

                echo " <div class = 'registro-3 d-flex align-self-center'>
                
                <div class = 'col-md-12'>
                <figure class = 'text-center'> <img width = '100' src = ".cargarImagen($registro["imagen"])."> </figure>
                <h5 class = 'text-center'><strong class = 'texto-verde'>" .$registro["nombre"]."</strong></h5>
                <hr>
                <p class = 'p-per'> ID: <strong class = 'texto-verde'>" .$registro["identificador"]."</strong></p>
                <p class = 'p-per'> EMAIL: <strong class = 'texto-verde'>" .$registro["correo"]."</strong></p>
                </div>
                <div class = 'col-md-12 text-center'>
                <hr>
                <a href= '#' onclick = 'confirmar(".$registro["identificador"].")' id = '".$registro["identificador"]."' class = 'btn btn-primary btn-sm-block'> <small> DESVINCULAR </small> </a>
                </div>
                </div> ";

            }

            echo "</div>
        
                </div>
            
            </div>";

            
            echo "
                <div class = 'registro-3 col-md-6' id='conectar'>
                <h5 class = 'titulo-usuarios text-center'>CONECTAR USUARIO</h5>
                <hr>
                <form onsubmit='return validar()' method='POST' action='controller/conectar-usuario.php' class = 'col-md-6 d-flex align-self-center'>
                    <div>
                    
                    <div class='form-group'>

                        <label>ID del usuario</label>
                        <input type='text' class='form-control' name='id' id='identi' onchange = 'fIdentificador()'  required>

                    </div>
                    
                    <div class='form-group'>

                        <label>Escribe tu contraseña para confirmar</label>
                        <input type='password' name='clave' id='clave' class='form-control' required>

                    </div>

                    <div class='form-group'>
                        <input type='submit' class='btn btn-primary btn-block' value='CONECTAR USUARIO'>
                    </div>
                            </div>
                </form>
                </div>";

        }else{

            echo "
            
            <div class= 'registro col-md-6'>
            <h5 class = 'text-center'>Conectar usuario</h5>
            <hr>
            <p class = 'text-center'> Aún no has conectado usuarios a <strong> $nombre_registro_normal </strong> </p>
            </div>";

            echo "
                <div class = 'registro-3 col-md-6' id='conectar'>
                <h5 class = 'titulo-usuarios text-center'>CONECTAR USUARIO</h5>
                <hr>
                <form onsubmit='return validar()' method='POST' action='controller/conectar-usuario.php' class = 'col-md-6 d-flex align-self-center'>
                    <div>
                    
                    <div class='form-group'>

                        <label>ID del usuario</label>
                        <input type='text' class='form-control' name='id' id='identi' onchange = 'fIdentificador()'  required>

                    </div>
                    
                    <div class='form-group'>

                        <label>Escribe tu contraseña para confirmar</label>
                        <input type='password' name='clave' id='clave' class='form-control' required>

                    </div>

                    <div class='form-group'>
                        <input type='submit' class='btn btn-primary btn-block' value='CONECTAR USUARIO'>
                    </div>
                            </div>
                </form>
                </div>";

        }
        

    }else{

        echo "el registro no existe";

    }


}else{

    echo "Nada qué mostrar";

}










?>