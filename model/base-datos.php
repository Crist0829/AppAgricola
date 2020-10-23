<?php 

class Conexion{

    public $consulta;
    public $registro;
    public $conexion_db;

    public function __construct(){

        $this->conectar();

    }

    public function conectar(){

        require("config.php");
        try{

            $this->conexion_db = new PDO("mysql:host=$host; dbname=$base_datos", "$nombre_usuario", "$clave");
            $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion_db->exec("SET CHARACTER SET utf8");

        }catch(Exception $e){

            die("Error al intentar establecer conexion con la base de").$e->getMessage();

        }

    }

}


class Consultar extends Conexion{

    public function consultarNombre($nombre){

        $this->consulta = "SELECT * FROM usuarios_db where nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($nombre, $this->registro["nombre"]) == 0){

                $resultado->closeCursor();
                return 1;

            }else{

                $resultado->closeCursor();
                return 0;

            }
            

            $resultado->closeCursor();
            return 0;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function consultarCorreo($correo){

        $consulta = "SELECT * FROM usuarios_db where correo = :correo";

        $resultado = $this->conexion_db->prepare($consulta);
        $resultado->bindValue(":correo", $correo);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($correo, $this->registro["correo"]) == 0){

                $resultado->closeCursor();
                 return 1;

            }else{

                $resultado->closeCursor();
                return 0;

            }

            

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }


    public function consultarNombreTemp($nombre){

        $this->consulta = "SELECT * FROM usuarios_temp where nombre = :nombre";
        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->bindValue(":nombre", $nombre);

        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($nombre, $this->registro["nombre"]) == 0){

                $resultado->closeCursor();
                return 1;

            }else{

                $resultado->closeCursor();
                return 0;

            }

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function consultarCorreoTemp($correo){

        $consulta = "SELECT * FROM usuarios_temp where correo = :correo";

        $resultado = $this->conexion_db->prepare($consulta);

        $resultado->bindValue(":correo", $correo);

        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($correo, $this->registro["correo"]) == 0){

                $resultado->closeCursor();
                 return 1;

            }

            $resultado->closeCursor();
            return 0;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }

    public function verificarClave($clave){

        if(password_verify($clave, $this->registro["clave"])){

            return 1;
        }

        return 0;

    }

    public function consultarIdentificador($identificador){

        $this->consulta = "SELECT * FROM usuarios_db where identificador = :identificador";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }


    }

    public function getRegistro(){

        return $this->registro;

    }


}


class Insertar extends Conexion{


    public function insetarUsuario($nombre, $correo, $clave, $perfil, $identificador){

        $this->consulta = "INSERT INTO usuarios_db (nombre, correo, clave, perfil, identificaor) VALUES (:nombre, :correo, :clave, :perfl, :identificador)";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre" => $nombre, ":correo" => $correo, ":clave" => $clave,
                                  ":perfil" => $perfil, ":identificador" => $identificador));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function insertarUsuarioTemp($nombre, $correo, $clave, $perfil, $identificador, $activacion){

        $this->consulta = "INSERT INTO usuarios_temp (nombre, correo, clave, perfil, identificador, activacion) VALUES (:nombre, :correo, :clave, :perfil, :identificador, :activacion)";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre" => $nombre, ":correo" => $correo, ":clave" => $clave,
                                  ":perfil" => $perfil, ":identificador" => $identificador, ":activacion" => $activacion));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }
    
    


}

class Activacion extends Conexion{

    public $activacion;

    public function __construct($activacion){

        $this->conectar();
        $this->activacion = $activacion;

    }

    
    public function verificar($correo){

        $this->consulta = "SELECT * FROM usuarios_temp WHERE activacion = :activacion AND correo = :correo";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->bindValue(":activacion", $this->activacion);
        $resultado->bindValue(":correo", $correo);

        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            $resultado->closeCursor();

            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function eliminarTMP(){

        $this->consulta= "DELETE from usuarios_temp WHERE activacion = :activacion";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->bindValue(":activacion", $this->activacion);

        $resultado->execute();

    }


    public function insertarDB(){

        $this->consulta= "INSERT INTO usuarios_db (nombre, correo, clave, perfil, identificador) VALUES (:nombre, :correo, :clave, :perfil, :identificador)";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute(array(":nombre" => $this->registro["nombre"], ":correo" => $this->registro["correo"],
                                  ":clave" => $this->registro["clave"], ":perfil" => $this->registro["perfil"],
                                  ":identificador" => $this->registro["identificador"]));

    } 


    public function getRegistro(){

        return $this->registro;

    }



}

class Validar extends Conexion{

    public function validarNombre($nombre, $clave){

        $this->consulta = "SELECT * FROM usuarios_db WHERE nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->bindValue(":nombre", $nombre);

        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($nombre, $this->registro["nombre"]) == 0 && password_verify($clave, $this->registro["clave"])){

                $resultado->closeCursor();
                return 1;

            }else{

                $resultado->closeCursor();
                return 0;

            }

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function validarCorreo($correo, $clave){

        $this->consulta = "SELECT * FROM usuarios_db WHERE correo = :correo";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->bindValue(":correo", $correo);

        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);

            if(strcmp($correo, $this->registro["correo"]) == 0 &&  password_verify($clave, $this->registro["clave"])){
                
                $resultado->closeCursor();
                return 1;

            }else{

                $resultado->closeCursor();
                return 0;

            }

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function getRegistro(){

        return $this->registro;

    }

}

class Actualizar extends Consultar{

    public function actualizarDatos($nombre, $correo){
        
        $oldnombre = $this->registro["nombre"];
        $this->consulta = "UPDATE usuarios_db SET nombre = :nombre, correo = :correo WHERE nombre = :oldnombre";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre" => $nombre, ":correo" => $correo, ":oldnombre" => $oldnombre));

        if($resultado->rowCount() > 0){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

    public function nuevaConsulta($nombre, $correo){

        $this->consulta = "SELECT * FROM usuarios_db WHERE nombre = :nombre AND correo = :correo";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre"=>$nombre, ":correo" => $correo));

        if($resultado->rowCount() > 0){

            $this->registro= $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function actualizarClave($nombre, $clave){

        $this->consulta = "UPDATE usuarios_db SET clave = :clave WHERE nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->bindValue(":clave", $clave);
        $resultado->execute();

        if($resultado->rowCount() > 0){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }

    public function actualizarImagen($nombre, $rutaimagen){

        $this->consulta = "UPDATE usuarios_db SET imagen = :imagen WHERE nombre = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);

        $resultado->execute(array(":imagen" => $rutaimagen, ":nombre" => $nombre));

        if($resultado->rowCount() > 0){

            $resultado->closeCursor(); 
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }



    }

    public function eliminarImagen($nombre){

        $this->consulta = "UPDATE usuarios_db SET imagen = NULL where nombre = :nombre";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();


        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;
    
        }
    }


}


?>