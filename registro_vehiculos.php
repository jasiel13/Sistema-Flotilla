<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de vehículo</title>
    
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
<h3 align="center">Registro de Vehículos
<i class="fa fa-truck fa-2x"></i></h3> 
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Vehículo
    <img src="img/camion.png">
  </legend>

 <form class="container" id="frmajax" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ej: Ford lobo azul"><!--oninput="validar(this)"-->
      <p id="ms" style="display:none" class="error">El campo nombre no puede estar vacío</p>
    </div>
    <div class="form-group col-md-4">
      <label for="">Marca</label>
      <input type="text" class="form-control" name="marca" id="marca" placeholder="Ej: Jetta,Ford,Chevrolet">
      <p id="ms1" style="display:none" class="error">El campo marca no puede estar vacío</p>
    </div>
     <div class="form-group col-md-4">
      <label for="">Status</label>
      <select name="status" id="status" class="form-control">
        <option value="">Seleccione...</option>
        <option value="disponible">Disponible</option>
        <option value="taller">En taller</option>
        <option value="fuera de servicio">Fuera de servicio</option>
        <option value="ocupado">Ocupado/En uso</option>           
      </select>
      <p id="ms2" style="display:none" class="error">El campo status no puede estar vacío</p>
     </div>      
  </div>

<div class="form-row">
<div class="form-group col-md-4">
      <label for="">Modelo</label>
      <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Ej: Civic,VW,Honda">
      <p id="ms3" style="display:none" class="error">El campo modelo no puede estar vacío</p>
    </div>
    <div class="form-group col-md-4">
      <label for="">Año</label>
      <input type="text" class="form-control" name="ano" id="ano" placeholder="1990">
      <p id="ms4" style="display:none" class="error">El campo año no puede estar vacío</p>
    </div>
   <div class="form-group col-md-4">
    <label for="">Placa</label>
    <input type="text" class="form-control" name="placa" id="placa" placeholder="1234">
    <p id="ms5" style="display:none" class="error">El campo placa no puede estar vacío</p>
  </div>
  </div>

<div class="form-row"> 
 <div class="form-group col-md-4">
      <label for="">Tipo de vehículo</label>
      <select name="tipo" id="tipo" class="form-control">
        <option value="">Seleccione...</option>
        <option value="Auto">Automóvil</option>
        <option value="pickup">Pick up</option>
        <option value="tractor 5R">Tractor 5 rueda</option>
        <option value="camión torton">Camión torton</option>
        <option value="camión 3 ton">Camión 3 toneladas</option>       
      </select>
      <p id="ms6" style="display:none" class="error">Seleccione una opción</p>
    </div>

<div class="form-group col-md-4"> 
  <label for="">Fecha Renovación de Placas</label>
  <input type="date" class="form-control" name="fecha" id="fecha">
   <p id="ms7" style="display:none" class="error">Seleccione la fecha</p>
</div>
<div class="form-group col-md-4">
      <label for="">Departamento</label>
      <select name="departamento" id="departamento" class="form-control">
        <option value="">Seleccione...</option>
        <option value="ventas">Ventas</option>
        <option value="compras">Compras</option>
        <option value="contabilidad">Contabilidad</option>
        <option value="almacen">Almacen</option>
        <option value="sea">Usuarios de SEA</option>
        <option value="cta">Usuarios de CTA</option>
      </select>
      <p id="ms8" style="display:none" class="error">Seleccione una opción</p>
    </div>
</div>

<div class="form-row">  
  <div class="form-group col-md-3">
      <label for="">Empresa</label>
      <select name="empresa" id="empresa" class="form-control">
        <option value="">Seleccione...</option>
        <option value="csn">CSN</option>
        <option value="sea">SEA</option>
        <option value="cta">CTA</option>      
      </select>
      <p id="ms9" style="display:none" class="error">Seleccione una opción</p>
    </div>
    <div class="form-group col-md-3">
      <label for="">Medida de uso</label>
      <select name="medida_uso" id="medida_uso" class="form-control">
        <option value="">Seleccione...</option>
        <option value="kilometros">Kilómetros</option>
        <option value="horas">Horas</option>              
      </select>
      <p id="ms10" style="display:none" class="error">El campo medida no puede estar vacío</p>
    </div>

  <div class="form-group col-md-3">
      <label for="">Rendimiento(esperado)</label>
      <input type="text" class="form-control" name="rendimiento" id="rendimiento" placeholder="Rendimiento Esperado">
      <p id="ms11" style="display:none" class="error">El campo rendimiento no puede estar vacío</p>
    </div>  
    <div class="form-group col-md-3">
      <label for="">Número de serie</label>
      <input type="text" class="form-control" name="serie" id="serie" placeholder="Serie">
      <p id="ms12" style="display:none" class="error">El campo serie no puede estar vacío</p>     
    </div> 
</div>
<hr>
<div class="form-row">
<div class="form-group col-md-12">      
<button type="button" id="btnguardar" class="btn btn-warning hvr-sink">Enviar</button>
<!--Codigo para mostrar tabla de datos -->
<button class="btn btn-primary hvr-sink" type="button" onclick="muestradatos()" data-toggle="modal" data-target=".bd-example-modal-xl">Ver tabla</button>  
    </div>   
  </div>
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
        <h5 class="modal-title">Tabla Registro de Vehículos</h5>
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
  function validaForm(){
    // Campos de texto
    if($("#nombre").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#nombre").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#marca").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#marca").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

     if($("#status").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#status").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

  if($("#modelo").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#modelo").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }
  if($("#ano").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#ano").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

  if($("#placa").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#placa").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }

  if($("#tipo").val() == ""){       
        $("#ms6").delay(100).fadeIn("slow");
        $("#tipo").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }

  if($("#fecha").val() == ""){       
        $("#ms7").delay(100).fadeIn("slow");
        $("#fecha").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }

  if($("#departamento").val() == ""){
        $("#ms8").delay(100).fadeIn("slow");
        $("#departamento").focus();
        return false;
    } 
    else
    {
      $("#ms8").fadeOut();      
    }

  if($("#empresa").val() == ""){        
        $("#ms9").delay(100).fadeIn("slow");
        $("#empresa").focus();
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }

if($("#medida_uso").val() == ""){        
        $("#ms10").delay(100).fadeIn("slow");
        $("#medida_uso").focus();
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }

if($("#rendimiento").val() == ""){        
        $("#ms11").delay(100).fadeIn("slow");
        $("#rendimiento").focus();
        return false;
    }
    else
    {
      $("#ms11").fadeOut();      
    }

if($("#serie").val() == ""){
        $("#ms12").delay(100).fadeIn("slow");
        $("#serie").focus();
        return false;
    }
    else
    {
      $("#ms12").fadeOut();      
    }
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_vehiculo.php",$("#frmajax").serialize(),function(res){
 
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
                     title: 'Vehículo agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmajax").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});


//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero(numero) {
  return document.getElementById(numero);
}
numero('ano').addEventListener('input',function() {
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

//CODIGO PARA MANDAR LLAMAR LA TABLA DE VEHICULOS
   function muestradatos(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de vehiculos...</h5>"
    }
    else
    {
      Ajax1=new XMLHttpRequest();
           Ajax1.open("get","scripts/tabla_vehiculo.php?c="+cadena,true);
           Ajax1.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax1.responseText;
            };
           Ajax1.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DE VEHICULOS

$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Registro de Vehículos",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>

