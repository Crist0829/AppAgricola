window.onload = function (){

    let usuarios = document.getElementById("usuarios");

    var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
    
            
            usuarios.innerHTML = this.responseText;    
                
        }
      }
    xhttp.open("GET", "controller/administrar-usuarios.php", true);
    xhttp.send();


}



function fIdentificador(){

    let identi = document.getElementById("identi").value;

    if(isNaN(identi) || identi.length > 7 || identi == ""){

        return 0;

    }else{

        return 1;

    }

}


function validar(){

    if(fIdentificador() == 0){

        swal("¡VERIFICA EL CAMPO ID DEL USUARIO!", "Verifica que el campo ID tenga menos de 8 cifras y que pertenezca a un usuario registrado", "error")
        return false;

    }else{

        return;

    }

}

function confirmar(a){

    a.toString();
    
    let opcion = confirm("¿Estás seguro que deseas desvincular al usuario del registro? Al hacer esto no se perderá el historial de las planillas que ha llenado pero en adelante, el usuario no podrá ver el registro");
    if (opcion == true) {

       document.getElementById(a).setAttribute("href", "../controller/desvincular-usuario.php?id="+a)

	} else {

        document.getElementById(a).setAttribute("href", "#")
        
	}
	

}