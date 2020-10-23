<?php 

/*este archivo es cargado al iniciio y muestra mensajes de error dependiendo el caso*/

if(isset($_GET["mensaje"])){

        if($_GET["mensaje"] == 0){

            echo "<script>

            window.onload=function() {
                
                swal('CONTRASEÑA INCORRECTA', 'Vuelve a escribir tu nombre de usuario (o email) y contraseña', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 1){

            echo "<script>

            window.onload=function() {
                
                swal('CONTRASEÑA INCORRECTA', 'No pudimos realizar los cambios, verifica tu contraseña.', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 2){

            echo "<script>

            window.onload=function() {
                
                swal('NO PUDIMOS REALIZAR LA PETICIÓN', 'Por favor, intenta más tarde.', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 4){

            echo "<script>

            window.onload=function() {
                
                swal('ERROR AL SUBIR LA IMAGEN', 'No pudimos subir la imagen, comprueba que hayas selecionado un archivo, que tenga un formato correcto y que su tamaño sea menor a 2MB', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 5){

            echo "<script>

            window.onload=function() {
                
                swal('¡CAMBIASTE LA CONTRASEÑA!', 'Cambiaste la contraseña correctamente', 'success');
            }
            </script>";

        }else if($_GET["mensaje"] == 6){

            echo "<script>

            window.onload=function() {
                
                swal('¡LAS CONTRASEÑAS NO COINCIDEN!', 'Escribe tu nueva contraseña y repítela para confirmar el cambio.', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 7){

            echo "<script>

            window.onload=function() {
                
                swal('CONTRASEÑA INCORRECTA', 'No pudimos crear el registro', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 8){

            echo "<script>

            window.onload=function() {
                
                swal('ERROR AL CREAR EL REGISTRO', 'No pudimos crear el registro intentelo más tarde', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 9){

            echo "<script>

            window.onload=function() {
                
                swal('¡REGISTRO CREADO!', 'Creaste el registro correctamente, dirígete a MIS REGISTROS para administrarlo', 'success');
            }
            </script>";

        }/* else if($_GET["mensaje"] == 10){

            echo "<script>

            window.onload=function() {
                
                swal('ERROR AL CONECTAR USUARIO', 'No pudimos conectar el usuario al registro, por favor, intentelo más tarde', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 11){

            echo "<script>

            window.onload=function() {
                
                swal('CONTRASEÑA INCORRECTA', 'No pudimos conectar el usuario al registro', 'error');
            }
            </script>";

        }else if($_GET["mensaje"] == 12){

            echo "<script>

            window.onload=function() {
                
                swal('El ID del usuario ya está conectado con esté registro...');
            }
            </script>";

        }else if($_GET["mensaje"] == 9){

            echo "<script>

            window.onload=function() {
                
                swal('¡USUARIO CONECTADO!', 'Conectaste al usuario con el registro, ahora el puede llenar y consultar las planillas', 'success');
            }
            </script>";
        }*/
        



}


?>