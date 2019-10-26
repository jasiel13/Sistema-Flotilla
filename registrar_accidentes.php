<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de Aditivos</title>
    
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
<h3 align="center">Registro de Accidentes
<i class="fa fa-car fa-2x"></i>
</h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Registro de Accidentes
    <img src="img/accidente.png">
  </legend>

<form class="container" id="frmaccidente" method="POST">
   <div class="form-row">

    <div class="form-group col-md-3">
    <label for="">Accidente</label>
    <input type="text" class="form-control" name="accidente" id="accidente" placeholder="Ej: Choque del Polo">
    <p id="ms" style="display:none" class="error">El campo accidente no puede estar vacío</p>  
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
    <p id="ms1" style="display:none" class="error">El campo vehículo no puede estar vacío</p>   
    </div>   
 
   <div class="form-group col-md-3">
      <label for="">Fecha del Accidente</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
    </div>
    <input type="date" class="form-control" name="fecha_accidente" id="fecha_accidente">
    </div>
<p id="ms2" style="display:none" class="error">El campo fecha accidente no puede estar vacío</p>      </div>

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
  <p id="ms3" style="display:none" class="error">El campo conductor no puede estar vacío</p>   
    </div> 
   </div>

  <div class="form-row">
   <div class="form-group col-md-3">
      <label for="">Pago Deducible</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="pago_deducible" id="pago_deducible">
    </div>
<p id="ms4" style="display:none" class="error">El campo pago deducible no puede estar vacío</p>      </div>

 <div class="form-group col-md-3">
      <label for="">Pago Adicional</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="pago_adicional" id="pago_adicional">
    </div>
<p id="ms5" style="display:none" class="error">El campo pago adicional no puede estar vacío</p>      </div>

     <div class="form-group col-md-3">
      <label for="">Pago Total</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="pago_total" id="pago_total">
    </div>
  <p id="ms6" style="display:none" class="error">El campo pago total no puede estar vacío</p> 
     </div>

   
<div class="form-group col-md-3">
<label for="">Detalles del Accidente</label>
<textarea name="detalles" id="detalles"></textarea>
<p id="ms7" style="display:none" class="error">Describe el problema</p>
</div>  
  </div>

<div class="form-row">
<div class="form-group col-md-2">
</div> 
<div class="form-group col-md-4">
<button type="button" id="btnguardar1" class="btn btn-info hvr-rotate">Enviar</button>
<button type="button" class="btn btn-warning hvr-sink" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
Modificar
</button>
</div>

<div class="form-group col-md-4">
 <button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
 <button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>  Exportar a excel</button>
</div>
</div>  
</form>

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->


<!--codigo de modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Accidentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="updateaccidentes" method="POST">
  <div class="form-row">  

   <div class="form-group col-md-6">
    <label for="" >Id Accidentes</label>
      <select  name="id_accidentes" id="id_accidentes" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM accidentes";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_accidentes'].'">'.$row['id_accidentes'].'</option>';
          }
        ?>
      </select>
     <p id="ns1" style="display:none" class="fallo">Coloque el id del accidente que desea modificar</p>
   </div>


    <div class="form-group col-md-6">
    <label for="">Accidente</label>
    <input type="text" class="form-control" name="accidente1" id="accidente1" placeholder="Ej: Choque del Polo">
    <p id="ns" style="display:none" class="fallo">El campo accidente no puede estar vacío</p>  
    </div>
  </div>

  <div class="form-row"> 
    <div class="form-group col-md-6">
    <label for="">Vehículo</label>
    <select  name="vehiculo1" id="vehiculo1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['vehiculo'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
    </select>
    <p id="ns2" style="display:none" class="fallo">El campo vehículo no puede estar vacío</p>   
    </div> 

   <div class="form-group col-md-6">
      <label for="">Fecha del Accidente</label>
      <div class="input-group mb-6">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
    </div>
    <input type="date" class="form-control" name="fecha_accidente1" id="fecha_accidente1">
    </div>
<p id="ns3" style="display:none" class="fallo">El campo fecha accidente no puede estar vacío</p>      </div>
</div>

 <div class="form-row"> 
    <div class="form-group col-md-6">
    <label for="">Conductor</label>
    <select  name="conductor1" id="conductor1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';
          }
        ?>
    </select>
  <p id="ns4" style="display:none" class="fallo">El campo conductor no puede estar vacío</p>   
    </div> 

   <div class="form-group col-md-6">
      <label for="">Pago Deducible</label>
      <div class="input-group mb-6">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
  <input type="text" class="form-control numerico" name="pago_deducible1" id="pago_deducible1">
    </div>
<p id="ns5" style="display:none" class="fallo">El campo pago deducible no puede estar vacío</p>      </div>
</div>

<div class="form-row">
 <div class="form-group col-md-6">
      <label for="">Pago Adicional</label>
      <div class="input-group mb-6">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
  <input type="text" class="form-control numerico" name="pago_adicional1" id="pago_adicional1">
    </div>
<p id="ns6" style="display:none" class="fallo">El campo pago adicional no puede estar vacío</p>  </div>
 
     <div class="form-group col-md-6">
      <label for="">Pago Total</label>
      <div class="input-group mb-6">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal1" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="pago_total1" id="pago_total1">
    </div>
  <p id="ns7" style="display:none" class="fallo">El campo pago total no puede estar vacío</p> 
     </div>
   </div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="">Detalles del Accidente</label>
<textarea name="detalles1" id="detalles1"></textarea>
<p id="ns8" style="display:none" class="fallo">Describe el problema</p>
</div>  
</div>

</form> 
</div>
      <div class="modal-footer bg-info"> 
      <button type="button" id="btnmodificar" class="btn btn-dark">Modificar</button>          
    </div>
  </div>
</div>
</div>
<!-- Modal -->

<!--CODIGO PARA MOSTRAR LA TABLA-->
<div class="container">
<div id="table"></div>
</div>

<script type="text/javascript"> 
  function validaForm(){
    if($("#accidente").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#accidente").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }
    // Campos de texto
    if($("#vehiculo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms1").delay(100).fadeIn("slow");
        $("#vehiculo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

    if($("#fecha_accidente").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#fecha_accidente").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

   if($("#conductor").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#conductor").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

  if($("#pago_deducible").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#pago_deducible").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }
  if($("#pago_adicional").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#pago_adicional").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    } 
    if($("#pago_total").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#pago_total").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    } 

    if($("#detalles").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#detalles").focus();
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
 $("#btnguardar1").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_accidentes.php",$("#frmaccidente").serialize(),function(res){
 
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
                     title: 'Registro de Accidentes agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmaccidente").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

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

//funcion modificar////////////////////////////////////////////////////////////////////
 function validaForm5(){
    // Campos de texto
    if($("#id_accidentes").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns1").delay(100).fadeIn("slow");
        $("#id_accidentes").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns1").fadeOut();      
    }
     // Campos de texto
    if($("#accidente1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns").delay(100).fadeIn("slow");
        $("#accidente1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns").fadeOut();      
    }
    // Campos de texto
    if($("#vehiculo1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns2").delay(100).fadeIn("slow");
        $("#vehiculo1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns2").fadeOut();      
    }

    if($("#fecha_accidente1").val() == ""){        
        $("#ns3").delay(100).fadeIn("slow");
        $("#fecha_accidente1").focus();
        return false;
    }
    else
    {
      $("#ns3").fadeOut();      
    }

   if($("#conductor1").val() == ""){        
        $("#ns4").delay(100).fadeIn("slow");
        $("#conductor1").focus();
        return false;
    }
    else
    {
      $("#ns4").fadeOut();      
    }

  if($("#pago_deducible1").val() == ""){        
        $("#ns5").delay(100).fadeIn("slow");
        $("#pago_deducible1").focus();
        return false;
    }
    else
    {
      $("#ns5").fadeOut();      
    }
  if($("#pago_adicional1").val() == ""){        
        $("#ns6").delay(100).fadeIn("slow");
        $("#pago_adicional1").focus();
        return false;
    }
    else
    {
      $("#ns6").fadeOut();      
    } 
     if($("#pago_total1").val() == ""){        
        $("#ns7").delay(100).fadeIn("slow");
        $("#pago_total1").focus();
        return false;
    }
    else
    {
      $("#ns7").fadeOut();      
    }    

     if($("#detalles1").val() == ""){        
        $("#ns8").delay(100).fadeIn("slow");
        $("#detalles1").focus();
        return false;
    }
    else
    {
      $("#ns8").fadeOut();      
    }   
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar").click( function() {
// Primero validará el formulario.
  if(validaForm5()){ 
  $.post("scripts/actualizar_accidentes.php",$("#updateaccidentes").serialize(),function(res){
 
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
                     title: 'Accidentes modificados con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("updateaccidentes").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function mifuncion2(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valores_accidentes.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos 
        $("#accidente1").val(json.accidente1);   
        $("#vehiculo1").val(json.vehiculo1);
        $("#fecha_accidente1").val(json.fecha_accidente1);
        $("#conductor1").val(json.conductor1);
        $("#pago_deducible1").val(json.pago_deducible1);
        $("#pago_adicional1").val(json.pago_adicional1);
        $("#pago_total1").val(json.pago_total1);
        $("#detalles1").val(json.detalles1);        
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  } 

//CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal").click(function(){
        var pago_deducible = $("#pago_deducible").val();      
        var pago_adicional = $("#pago_adicional").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_accidentes.php",
            data: {pago_deducible:pago_deducible,pago_adicional:pago_adicional},
            success: function(data){              
                $('#pago_total').val(data);              
            }
        });
    });
});

  //CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal1").click(function(){
        var pago_deducible1 = $("#pago_deducible1").val();      
        var pago_adicional1 = $("#pago_adicional1").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_accidentes1.php",
            data: {pago_deducible1:pago_deducible1,pago_adicional1:pago_adicional1},
            success: function(data){              
                $('#pago_total1').val(data);              
            }
        });
    });
});

//CODIGO PARA LLAMAR LA TABLA DE TABLA.SOLICITUD.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_accidentes.php');
});

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Accidentes",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>