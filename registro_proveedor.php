<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de Proveedor</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>

    <!--boostrap librerias-->
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap_4.3.1/js/popper.min.js"></script>

    <!--librerias para crear animaciones-->
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <script type="text/javascript" src="wowjs/wow.min.js"></script>
    <script type="text/javascript">new WOW().init();</script> 

    <!--librerias para crear efecto hover-->
    <link rel="stylesheet" type="text/css" href="Hover/css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/error.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
  </head>

<body>
<!--codigo para la cabecera debajo del menu-->  
<div class="bg-info clearfix">
<h3 align="center">Registro de Proveedores
<i class="fa fa-building fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Proveedor
    <img src="img/proveedor.png">
  </legend>

<form class="container" id="frmprov" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="">Proveedor</label>
    <input type="text" class="form-control" name="proveedor" id="proveedor" placeholder="Proveedor"      oninput="validar(this)">
      <p id="ms" style="display:none" class="error">El campo proveedor no puede estar vacío</p>
    </div>

    <div class="form-group col-md-4">
      <label for="">Tipo de Producto</label>
      <select name="tipo" id="tipo" class="form-control">
        <option value="">Seleccione...</option>
        <option value="mecanico">Mecanico</option>
        <option value="llantas">Llantas</option>
        <option value="frenos">Frenos</option>
        <option value="electrico">Eléctrico</option>
        <option value="agencia automotriz">Agencia Automotriz</option> 
        <option value="carroceria">Carrocerias</option>
        <option value="sterling">Sterling</option>
        <option value="baleros">Baleros</option>
        <option value="muelles">Muelles</option>      
        <option value="refaccionaria">Refaccionaria</option>
        <option value="despachadora">Despachadora</option>
        <option value="remolque">Remolque</option>      
        <option value="cristales">Cristales</option>      
        <option value="direccion hidraulica">Dirección Hidráulica</option>      
        <option value="autopartes electricas">Autopartes Eléctricas</option>
        <option value="transmision automatica">Transmisión Automática</option> 
        <option value="laboratorio disel">Laboratorio Disel</option> 
        <option value="radiador">Radiador</option> 
        <option value="acumuladores">Acumuladores</option> 
        <option value="suspencion">Suspención</option>  
        <option value="climas">Climas</option>  
        <option value="mofles">Mofles</option>        
      </select>
      <p id="ms1" style="display:none" class="error">Seleccione una opción</p>
    </div>
    <div class="form-group col-md-4">
    <label for="">Ciudad</label>
     <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" oninput="validar(this)">
     <p id="ms2" style="display:none" class="error">El campo ciudad no puede estar vacío</p>
  </div>
</div>
       
<div class="form-row">
    <div class="form-group col-md-3">
      <label for="">Contacto</label>
      <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Nombre" oninput="validar(this)">
      <p id="ms3" style="display:none" class="error">El campo contacto no puede estar vacío</p>
    </div> 
     <div class="form-group col-md-3">
    <label for="">Teléfono</label>
    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">  
  </div>
<div class="form-group col-md-3">
    <label for="">Celular</label>
    <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular">    
  </div> 
  <div class="form-group col-md-3">
    <label for="">Correo</label>
    <input type="email" class="form-control" name="correo" id="correo" placeholder="E-mail">    
  </div>    
  </div>
<hr>
<button type="button" id="btnguardar" class="btn btn-warning hvr-sink">Enviar</button>
<button class="btn btn-primary hvr-sink" type="button" onclick="muestradatos6()" data-toggle="modal" data-target=".bd-example-modal-xl">Ver tabla</button>
</form>


<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->


<!--modal-->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tabla Registro de Proveedores</h5>
        <!--boton para exportar a excel-->
        <button type="button" class="btn btn-outline-dark btn-sm mx-auto" id="excel">Exportar a excel</button> 

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Codigo para mostrar tabla de datos -->
      <div id="tabla_1" class="table-responsive-sm"></div>       
    </div>
  </div>
</div>
<!--modal-->


<script type="text/javascript">

  function validaForm4(){
    // Campos de texto
    if($("#proveedor").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#proveedor").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#tipo").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#tipo").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

     if($("#ciudad").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#ciudad").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

  if($("#contacto").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#contacto").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm4()){ 
  $.post("scripts/reg_proveedor.php",$("#frmprov").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al agregar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Proveedor agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmprov").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero(numero) {
  return document.getElementById(numero);
}
numero('telefono').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});
//este codigo es para bloquear el uso de letras en campos de solo numeros positivos

//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero1(numero1) {
  return document.getElementById(numero1);
}
numero('celular').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});
//este codigo es para bloquear el uso de letras en campos de solo numeros positivos

//este codigo es para bloquear el uso de numeros en campos de solo letras y que tampoco se puedan copiar y pegar
const validar = function(campo) {
  let valor = campo.value;  
  // Verifica si el valor del campo (input) contiene numeros.
  if(/\d/.test(valor)) { 
  //Remueve los numeros que contiene el valor y lo establece en el valor del campo (input).
  campo.value = valor.replace(/\d/g,'');
  }
  
};    
//este codigo es para bloquear el uso de numeros en campos de solo letras 


//CODIGO PARA MANDAR LLAMAR LA TABLA DE PROVEEDORES
   function muestradatos6(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos del Proveedor...</h5>"
    }
    else
    {
      Ajax6=new XMLHttpRequest();
           Ajax6.open("get","scripts/tabla_proveedor.php?c="+cadena,true);
           Ajax6.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax6.responseText;
            };
           Ajax6.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DE PROVEEDORES

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Registro de Proveedores",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>