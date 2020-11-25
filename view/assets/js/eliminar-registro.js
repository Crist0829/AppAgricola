

function validar(){

    let clave = document.getElementById("clave").value
    

    if(clave == "" ){

        swal("¡ESCRIBE TU CONTRASEÑA!", "Escribe tu contraseña para confirmar los cambios", "error")
        return false

    }

    let opcion = confirm("¿Estás seguro que deseas eliminar el registro?")

    if(opcion){

        return

    }else{

        return false

    }

}