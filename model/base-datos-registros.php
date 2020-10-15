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
        perfil int(1),
        planillas int(10))";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();
        $resultado->closeCursor();
        return 1;

    }

    public function insertarRegistro($nombre, $identificador, $perfil){

        $this->consulta = "INSERT INTO registros_base (nombre, identificador, perfil) values (:nombre, :identificador, :perfil)";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre"=>$nombre, ":identificador"=>$identificador, ":perfil"=>$perfil));

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