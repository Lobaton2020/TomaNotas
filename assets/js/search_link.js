
(function(){

    window.onload = function(){

      cargarDatos(true);
      mensajeCargando(false);
    }

   //el objeto de ajax
   function getXMLHttpRequest (){
      var ajax = null; 
       try{
          ajax = new XMLHttpRequest();
        }catch(error1){
            try{
              ajax = new ActiveXObject("Microsoft.XMLHTTP"); 
            }catch(error2){
              console.log("Imposible conectase con AJAX");
              ajax = false;
            }
        }
        return ajax;
    }

    var txt = document.getElementById("search");
    var response_main =  document.getElementById("response-ajax-main");
    var response_keyup =  document.getElementById("response-ajax-keyup");
      // carga los datos por defecto del servidor
  function cargarDatos(valor){
    if(valor == true){

      var ajax = getXMLHttpRequest();
      ajax.open("GET","index.php?c=auth&m=main&ver=true",true);
      ajax.onreadystatechange = function(){
        
          if(ajax.readyState == 4 && ajax.status == 200){
              if(ajax.responseText != ""){

                  response_main.innerHTML = ajax.responseText;
              }else{

                   response_main.innerHTML = "No se han podido cargar los datos";
                }
           }
    
       }
       ajax.send();
   
      }
      mostrarMensaje(false);
    }
 //---------------------------------------------------------------------------------------------------------------------------------
  // muestra el mensaje que no hay links
    function mostrarMensaje(valor){
      var msg =  document.getElementById("mensaje-ajax");
    if(valor == true){
        msg.style.display = "block";
    }else{
        msg.style.display = "none";
    } 
  }
// mensaje de cargando
function mensajeCargando(value){
  var mensaje = document.getElementById("mensajeCargando");
if(value){
    mensaje.style.display = "block";
}else{
  mensaje.style.display = "none";
}
}

  // proceso de ajax para la consulta del formulario



    txt.addEventListener("keyup",function(){
      mensajeCargando(true);
      var ajax = getXMLHttpRequest();
        var valor = txt.value;
        ajax.open("GET","index.php?c=auth&m=ajax&value="+valor,true);
        ajax.onreadystatechange = function(){

            if(ajax.readyState == 4 && ajax.status == 200){
              cargarDatos(false);
              mensajeCargando(false);              
                if(ajax.responseText != ""){
                  mostrarMensaje(false);
                    response_keyup.innerHTML = ajax.responseText;
                    response_main.innerHTML = "";
                }else{
                    mostrarMensaje(true);
                     response_keyup.innerHTML = "";
                  }
            }
        }
        // ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        ajax.send();
    });



})();
