<?php 

class ConexionRegistro{

    public $consulta;
    public $registro;
    public $conexion_db;

    public function __construct(){

        $this->conectar();

    }

    public function conectar(){

        require("config.php");
        try{

            $this->conexion_db = new PDO("mysql:host=$host; dbname=$base_datos_registros", "$nombre_usuario", "$clave");
            $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion_db->exec("SET CHARACTER SET utf8");

        }catch(Exception $e){

            die("Error al intentar establecer conexion con la base de datos").$e->getMessage();

        }

    }

}

class Registro extends ConexionRegistro{

    public function consultarNombreRegistro($nombre){

        $this->consulta = "SHOW TABLES LIKE ?";

        $resultado = $this->conexion_db->prepare($this->consulta);
       
        $resultado->bindValue(1, $nombre, PDO::PARAM_STR);
        $resultado->execute();


        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function crearTabla($nombre){

        $this->consulta = "CREATE TABLE $nombre
        (nombre varchar(60) NOT NULL,
        identificador int(15),
        imagen varchar(100),
        correo varchar(100))";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();
        $resultado->closeCursor();
        return 1;

    }

    public function insertarRegistro($nombre, $identificador){

        $this->consulta = "INSERT INTO registros_base (nombre, identificador) values (:nombre, :identificador)";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre"=>$nombre, ":identificador"=>$identificador ));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function cargarRegistrosBase($identificador){

        $this->consulta = "SELECT * FROM registros_base WHERE identificador = :identificador";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $resultado->closeCursor();
        return $this->registro;
    }

    public function cargarUsuarios($nombre_tabla){

        $this->consulta = "SELECT * FROM $nombre_tabla";
        
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();
        
        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
        $resultado->closeCursor();
        return $this->registro;

    }

    public function consultarUsuario($nombre_tabla, $identificador){

        $this->consulta = "SELECT * FROM $nombre_tabla where identificador = :identificador";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

    public function conectarUsuario($nombre_tabla, $nombre, $identificador, $correo, $imagen){

        $this->consulta = "INSERT INTO $nombre_tabla (nombre, identificador, correo, imagen) VALUES (:nombre, :identificador, :correo, :imagen)";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre" => $nombre, ":identificador" => $identificador, ":correo" => $correo, ":imagen"  => $imagen));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

}

class Planilla extends ConexionRegistro{


    public function consultarPlanilla($identificador){

        $this->consulta = "SELECT * FROM planillas_base WHERE identificador = :identificador";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            return 0;

        }

        



    }

    public function cargarPlanilla($identificador){

        $this->consulta = "SELECT * FROM planillas_base WHERE identificador = :identificador";

        $resultado = $this->registro->prepare($this->consulta);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

        if($resultado->rowCount()){
            
            $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return $this->registro;

        }else{

            return 0;

        }

        



    }





}


?>