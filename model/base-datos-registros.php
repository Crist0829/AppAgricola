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

    public function consultarNombreTabla($nombre){

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

    public function desvincularUsuario($identificador, $nombre_tabla){

        $this->consulta = "DELETE FROM $nombre_tabla WHERE identificador = :identificador";

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

    public function desvincularUsuarioUB($identificador_usuario, $identificador_editor, $nombre_registro){

        $this->consulta = "DELETE FROM usuarios_base WHERE identificador_usuario = :identificador_usuario AND identificador_editor = :identificador_editor
                            AND nombre_registro = :nombre_registro";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":identificador_usuario" => $identificador_usuario,
                                  ":identificador_editor" => $identificador_editor,
                                  ":nombre_registro" => $nombre_registro));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }


    }


    public function conectarUsuarioUB($nombre_usuario, $identificador_usuario, $nombre_editor, $identificador_editor, $nombre_registro){

        $this->consulta = "INSERT INTO usuarios_base (nombre_usuario, identificador_usuario, nombre_editor, identificador_editor, nombre_registro) 
        VALUES (:nombre_usuario, :identificador_usuario, :nombre_editor, :identificador_editor, :nombre_registro)";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre_usuario" => $nombre_usuario, ":identificador_usuario" => $identificador_usuario,
         ":nombre_editor" => $nombre_editor, ":identificador_editor"  => $identificador_editor, ":nombre_registro"=> $nombre_registro));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

    public function extraerPlanillas($nombre_registro, $identificador){

        $this->consulta = "SELECT nombre FROM planillas_base WHERE nombre_registro = :nombre_registro AND identificador = :identificador";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre_registro", $nombre_registro);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $this->registro;

    }

    public function eliminarRegistro($nombre_registro, $identificador){

        $this->consulta = "DELETE FROM registros_base where nombre = :nombre AND identificador = :identificador";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre_registro);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

    }

    public function eliminarRegistroUB($nombre_registro, $identificador){

        $this->consulta = "DELETE FROM usuarios_base where nombre_registro = :nombre_registro AND identificador_editor = :identificador";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre_registro", $nombre_registro);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->execute();

    }

    public function eliminarRegistroTabla($nombre_registro_tabla){

        $this->consulta = "DROP TABLE $nombre_registro_tabla";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

    }

    public function consultarUsuarioComun($nombre_usuario){

        $this->consulta = "SELECT * FROM usuarios_base where nombre_usuario = :nombre_usuario";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre_usuario", $nombre_usuario);
        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

    public function consultarUsuarioEditor($nombre_usuario, $nombre_editor, $nombre_registro){

        $this->consulta = "SELECT * FROM usuarios_base where nombre_usuario = :nombre_usuario AND nombre_editor = :nombre_editor AND nombre_registro = :nombre_registro";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre_usuario", $nombre_usuario);
        $resultado->bindValue(":nombre_editor", $nombre_editor);
        $resultado->bindValue("nombre_registro", $nombre_registro);
        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }
    }

    public function actualizarImagen($nombre_registro_tabla, $nombre, $rutaimagen){

        $this->consulta = "UPDATE $nombre_registro_tabla SET imagen = :imagen WHERE nombre = :nombre";

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

    public function eliminarImagen($nombre_registro_tabla, $nombre){

        $this->consulta = "UPDATE $nombre_registro_tabla SET imagen = NULL where nombre = :nombre";
        
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

class Planilla extends ConexionRegistro{


    public function consultarPlanillas($identificador, $nombre){

        $this->consulta = "SELECT * FROM planillas_base WHERE identificador = :identificador AND nombre_registro = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            return 0;

        }


    }

    public function consultarNombrePlanilla($nombre, $nombre_registro){

        $this->consulta = "SELECT * FROM planillas_base WHERE nombre = :nombre AND nombre_registro = :nombre_registro";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->bindValue(":nombre_registro", $nombre_registro);
        $resultado->execute();

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{
            $resultado->closeCursor();
            return 0;

        }

    }

    public function cargarPlanillas($identificador, $nombre){

        $this->consulta = "SELECT * FROM planillas_base WHERE identificador = :identificador and nombre_registro = :nombre";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":identificador", $identificador);
        $resultado->bindValue(":nombre", $nombre);
        $resultado->execute();

        if($resultado->rowCount()){
            
            $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return $this->registro;

        }else{

            return 0;

        }

        



    }

    public function cargarPlanilla($nombre_registro, $nombre_planilla){

        $this->consulta = "SELECT * FROM planillas_base WHERE nombre = :nombre_planilla and nombre_registro = :nombre_registro";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":nombre_planilla", $nombre_planilla);
        $resultado->bindValue(":nombre_registro", $nombre_registro);
        $resultado->execute();

        if($resultado->rowCount()){
            
            $this->registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return $this->registro;

        }else{

            return 0;

        }

        



    }

    public function consultarPlanillaTabla($nombre){

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

    public function crearTabla($consulta){

        $this->consulta = $consulta;

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();
        $resultado->closeCursor();
        return 1;


    }

    public function insertarPlanilla($nombre, $nombre_registro, $identificador, $fecha, $observaciones, $frecuencia, $ncolumnas, $texto, $numero, $imagen){


        $this->consulta = "INSERT INTO planillas_base (nombre, nombre_registro, identificador, fecha, observaciones, frecuencia, ncolumnas, texto, numero, imagen) 
                                  values (:nombre, :nombre_registro, :identificador, :fecha, :observaciones, :frecuencia, :ncolumnas, :texto, :numero, :imagen)";

        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre"=>$nombre, ":nombre_registro" => $nombre_registro, ":identificador"=>$identificador,
                                  ":fecha" => $fecha, ":observaciones" => $observaciones, ":frecuencia" => $frecuencia, ":ncolumnas" => $ncolumnas,
                                ":texto" => $texto, ":numero" => $numero, ":imagen" => $imagen));

        if($resultado->rowCount()){

            $resultado->closeCursor();
            return 1;

        }else{

            $resultado->closeCursor();
            return 0;

        }


    }

    public function nombresColumna($nombre_planilla_tabla){

        $this->consulta = "SHOW COLUMNS FROM $nombre_planilla_tabla";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);

        $resultado->closeCursor();
        return $this->registro;


    }

    public function cargarRegistroPlanilla($nombre_planilla_tabla){

        $this->consulta = "SELECT * FROM $nombre_planilla_tabla";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        if($resultado->rowCount()){

            $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            return $this->registro;

        }else{

            $resultado->closeCursor();
            return 0;

        }

    }

    public function cargarUsuarios($nombre_registro){

        $this->consulta = "SELECT nombre from $nombre_registro";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $this->registro;


    }

    public function cargarContenido($nombre_planilla_tabla, $nombre_usuario){

        $this->consulta = "SELECT * from $nombre_planilla_tabla WHERE usuario = :usuario";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->bindValue(":usuario", $nombre_usuario);
        $resultado->execute();

        $this->registro = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $this->registro;


    }

    public function eliminarPlanilla($nombre_planilla, $nombre_registro, $identificador){

        $this->consulta = "DELETE FROM planillas_base where nombre = :nombre_planilla AND nombre_registro = :nombre_registro AND identificador = :identificador ";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute(array(":nombre_planilla" => $nombre_planilla, "nombre_registro" => $nombre_registro,
                                ":identificador" => $identificador));

    }

    public function eliminarPlanillaTabla($nombre_planilla_tabla){

        $this->consulta = "DROP TABLE $nombre_planilla_tabla";
        $resultado = $this->conexion_db->prepare($this->consulta);
        $resultado->execute();

    }



}


?>