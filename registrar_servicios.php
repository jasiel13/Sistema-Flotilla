<?php include 'menu.php'; 
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de Servicios</title>
    
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
<h3 align="center">Registro de Servicios Mtto.
<i class="fa fa-wrench fa-2x"></i></h3> 
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-black">

<form class="container" id="modservicios" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="">Tipo de Servicio</label>
 <select  name="servicio1" id="servicio1" class="form-control" onchange="mifuncion(this.value)">
        <option value="">Seleccione...</option>
        <?php
// Realizamos la consulta para extraer los datos
            $query="SELECT  * FROM tipos_servicios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$row['id_servicio'].'">'.$row['tipo_servicio'].'</option>';
          }
        ?>
      </select>
    <p id="ms5" style="display:none" class="fallo">El campo servicio no puede estar vacío</p>
    </div>

 <div class="form-group col-md-6">
      <label for="">Prioridad</label>
      <select name="prioridad1" id="prioridad1" class="form-control">
        <option value="">Seleccione...</option>
        <option value="alta">Alta</option>
        <option value="media">Media</option>
        <option value="baja">Baja</option>             
      </select>
      <p id="ms6" style="display:none" class="fallo">Seleccione una opción</p>
  </div>

    <div class="form-group col-md-6">
    <label for="">Frecuencia de servicio(mtto)</label>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
     <input type="text" class="form-control numerico" name="kilometraje1" id="kilometraje1" placeholder="Kilómetraje">
   </div>
     <p id="ms7" style="display:none" class="fallo">El campo frecuencia no puede estar vacío</p>
  </div>

 <div class="form-group col-md-6">
      <label for="">Rango de tiempo</label>
      <select name="tiempo1" id="tiempo1" class="form-control">
        <option value="">Seleccione...</option>
        <option value="1">1 día</option>
        <option value="7">1 semana</option>
        <option value="15">15 días</option>
      </select>
      <p id="ms8" style="display:none" class="fallo">El campo rango no puede estar vacío</p>
    </div>
  </div>
</form>

      </div>
      <div class="modal-footer bg-info"> 
      <button type="button" id="btnmodificar" class="btn btn-dark">Enivar</button>           
    </div>
  </div>
</div>
</div>
<!-- Modal -->

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Servicio
    <img src="img/servicio.png">
  </legend>

<form class="container" id="frmservicios" method="POST">
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="">Tipo de Servicio</label>
    <input type="text" class="form-control" name="servicio" id="servicio" placeholder="Servicio de mantenimiento" oninput="validar(this)">
      <p id="ms" style="display:none" class="error">El campo servicio no puede estar vacío</p>
    </div>

    <div class="form-group col-md-3">
      <label for="">Prioridad</label>
      <select name="prioridad" id="prioridad" class="form-control">
        <option value="">Seleccione...</option>
        <option value="alta">Alta</option>
        <option value="media">Media</option>
        <option value="baja">Baja</option>             
      </select>
      <p id="ms1" style="display:none" class="error">Seleccione una opción</p>
    </div>

    <div class="form-group col-md-3">
    <label for="">Frecuencia de servicio(mtto)</label>
    <!--<div class="input-group mb-3">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
     <input type="text" class="form-control numerico" name="kilometraje" id="kilometraje" placeholder="Revisión basada en Km">
   </div>-->
   <select name="kilometraje" id="kilometraje" class="form-control">
        <option value="">Seleccione...</option>
        <option value="10000">Cada 10000 km</option>
        <option value="5000">Cada 5000 km</option>        
      </select>
     <p id="ms2" style="display:none" class="error">El campo frecuencia no puede estar vacío</p>
  </div>

  <div class="form-group col-md-3">
      <label for="">Rango de tiempo</label>
      <select name="tiempo" id="tiempo" class="form-control">
        <option value="">Seleccione...</option>
        <option value="1">1 día</option>
        <option value="7">1 semana</option>
        <option value="15">15 días</option>
      </select>
      <p id="ms3" style="display:none" class="error">El campo rango no puede estar vacío</p>
    </div> 
</div>  
<hr>
<div class="form-row">
<div class="form-group col-md-3"></div>  
<div class="form-group col-md-3">
<button type="button" id="btnguardar" class="btn btn-warning hvr-sink">Enviar</button>
<button type="button" class="btn btn-warning hvr-sink" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
Modificar
</button>
</div>
<div class="form-group col-md-4">
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>  Exportar a excel</button>
</div> 
</form>
<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->
<br>
  <!--CODIGO PARA MOSTRAR LA TABLA-->
<div class="container">
<div id="table"></div>
</div>

<script type="text/javascript">
  function validaForm21(){
    // Campos de texto
    if($("#servicio").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#servicio").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#prioridad").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#prioridad").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

     if($("#kilometraje").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#kilometraje").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

  if($("#tiempo").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#tiempo").focus();
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
  if(validaForm21()){ 
  $.post("scripts/reg_servicios.php",$("#frmservicios").serialize(),function(res){
 
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
                     title: 'Servicio agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmservicios").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});


//este codigo es para bloquear el uso de numeros en campos de solo letras y que tampoco se puedan copiar y pegar
const validar = function(campo) {
  let valor = campo.value;  
  // Verifica si el valor del campo (input) contiene numeros.
  if(/\d/.test(valor)) { 
  //Remueve los numeros que contiene el valor y lo establece en el valor del campo (input).
  campo.value = valor.replace(/\d/g,'');
  }
  
};    

//VALIDAR QUE SEAN SOLO NUMEROS ENTEROS Y DECIMALES DENEGAR LETRAS
const inputs = document.querySelectorAll('.numerico');

Array.from(inputs).forEach(function(input) {
  input.addEventListener('keypress', function(e) {
    // keyCode del punto decimal, también se puede cambiar por la coma que sería el 44
    const decimalCode = 46;
    // chequeo que el keyCode corresponda a las teclas de los números y al punto decimal
    if ((e.keyCode < 48 || e.keyCode > 57) && e.keyCode != decimalCode) {
      e.preventDefault();
    }
    // chequeo que sólo exista un punto decimal
    else if (e.keyCode == decimalCode && /\./.test(this.value)) {
      event.preventDefault();
    }
  }, true)
});

//modificar servicios/////////////////////////////////////////////////////////////////
function mifuncion(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valoresservi.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos      
        $("#prioridad1").val(json.prioridad1);
        $("#kilometraje1").val(json.kilometraje1);
        $("#tiempo1").val(json.tiempo1);       
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }


  function validaForm22(){
    // Campos de texto
    if($("#servicio1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms5").delay(100).fadeIn("slow");
        $("#servicio1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }

    if($("#prioridad1").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#prioridad").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }

     if($("#kilometraje1").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#kilometraje1").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }

  if($("#tiempo1").val() == ""){        
        $("#ms8").delay(100).fadeIn("slow");
        $("#tiempo1").focus();
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar").click( function() {
// Primero validará el formulario.
  if(validaForm22()){ 
  $.post("scripts/actualizar_servicios.php",$("#modservicios").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al modificar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Servicio modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("modservicios").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//CODIGO PARA LLAMAR LA TABLA DE TABLA.SOLICITUD.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_servicios.php');
});

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Tipo de servicio de mantenimiento",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>