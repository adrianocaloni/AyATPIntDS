function accion(){

    var tipo= document.querySelector('#tipo').value; 
    var nombreLibro= document.querySelector('#numeroLibro').value; 
    var cant= document.querySelector('#cantidad').value;
    var cadena = "tipo="+tipo+"&nombreLibro="+nombreLibro+"&cantidad="+cant;


    var solicitud = new XMLHttpRequest();

    solicitud.onreadystatechange= function(){
        if (this.readyState == 4 && this.status == 200){
            var respuesta = JSON.parse(this.responseText);
            var identificador = "#generoNuevo-" + respuesta.numero_Libro;
            var celda = document.querySelector(identificador);

            if (respuesta.resultado == "OK"){

                celda.innerHTML = respuesta.genero;

            } else {
                console.log(respuesta.resultado);
            }
          
        }
    };
    solicitud.open("POST", "accion.php",true);
    solicitud.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    solicitud.send(cadena);
 
}



function prestar(nroLibro){
    document.querySelector('#tipo').value= "p";
    document.querySelector('#tipo_accion').innerHTML= "Prestar";
    document.querySelector('#numeroLibro').value =nroLibro;
    document.querySelector('#nombreGenero').focus(); 

}

function reponer(nroLibro){
    document.querySelector('#tipo').value= "r";
    document.querySelector('#tipo_accion').innerHTML= "Reponer";
    document.querySelector('#numeroLibro').value =nroLibro;
    document.querySelector('#nombreGenero').focus(); 
}

