<?php 

require_once("../model/base-datos.php");

use  PHPMailer \ PHPMailer \ PHPMailer ;
use  PHPMailer \ PHPMailer \ SMTP ;
use  PHPMailer \ PHPMailer \ Exception ;

require ("vendor/autoload.php");


$nombre = htmlentities(addslashes($_POST["nombre"]));
$correo = htmlentities(addslashes($_POST["correo"]));
$clave = htmlentities(addslashes($_POST["clave"]));
$clave_cifrada =password_hash($clave, PASSWORD_DEFAULT);
$perfil = $_POST["perfil"];

$identificador = rand(0, 9999999);

$consultar_identificador = new Consultar();

while($consultar_identificador->consultarIdentificador($identificador)){

    $identificador = rand(0, 9999999);

}

$activacion_sin = rand(0, 99999);
$activacion_con = password_hash($activacion_sin, PASSWORD_DEFAULT);

$registrar = new Insertar();

if($registrar->insertarUsuarioTemp($nombre, $correo, $clave_cifrada, $perfil, $identificador, $activacion_con)){

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'ccjd.0796@gmail.com';
    $mail->Password = 'Nathaly0829.';
    $mail->setFrom('APPAGRICOLA@gmail.com', 'App Agricola');
    $mail->addAddress($correo, $nombre);
    $mail->Subject = 'Activacion de la cuenta';
    //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
    $mail->Body = "Ingrea a este link para activar la cuenta: http://".$_SERVER["SERVER_NAME"]."/Php/AppAgricola/view/activacion.php?correo=$correo&activacion=$activacion_con";

if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

    echo 'The email message was sent.';
    header("location:../view/verificacion.php");

}
}


?>