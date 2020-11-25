window.onload = function (){

    let infoPlanilla = document.getElementById("infoPlanilla")
    let nombrePlanilla =  document.getElementById("nombrePlanilla").textContent
    let nombreRegistro = document.getElementById("nombreRegistro").textContent

    nombrePlanilla = nombrePlanilla.toLowerCase()
    nombreRegistro = nombreRegistro.toLowerCase()



    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            infoPlanilla.innerHTML = this.responseText;
                
        }
      }
    
    xhttp.open("GET", "controller/info-planilla.php?nombre_registro="+nombreRegistro+"&nombre_planilla="+nombrePlanilla, true);
    xhttp.send();


}

function eliminar(){

    let confirmar = confirm("¿Estás seguro de deseas eliminar la planilla?, toda la información se perderá y es una acción irreversible")

    if(confirmar == true){

        let nombrePlanilla = document.getElementById("nombrePlanilla").textContent
        let nombreRegistro = document.getElementById("nombreRegistro").textContent

        nombreRegistro = nombreRegistro.toLocaleLowerCase()


        nombrePlanilla = nombrePlanilla.toLowerCase()
        nombrePlanilla = nombrePlanilla.replace(" ", "%20")

        window.location.href = "controller/eliminar-planilla.php?nombre_planilla=" + nombrePlanilla + "&nombre_registro=" + nombreRegistro

    }

    
}