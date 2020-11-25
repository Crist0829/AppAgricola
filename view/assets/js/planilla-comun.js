window.onload = function (){

    let llenarPlanilla = document.getElementById("llenarPlanilla")
    let infoPlanilla = document.getElementById("infoPlanilla")
    let nombreEditor = document.getElementById("nombreEditor").textContent
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


    var xhttp2 = new XMLHttpRequest();

    xhttp2.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            llenarPlanilla.innerHTML = this.responseText;
                
        }
      }
    
    xhttp2.open("GET", "controller/llenar-planilla.php?nombre_registro="+nombreRegistro+"&nombre_planilla="+nombrePlanilla+"&nombre_editor="+nombreEditor, true);
    xhttp2.send();


}