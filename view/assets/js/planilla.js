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