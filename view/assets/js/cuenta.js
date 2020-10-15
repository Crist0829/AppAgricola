//--variables auxiliares para las funciones fNombre y fCorreo respectivamente--//
//--------------//
var aux_n = 3;
var aux_c = 3;
//--------------//


/* Esta función se ejecuta cuando el usuario cambia algo en el campo de texto "nombre"
Y evalua si el usuario ha escrito el nombre correctamente, es decir, sin comenzar con
un numero, que no tenga más de 30 caracteres, que no esté vació y que el nombre de usuario no se hay registrado previamente
si no es así establece que el valor de la variable auxiliar aux_n  es 0*/
//--------------------//
function fNombre(){

let nombre = document.getElementById("nombre").value;

minus = /[a-z]/;
mayus = /[A-Z]/;

nombre_v = nombre.split("");

if((minus.test(nombre_v[0]) == 0 && mayus.test(nombre_v[0]) == 0)|| nombre.length >  30){
    document.getElementById("ecorreo").setAttribute("class", "texto-rojo");
    document.getElementById("enombre").innerHTML = "No puede iniciar con un número <br> \n\
                                                     o  caracter especial <br> \n\
                                                      y tampoco de tener más de 30 caracteres";
    aux_n = 0;
    

}else if(nombre === ""){

    document.getElementById("enombre").innerHTML = "";
    aux_n = 2;

}else{

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

        var resultado = parseInt(this.responseText);
    
        if(resultado == 0){
            document.getElementById("enombre").setAttribute("class", "texto-verde");
            document.getElementById("enombre").innerHTML = "El nombre de usuario está disponible";
            aux_n = 1;

        }else{

                if(nombre === document.getElementById("nombre").placeholder){

                    document.getElementById("enombre").innerHTML = "";
                    aux_n = 2;
                }else{

                    document.getElementById("enombre").setAttribute("class", "texto-rojo");
                    document.getElementById("enombre").innerHTML = "El nombre de usuario ya se encuentra en uso <br> intenta con otro";
                    aux_n = 0;

                }
            
            
    }
  }
}
xhttp.open("GET", "controller/consultar-usuario-correo.php?nombre=" + nombre, true);
xhttp.send();

}

}
//--------------------//


/* Esta función se ejecuta cuando el usuario cambia algo en el campo de texto "correo o email"
Y evalua si el usuario ha escrito el correo correctamente, es decir, que esté en un formato de correo válido y
que el correo no se haya registrado previamente si no es así establece que el valor de la variable auxiliar
aux_c  es 0*/
//--------------------//
function fCorreo(){

var correo = document.getElementById("correo").value;

expresion_c = /\w+@+\w+\.+[a-z]/;

if(correo === ""){

    document.getElementById("ecorreo").innerHTML = "";
    aux_c = 2;

}else if(expresion_c.test(correo) === false){

    document.getElementById("ecorreo").setAttribute("class", "texto-rojo")
    document.getElementById("ecorreo").innerHTML = "Debe tener un formato de correo valido";
    aux_c = 0;

}else{

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

        var resultado = parseInt(this.responseText);
    
        if(resultado == 0){

            document.getElementById("ecorreo").setAttribute("class", "texto-verde");
            document.getElementById("ecorreo").innerHTML = "La dirección de correo es válida";
            aux_c = 1;

        }else{

            if(correo == document.getElementById("correo").placeholder){

                document.getElementById("ecorreo").innerHTML = "";
                aux_c = 2;

            }else{

                document.getElementById("ecorreo").setAttribute("class", "texto-rojo")
                document.getElementById("ecorreo").innerHTML = "La dirección de correo ya está en uso, intenta con otra";
                aux_c = 0;

            }
            
            
    }
  }
}
xhttp.open("GET", "controller/consultar-usuario-correo.php?correo=" + correo, true);
xhttp.send();

}
}
//--------------------//


function cambiarDatos(){

    if(document.getElementById("clave").value === ""){

        swal("Escribe tu contraseña para verificar los cambios");
        return false;

    }
    
    if(aux_n === 3 && aux_c === 3){

        swal("No has hecho ningún cambio");
        return false;

    }else if(aux_n == 2 && aux_c == 2){

        swal("No has hecho ningun cambio");
        return false;

    }else if(aux_n === 0 || aux_c === 0){

        swal('DATOS INCORRECTOS', 'Comprueba los datos e intetalo nuevamente.', 'error');
        return false;

    }else if((aux_n == 1 && aux_c !== 0) || (aux_c == 1 && aux_n !== 0)){

        return;

    }

}

