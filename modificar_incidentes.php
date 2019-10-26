<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Modificar de Incidencias</title>
    
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
<h3 align="center">Modificar Incidencia
<i class="fa fa fa-exclamation-circle fa-2x"></i></h3>
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información de la Incidencia
      <img src="img/servicio.png">
  </legend>

 <form class="container" id="frmincidente" method="POST">
  <div class="form-row">

    <div class="form-group col-md-3">
    <label for="">Número de Incidencia</label>
    <select  name="id_incidente" id="id_incidente" class="form-control" onchange="mifuncion(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM incidentes";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
    echo '<option value="'.$row['id_incidente'].'">'.$row['id_incidente'].'/'.$row['vehiculo'].'</option>';
          }
        ?>
    </select>
    <p id="ms" style="display:none" class="error">Seleccione una opción</p>      
    </div>


     <div class="form-group col-md-3">
    <label for="">Conductor</label>
    <select  name="conductor" id="conductor" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';

          }
        ?>
    </select>
    <p id="ms1" style="display:none" class="error">Seleccione una opción</p>      
    </div>

  <div class="form-group col-md-3">
    <label for="">Servicio</label>
    <select  name="servicio" id="servicio" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM tipos_servicios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['tipo_servicio'].'">'.$row['tipo_servicio'].'</option>';

          }
        ?>
    </select>
    <p id="ms2" style="display:none" class="error">Seleccione una opción</p>      
    </div>

    <div class="form-group col-md-3">
    <label for="">Vehículo</label>
    <select  name="vehiculo" id="vehiculo" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['vehiculo'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
    </select>
    <p id="ms3" style="display:none" class="error">Seleccione una opción</p>      
    </div>
  </div>
 
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="">Medición al momento</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="odometro" id="odometro" placeholder="Kilometraje">
   </div>
  <p id="ms4" style="display:none" class="error">El campo kilometraje inicial no puede estar vacío</p>
  </div>

<div class="form-group col-md-4"> 
  <label for="">Incidencia(descripción corta)</label>
  <input type="text" class="form-control" name="incidente" id="incidente" placeholder="Ej: Fallo de luz en el faro">
<p id="ms5" style="display:none" class="error">El campo incidente no puede estar vacío</p>    
</div>

<div class="form-group col-md-4">
<label for="">Describe la incidencia</label>
<textarea name="descripcion" id="descripcion"></textarea>
<p id="ms6" style="display:none" class="error">El campo descripción no puede estar vacío</p> 
</div>
</div>

<hr>
<div class="form-row">
<div class="form-group col-md-2">
</div>  
<div class="form-group col-md-4">      
<button type="button" id="btnmodificar" class="btn btn-warning hvr-sink"><i class="fa fa-edit" style="color:black;"></i>  Modificar</button>
<button type="button" onclick="location.href='incidentes.php'" class="btn btn-info hvr-sink">
 Reporte de Incidentes    
</button>
</div>
<div class="form-group col-md-4">  
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>  Exportar a excel</button>  
</div>
 <div class="form-group col-md-2">
</div>    
</div>
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

  function validaForm(){

   if($("#id_incidente").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#id_incidente").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#conductor").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms1").delay(100).fadeIn("slow");
        $("#conductor").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

    if($("#servicio").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#servicio").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

   if($("#vehiculo").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    } 
 
     if($("#odometro").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#odometro").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

     if($("#incidente").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#incidente").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }

     if($("#descripcion").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#descripcion_incidente").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }   
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/actualizar_incidente.php",$("#frmincidente").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                   Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al modificar',                  
                   });
                } else {
                    //alert("Conductor agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Incidente modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmincidente").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function mifuncion(valor){
    $.ajax({ 
      url : 'scripts/carga_valoresincidente.php',
      data : { valor : valor },
      type : 'POST',
      dataType : 'json',
      success : function(json) {       
            $("#conductor").val(json.conductor);
             $("#servicio").val(json.servicio);
              $("#vehiculo").val(json.vehiculo);
               $("#odometro").val(json.odometro);                   
                $("#incidente").val(json.incidente);
                 $("#descripcion").val(json.descripcion);                                        
      },     
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

//CODIGO PARA LLAMAR LA TABLA DE TABLA.MANTENIMIENTO.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_incidentes.php');
});  

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Incidentes",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>

