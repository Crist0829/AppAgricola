window.onload = function (){

    let registros = document.getElementById("registros");

    var xhttp = new XMLHttpRequest();
    
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
    
            
            registros.innerHTML = this.responseText;    
                
        }
      }
    xhttp.open("GET", "controller/cargar-registros-comun.php", true);
    xhttp.send();


}