window.onload = ()=>{

    let historialPlanilla = document.getElementById("estructuraPlanilla")

    let nombrePlanilla =  document.getElementById("nombrePlanilla").textContent
    let nombreRegistro = document.getElementById("nombreRegistro").textContent

    nombrePlanilla = nombrePlanilla.toLowerCase()
    nombreRegistro = nombreRegistro.toLowerCase()


    var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            historialPlanilla.innerHTML = this.responseText;
                
        }
      }
    
    xhttp.open("GET", "controller/descargar-historial.php?nombre_registro="+nombreRegistro+"&nombre_planilla="+nombrePlanilla, true);
    xhttp.send();


}