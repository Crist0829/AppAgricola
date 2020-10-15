var aux_n = 0;



//--------------------//
function fNombre(){

    var nombre = document.getElementById("nombre").value;
    
    minus = /[a-z]/;
    mayus = /[A-Z]/;
    
    nombre_v = nombre.split("");
    
    if((minus.test(nombre_v[0]) == 0 && mayus.test(nombre_v[0]) == 0)|| nombre.length >  30 || nombre == ""){
        document.getElementById("enombre").setAttribute("class", "texto-rojo");
        document.getElementById("enombre").innerHTML = "No puede iniciar con un número <br> \n\
                                                         o  caracter especial <br> \n\
                                                          y tampoco puede estar vacío \n\
                                                          o tener más de 30 caracteres";
        aux_n = 0;
        
    
    }else{
    
        var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
    
            let resultado = parseInt(this.responseText);
        
            if(resultado == 0){

                document.getElementById("enombre").setAttribute("class", "texto-verde");
                document.getElementById("enombre").innerHTML = "El nombre de registro está disponible";
                aux_n = 1;
    
            }else{
    
                document.getElementById("enombre").setAttribute("class", "texto-rojo");
                document.getElementById("enombre").innerHTML = "Ya has creado un registro con ese nombre, intenta con otro.";
                aux_n = 2;
    
                
                
        }
      }
    }
    xhttp.open("GET", "controller/consultar-registro.php?nombre=" + nombre, true);
    xhttp.send();
    
    }
    
    }
//--------------------//
    

function validar(){

    if(aux_n == 0){

        swal("Verifica el nombre y vuelve a intentarlo")
        return false;

    }else if(aux_n == 2){

        swal("Ya has creado un registro con ese nombre, intenta con otro");
        return false;


    }else{

        return;

    }


}
