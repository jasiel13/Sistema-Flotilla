<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de Incidencias</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/tableToExcel.js"></script>

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
<h3 align="center">Reportar Incidencia
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
      <label for="">Fecha del reporte (incidencia)</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div> 
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d");
      ?>
     <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" 
      value="<?php echo $fecha; ?>">
    </div>
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
    <p id="ms" style="display:none" class="error">Seleccione una opción</p>      
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
    <p id="ms1" style="display:none" class="error">Seleccione una opción</p>      
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
    <p id="ms2" style="display:none" class="error">Seleccione una opción</p>      
    </div>
  </div>
 
<div class="form-row">
  <div class="form-group col-md-4">
      <label for="">Prioridad</label>
      <select class="form-control" name="prioridad1" id="prioridad1" onchange="Opciones();">
            <option value="">Seleccionar</option>
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>
      <p id="ms3" style="display:none" class="error">Seleccione una opción</p>
  </div> 

 <input type="hidden" class="form-control" name="prioridad" id="prioridad">

  <div class="form-group col-md-4"> 
  <label for="">Fecha de vencimiento para revisar el reporte</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text btn btn-outline-success" id="enviardato" type="button" disabled><i class="fa fa-check" style="color: #20c997;"></i><i class="fa fa-calendar" style="color: #20c997;"></i></button>
  </div>
  <input type="text" class="form-control" name="fecha_final" id="fecha_final" disabled><div id="resp"></div>
  </div>
  <p id="ms4" style="display:none" class="error">El campo fecha final no puede estar vacío</p>  
  </div>

  <div class="form-group col-md-4">
    <label for="">Medición al momento</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="odometro" id="odometro" placeholder="Kilometraje">
   </div>
  <p id="ms5" style="display:none" class="error">El campo kilometraje inicial no puede estar vacío</p>
  </div>
</div>

<div class="form-row">
<div class="form-group col-md-3"> 
</div>
<div class="form-group col-md-3"> 
  <label for="">Incidencia(descripción corta)</label>
  <input type="text" class="form-control" name="incidente" id="incidente" placeholder="Ej: Fallo de luz en el faro">
<p id="ms6" style="display:none" class="error">El campo incidente no puede estar vacío</p>    
</div>

<div class="form-group col-md-3">
<label for="">Describe la incidencia</label>
<textarea name="descripcion" id="descripcion"></textarea>
<p id="ms7" style="display:none" class="error">El campo descripción no puede estar vacío</p> 
</div> 
<div class="form-group col-md-3"> 
</div>
</div>

<hr>
<div class="form-row">
<div class="form-group col-md-12">      
<button type="button" id="btnguardar" class="btn btn-warning hvr-sink">Enviar</button>
<button type="button" onclick="location.href='modificar_incidentes.php'" class="btn btn-info hvr-rotate">
 Modificar Incidentes
</button>
<button type="button" onclick="location.href='reporte_incidenciaspdf.php'" class="btn btn-primary hvr-float">
 Imprimir Reporte
</button>
</div>   
  </div>
</form>   

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

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

  $(document).ready(function(){
    $("#enviardato").click(function(){
        var prioridad = $("#prioridad").val();
        //tiempo = document.getElementById("tiempo").value

        $.ajax({
            type: "POST",
            url: "scripts/sumar_fechainicente.php",
            data: {prioridad:prioridad},
            success: function(data){              
                $('#fecha_final').val(data);
            }
        });
    });
});

  function validaForm(){
    // Campos de texto
    if($("#conductor").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#conductor").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

    if($("#servicio").val() == ""){        
        $("#ms1").delay(100).fadeIn("slow");
        $("#servicio").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

   if($("#vehiculo").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }
 
  if($("#prioridad1").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#prioridad1").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

  if($("#fecha_final").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#fecha_final").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

     if($("#odometro").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#odometro").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }

     if($("#incidente").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#incidente").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }

     if($("#descripcion").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#descripcion_incidente").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }   
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_incidencia.php",$("#frmincidente").serialize(),function(res){
 
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
                     title: 'Incidente agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmincidente").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});


//darle valores a los item del select ej: alta=1 y luego enviar esos valores aun input
var opciones = {
  "seleccione": [""],
  "alta": ["1"],
  "media":["2"],
  "baja": ["3"], 
}
function Opciones()
{
  var combo = document.getElementById('prioridad1');
  var opcion = combo.value;  
  document.getElementById('prioridad').value = opciones[opcion][0];

}
//darle valores a los item del select ej: alta=1 y luego enviar esos valores aun input


//habilitar el boton por medio del select
$( function() {
    $("#prioridad1").change( function() {
        if ($(this).val() === "0") {
            $("#enviardato").prop("disabled", true);
        } else {
            $("#enviardato").prop("disabled", false);
        }
    });
});
//habilitar el input pór medio del boton
$( function() {
  $("#enviardato").on("click", function(){
        if ($(this).val() === "0") {
            $("#fecha_final").prop("disabled", true);
        } else {
            $("#fecha_final").prop("disabled", false);
        }
    });
});
</script>
</body>
</html>

