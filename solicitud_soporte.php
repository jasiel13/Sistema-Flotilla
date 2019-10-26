<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error()); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Solicitud de soporte</title>
    
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
<h3 align="center">Solicitud de Soporte
<i class="fa fa-life-ring fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Solicitud
    <img src="img/mensaje.png">
  </legend>
<form class="container" id="frmsolicitud" method="POST">
<div class="form-row">
<div class="form-group col-md-3">
      <label for="">Fecha de Solicitud</label>
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d H:i:s"); //formato fecha y hora
      ?>
     <input type="text" class="form-control" name="fecha" id="fecha" 
      value="<?php echo $fecha; ?>">
</div>     

 <div class="form-group col-md-3">
 <label for="">Usuario que solicita</label>
  <select  name="usuario" id="usuario" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM usuarios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['usuario'].'">'.$row['usuario'].'</option>';
          }
        ?>  
      </select>
      <p id="ms" style="display:none" class="error">Seleccione el usuario</p>
    </div>  

    <div class="form-group col-md-3">
      <label for="">Prioridad</label>
      <select class="form-control" name="prioridad" id="prioridad">
            <option value="">Seleccionar</option>
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>
      <p id="ms2" style="display:none" class="error">Seleccione una opción</p>
    </div> 

<div class="form-group col-md-3">
<label for="">Escribe aquí el problema</label>
<textarea name="problema" id="problema"></textarea>
 <p id="ms3" style="display:none" class="error">Describe el problema</p>
</div>    
</div>      

<hr>
<button type="button" id="btnenviar" class="btn btn-warning hvr-rotate">Enviar</button>
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i> Exportar a excel</button>
</form>
<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<!--CODIGO PARA MOSTRAR LA TABLA-->
<div class="container">
<div id="table"></div>
</div>

<script type="text/javascript">
    function validaForm7(){
    // Campos de texto
    if($("#usuario").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#usuario").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#prioridad").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#prioridad").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

     if($("#problema").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#problema").focus();
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
 $("#btnenviar").click( function() {
// Primero validará el formulario.
  if(validaForm7()){ 
  $.post("scripts/reg_solicitud.php",$("#frmsolicitud").serialize(),function()
   {});  
  $.post("enviar-correo.php",$("#frmsolicitud").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al enviar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Solicitud enviada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmsolicitud").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//CODIGO PARA LLAMAR LA TABLA DE TABLA.SOLICITUD.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_solicitud.php');
});

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Solicitudes de soporte",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>