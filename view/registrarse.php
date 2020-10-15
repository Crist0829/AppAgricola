<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APP AGRICOLA</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/media/image/favicon.png"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="vendors/bundle.css" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="assets/css/app.min.css" type="text/css">
</head>
<body class="form-membership">

<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->

<div class="form-wrapper">

    <!-- imagen -->
    <div id="logo">
        <img src="assets/media/image/registrarse.png" alt="image">
    </div>
    <!-- ./ imagen -->

    
    <h3>Registrarse a la App</h3>
    <hr>

    <!-- formulario -->
    <form action="../controller/registrarse.php" method="POST" onsubmit="return validar()" >

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nombre de usuario" id="nombre" name="nombre" onchange="fNombre()" required>
            <p id="enombre" class="p-per"></p>
        </div>
        

        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" id="correo" name ="correo" onchange="fCorreo()" required>
            <p id="ecorreo" class="p-per"></p>
        </div>

        <div class="form-group">

            <input type="password" class="form-control" placeholder="contraseña" id="clave" name = "clave" onchange="fClave()" required>
            <p id="eclave" class="p-per"></p>

        </div>

        <div class="form-group">
            
            <input type="password" class="form-control" placeholder="repite tu contraseña" id="rclave" onchange="frClave()" required>
            <p id="erclave" class="p-per"></p>

        </div>


        <h5>Registrarse como...</h5>

        <div class="form-group d-flex justify-content-between">
            
        <div class="custom-control custom-radio">
            <input type="radio" id="USUARIO" name="perfil" class="custom-control-input" value= "0" checked>
            <label class="custom-control-label" for="USUARIO">USUARIO</label>
        </div>

        <div class="custom-control custom-radio">
            <input type="radio" id="EDITOR" name="perfil" class="custom-control-input" value="1">
            <label class="custom-control-label" for="EDITOR">EDITOR</label>
        </div>

        </div>

        <button class="btn btn-primary btn-block">REGISTRARSE</button>

        <div>


        </div>


        <hr>
        <p>¿Ya tienes un cuenta?</p>
        <a href="../index.php" class="btn btn-primary btn-sm">Iniciar sesión</a>
    </form>
    <!-- ./ formulario -->


</div>

<!-- Plugin scripts -->
<script src="vendors/bundle.js"></script>

<!-- App scripts -->
<script src="assets/js/app.min.js"></script>

<script src="assets/js/validar.js"> </script>
</body>
</html>
