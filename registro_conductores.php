<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de conductores</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>

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
<div class="bg-info clearfix">
<h3 align="center">Registro de Conductores
<i class="fa fa-drivers-license fa-2x"></i>
</h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Conductor
    <img src="img/conductor.png">
  </legend>

<form class="container" id="frmajax1" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre"            oninput="validar(this)">
    <p id="ms" style="display:none" class="error">El campo nombre no puede estar vacío</p>       
    </div>
    <div class="form-group col-md-4">
      <label for="">Apellido Paterno</label>
      <input type="text" class="form-control" name="ap_pat" id="ap_pat" placeholder="Apellido Paterno" oninput="validar(this)">
      <p id="ms1" style="display:none" class="error">El campo apellido paterno no puede estar vacío</p></div>
     <div class="form-group col-md-4">
      <label for="">Apellido Materno</label>
      <input type="text" class="form-control" name="ap_mat" id="ap_mat" placeholder="Apellido Materno" oninput="validar(this)">
      <p id="ms2" style="display:none" class="error">El campo apellido materno no puede estar vacío</p>
    </div> 
  </div>

<div class="form-row">
<div class="form-group col-md-4">
      <label for="">Licencia</label>
      <input type="text" class="form-control" name="licencia" id="licencia" placeholder="Licencia">
      <p id="ms3" style="display:none" class="error">El campo licenica no puede estar vacío</p>
</div>
    <div class="form-group col-md-4">
      <label for="">Fecha de vencimiento de licencia</label>
      <input type="date" class="form-control" name="fecha" id="fecha">
      <p id="ms4" style="display:none" class="error">El campo fecha no puede estar vacío</p>
</div> 
    <div class="form-group col-md-4">      
    <label for="">Asignar Vehículo</label>
    <!--codigo para llenar mi select desde la base de datos-->
 <select  name="vehiculo" id="vehiculo" class="form-control">
        <option value="">Seleccione...</option>
        <?php
// Realizamos la consulta para extraer los datos
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$row['vehiculo'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
      </select>
<!--codigo para llenar mi select desde la base de datos-->
    <p id="ms5" style="display:none" class="error">El campo vehiculo no puede estar vacío</p>
    </div>
  </div>
  <hr>
<button type="button" id="btnguardar1" class="btn btn-warning hvr-rotate">Enviar</button>
<button class="btn btn-primary hvr-rotate" type="button" onclick="muestradatos1()" data-toggle="modal" data-target=".bd-example-modal-xl">Ver tabla</button>
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
        <h5 class="modal-title">Tabla Registro de Conductores</h5>
        <!--boton para exportar a excel-->
        <button type="button" class="btn btn-outline-dark btn-sm mx-auto" id="excel">Exportar a excel</button> 

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Codigo para mostrar tabla de datos -->
      <div id="tabla_2" class="table-responsive-sm"></div>   
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

    if($("#ap_pat").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#ap_pat").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

   if($("#ap_mat").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#ap_mat").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

  if($("#licencia").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#licencia").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }
  if($("#fecha").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#fecha").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

  /*if($("#vehiculo").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }*/
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar1").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_conductores.php",$("#frmajax1").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                   Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al agregar',                  
                   });
                } else {
                    //alert("Conductor agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Condutcor agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmajax1").reset();//codigo para limpiar datos del form
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
//este codigo es para bloquear el uso de numeros en campos de solo letras 

//CODIGO PARA MANDAR LLAMAR LA TABLA DE CONDUCTORES
   function muestradatos1(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de conductores...</h5>"
    }
    else
    {
      Ajax2=new XMLHttpRequest();
           Ajax2.open("get","scripts/tabla_conductores.php?c="+cadena,true);
           Ajax2.onreadystatechange=function(){
           var ca=document.getElementById("tabla_2");
           ca.innerHTML=Ajax2.responseText;
            };
           Ajax2.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DE CONDUCTORES

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Registro de Conductores",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>