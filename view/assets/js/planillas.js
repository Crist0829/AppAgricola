aux_n;



/* Esta función se ejecuta cuando el usuario cambia algo en el campo de texto "nombre"
 Y evalua si el usuario ha escrito el nombre correctamente, es decir, sin comenzar con
 un numero, que no tenga más de 30 caracteres, que no esté vació y que el nombre de planilla no se haya registrado previamente para
 el mismo registro.
 si no es así establece que el valor de la variable auxiliar aux_n  es 0*/
//--------------------//
function fNombre(){

    let nombre = document.getElementById("nombre").value

    minus = /[a-z]/;
    mayus = /[A-Z]/;

    nombre_v = nombre.split("");

    if((minus.test(nombre_v[0]) == 0 && mayus.test(nombre_v[0]) == 0) || nombre === "" || nombre.length >  30){
        
        document.getElementById("enombre").setAttribute("class", "p-per-3")
        document.getElementById("enombre").innerHTML = "Este campo no puede estar vacío, no puede iniciar con un número o caracter especial \n\
                                                        y tampoco de tener más de 30 caracteres.";
        return 0;
        

    }else{

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var resultado = parseInt(this.responseText);
        
            if(resultado == 0){

                document.getElementById("enombre").setAttribute("class", "p-per-4")
                document.getElementById("enombre").innerHTML = "El nombre de planilla es correcto."
                aux_n = 1;

            }else{

                document.getElementById("enombre").setAttribute("class", "p-per-3")
                document.getElementById("enombre").innerHTML = "Ya has creado una planilla con ese nombre, intenta con otro."
                aux_n = 0;
                
        }
      }
    }
    xhttp.open("GET", "controller/consultar-planilla.php?nombre="+nombre, true);
    xhttp.send();

    }

}
//--------------------//



/*Esta funcion evalue el número de columnas que el usuario digito en el input
si el número de columnas es mayor a 20 o no es un número o está vacío,
mostrará el texto rojo en pantalla con el error y retornará 0 para que 
no se puede enviar el formulario */
//--------------------------//
function fNColumnas(){

    let numeroColumnas = document.getElementById("ncolumnas").value;

    if(isNaN(numeroColumnas) || numeroColumnas > 20 || numeroColumnas == ""){

        document.getElementById("ecolumnas").setAttribute("class", "p-per-3")
        document.getElementById("ecolumnas").innerHTML = "Debe ser un numero entre 1 y 20."
        return 0;

    }else{

        document.getElementById("ecolumnas").innerHTML = ""
        return 1;

    }



}
//--------------------------//


/*Es funcion genera la planilla enviando los datos del formulario
vía ajax posteriormente la planilla generada es la que tendrá 
la opción de guardarla en la base de datos*/
//--------------------------//
function generarPlanilla(){

    let nombre = document.getElementById("nombre").value
    let ncolumnas = document.getElementById("ncolumnas").value
    let frecuencia = document.getElementById("frecuencia").value
    let observaciones = document.getElementById("observaciones").value


    if(fNombre() == 0 || fNColumnas() == 0 || aux_n == 0){

        document.getElementById("generar").setAttribute("href","#")
        swal("Verifica que los datos");

    }else{

        let planillaGenerada = document.getElementById("planilla");
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            planillaGenerada.innerHTML = this.responseText
            swal("¡PLANILLA GENERADA!", "Ya puedes agregar los nombres de los campos y el tipo de información con el que el usuario debe llenarlos.", "success")
            document.getElementById("generar").setAttribute("href","#planilla")
        }
      }
    }
        xhttp.open("GET", "controller/generar-planilla.php?nombre="+nombre +"&ncolumnas="+ncolumnas+"&frecuencia="+frecuencia+"&observaciones="+observaciones, true);
        xhttp.send();
       
}


/*Esta función valida el nombre de las columnas en la planilla generada */
function nombreColumna(a){

   let idParrafo = "p" + a
   let idNombre = "n" + a
   let nombre = document.getElementById(idNombre).value
   let parrafo = document.getElementById(idParrafo)

   minus = /[a-z]/;
   mayus = /[A-Z]/;

   nombre_v = nombre.split("");

   if((minus.test(nombre_v[0]) == 0 && mayus.test(nombre_v[0]) == 0) || nombre === "" || nombre.length >  30){
       
       parrafo.setAttribute("class", "p-per-3")
       parrafo.innerHTML = "Este campo no puede estar vacío, no puede iniciar con un número o caracter especial \n\
                                                       y tampoco de tener más de 30 caracteres.";
       return 0;

   }else{

        parrafo.setAttribute("class", "p-per-4")
        parrafo.innerHTML = "El nombre es correcto";
        return 1;
   }

   
    

}

/*Esta funcioón es la que guarda la planilla en la base de datos */
function guardarPlanilla(n){

    let nombreRegistro = document.getElementById("nombreRegistro").textContent
    let nombrePlanilla = document.getElementById("nombrePlanilla").textContent
    let fecha = document.getElementById("fecha").textContent
    let frecuencia = document.getElementById("frecuenciaValor").textContent
    let observaciones = document.getElementById("observaciones").value
    
    //el párametro n es el número columnas que se generó en la plantilla
    //se utilizará iterar sobre cada validación
 
    let aux; //Variable auxiliar para la iteración, almacerá el valor devuelto por la función nombreColumna()
    
    for(let i = 1; i <= n; i ++){

        aux = nombreColumna(i)

    }

    if (aux == 0){


        swal("Revisa que todas las columnas tengan un nombre correcto.")

    }else {


        var url = "controller/guardar-planilla.php?ncolumnas="+n+"&nombre_registro="+nombreRegistro+"&nombre_planilla="+nombrePlanilla+"&fecha="+fecha+"&frecuencia="+frecuencia+"&"

        if(observaciones != ""){

            url += "observaciones="+observaciones+"&"

        }

        for(let i = 1; i <= n; i ++){

            let idNombre = "n" + i
            let nombre = document.getElementById(idNombre).value

            let idTipo  = "t" + i
            let tipo = document.getElementById(idTipo).value
           
            url += idNombre + "=" + nombre + "&" + idTipo + "=" + tipo + "&"
        }

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            let prueba = parseInt(this.responseText)

            if(prueba == 1){

                swal("¡PLANILLA GUARDADA CORRECTAMENTE!", "La planilla se guardó correctamente.", "success")

            }else{

                swal("ERROR AL CREAR LA PLANILLA", "Ocurrió un error al crear la planilla, intentalo nuevamente.", "error")

            }
        }
      }
    }
        xhttp.open("GET", url , true);
        xhttp.send();
       

}

