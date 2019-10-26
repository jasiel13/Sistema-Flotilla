<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error()); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de Cambio de Balatas</title>
    
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
<h3 align="center">Registro de Cambio de Balatas
<i class="fa fa-wrench fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Cambio de Balatas
    <img src="img/llanta.png">
  </legend>

<form class="container" id="reg_balatas" method="POST">
<div class="form-row">
  <div class="form-group col-md-3">
      <label for="">Fecha de Registro</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div> 
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d");
      ?>
     <input type="text" class="form-control" name="fecha_registro" id="fecha_registro" 
      value="<?php echo $fecha; ?>">
    </div>
  </div>    

 <div class="form-group col-md-3">
 <label for="">Responsable de Atención</label>
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
      <p id="ms1" style="display:none" class="error">Seleccione el Responsable</p>
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
      <p id="ms2" style="display:none" class="error">El campo vehículo no puede estar vacío</p>
    </div>  

    <div class="form-group col-md-3">
    <label for="">Cantidad</label>       
    <input type="text" class="form-control" name="cantidad" id="cantidad">  
    <p id="ms3" style="display:none" class="error">El campo cantidad no puede estar vacío</p>    
    </div> 
</div>

<div class="form-row">
     <div class="form-group col-md-4">
       <label for="">Costo</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1">$</span>
     </div>      
     <input type="text" class="form-control numerico" name="costo" id="costo">
    </div>
    <p id="ms4" style="display:none" class="error">El campo costo no puede estar vacío</p>    
    </div> 

    <div class="form-group col-md-4">
      <label for="">Costo Total</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total" id="costo_total">
    </div>
  <p id="ms5" style="display:none" class="error">El campo costo total no puede estar vacío</p> 
     </div> 

<div class="form-group col-md-3">
<label for="">Observaciones</label>
<textarea name="observaciones" id="observaciones"></textarea>
 <p id="ms6" style="display:none" class="error">Describe Aquí</p>
</div>    
</div>  
<hr>
<div class="form-row">
<div class="form-group col-md-4">
<button type="button" id="btnenviar" class="btn btn-warning hvr-rotate">Enviar</button>
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
</div>
<div class="form-group col-md-4">
<button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i> Exportar a excel</button>
<button type="button" onclick="location.href='alertas_balatas.php'" class="btn btn-info hvr-sink">
Alerta de Balatas   
</button>
</div>
<div class="form-group col-md-2">
<button type="button" class="btn btn-warning hvr-rotate" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
Modificar
</button>
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


<!--codigo de modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Registro de Balatas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="frmupdate" method="POST">
  <div class="form-row">  

   <div class="form-group col-md-6">
    <label for="" >ID</label>
      <select  name="id_balatas" id="id_balatas" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM cambio_balatas";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_balatas'].'">'.$row['id_balatas'].'</option>';
          }
        ?>
      </select>
     <p id="ns1" style="display:none" class="fallo">Coloque el ID que desea modificar</p>
   </div>
   

  <div class="form-group col-md-6">
      <label for="">Fecha de Registro</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>       
     <input type="date" class="form-control" name="fecha_registro2" id="fecha_registro2">
    </div>
     <p id="ns2" style="display:none" class="fallo">El campo fecha no puede estar vacío</p>
  </div>
  </div>  

 <div class="form-row"> 
 <div class="form-group col-md-6">
 <label for="">Responsable de Atención</label>
  <select  name="conductor2" id="conductor2" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';
          }
        ?>  
      </select>
      <p id="ns3" style="display:none" class="fallo">Seleccione el Responsable</p>
    </div> 

<div class="form-group col-md-6">
  <label for="">Vehículo</label>
   <select  name="vehiculo2" id="vehiculo2" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['vehiculo'].'">'.$row['vehiculo'].'</option>';
          }
        ?>  
      </select>
      <p id="ns4" style="display:none" class="fallo">El campo vehículo no puede estar vacío</p>
  </div>  
   
</div>
<div class="form-row">
    <div class="form-group col-md-6">
    <label for="">Cantidad</label>       
    <input type="text" class="form-control" name="cantidad2" id="cantidad2">  
    <p id="ns5" style="display:none" class="fallo">El campo cantidad no puede estar vacío</p>    
    </div>


<div class="form-group col-md-6">
       <label for="">Costo</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1">$</span>
     </div>      
     <input type="text" class="form-control numerico" name="costo2" id="costo2">
    </div>
    <p id="ns6" style="display:none" class="fallo">El campo costo no puede estar vacío</p>    
    </div>
 </div> 
    
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="">Costo Total</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal2" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total2" id="costo_total2">
    </div>
    <p id="ns7" style="display:none" class="fallo">El campo costo total no puede estar vacío</p> 
    </div> 

<div class="form-group col-md-6">
<label for="">Observaciones</label>
<textarea name="observaciones2" id="observaciones2"></textarea>
 <p id="ns8" style="display:none" class="fallo">Describe Aquí</p>
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

<script type="text/javascript">

    function validaForm7(){
    // Campos de texto
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

if($("#vehiculo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms2").delay(100).fadeIn("slow");
        $("#vehiculo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

    if($("#cantidad").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#cantidad").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

     if($("#costo").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#costo").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }  

     if($("#costo_total").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#costo_total").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    } 
     if($("#observaciones").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#observaciones").focus();
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
 $("#btnenviar").click( function() {
// Primero validará el formulario.
  if(validaForm7()){ 
  $.post("scripts/reg_balatas.php",$("#reg_balatas").serialize(),function(res){
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al guardar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Registro Guardado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("reg_balatas").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero(numero) {
  return document.getElementById(numero);
}
numero('cantidad').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
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

//CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal").click(function(){
        var costo = $("#costo").val();
        var cantidad = $("#cantidad").val();
        //tiempo = document.getElementById("tiempo").value
        $.ajax({
            type: "POST",
            url: "scripts/suma_costo_balatas.php",
            data: {costo:costo,cantidad:cantidad},
            success: function(data){              
                $('#costo_total').val(data);
            }
        });
    });
});


//CODIGO PARA LLAMAR LA TABLA DE TABLA.SOLICITUD.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_balatas.php');
});

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Cambio de Balatas",
    fileext: ".xls",
    preserveColors: true
  }); 
});

//////////////////////////////////////MODALS//////////////////////////////////////////////////

//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero(numero) {
  return document.getElementById(numero);
}
numero('cantidad2').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});


//CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal2").click(function(){
        var costo2 = $("#costo2").val();
        var cantidad2 = $("#cantidad2").val();
        //tiempo = document.getElementById("tiempo").value
        $.ajax({
            type: "POST",
            url: "scripts/suma_costo_balatas2.php",
            data: {costo2:costo2,cantidad2:cantidad2},
            success: function(data){              
                $('#costo_total2').val(data);
            }
        });
    });
});

function mifuncion2(valor){
    $.ajax({       
      url : 'scripts/carga_valores_balatas.php',   
      data : { valor : valor },     
      type : 'POST',  
      dataType : 'json',
      success : function(json) {         
        $("#fecha_registro2").val(json.fecha_registro2);
        $("#conductor2").val(json.conductor2);
        $("#vehiculo2").val(json.vehiculo2);
        $("#cantidad2").val(json.cantidad2);
        $("#costo2").val(json.costo2);
        $("#costo_total2").val(json.costo_total2);      
        $("#observaciones2").val(json.observaciones2);     
        },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

 function validaForm1(){
   // Campos de texto
    if($("#id_balatas").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns1").delay(100).fadeIn("slow");
        $("#id_balatas").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns1").fadeOut();      
    }
    // Campos de texto
    if($("#fecha_registro2").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns2").delay(100).fadeIn("slow");
        $("#fecha_registro2").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns2").fadeOut();      
    }

    if($("#conductor2").val() == ""){        
        $("#ns3").delay(100).fadeIn("slow");
        $("#conductor2").focus();
        return false;
    }
    else
    {
      $("#ns3").fadeOut();      
    }


 if($("#vehiculo2").val() == ""){        
        $("#ns4").delay(100).fadeIn("slow");
        $("#vehiculo2").focus();
        return false;
    }
    else
    {
      $("#ns4").fadeOut();      
    }

   if($("#cantidad2").val() == ""){        
        $("#ns5").delay(100).fadeIn("slow");
        $("#cantidad2").focus();
        return false;
    }
    else
    {
      $("#ns5").fadeOut();      
    }
 
  if($("#costo2").val() == ""){        
        $("#ns6").delay(100).fadeIn("slow");
        $("#costo2").focus();
        return false;
    }
    else
    {
      $("#ns6").fadeOut();      
    }

  if($("#costo_total2").val() == ""){        
        $("#ns7").delay(100).fadeIn("slow");
        $("#costo_total2").focus();
        return false;
    }
    else
    {
      $("#ns7").fadeOut();      
    }
    

     if($("#observaciones2").val() == ""){        
        $("#ns8").delay(100).fadeIn("slow");
        $("#observaciones2").focus();
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
  if(validaForm1()){ 
  $.post("scripts/actualizar_balatas.php",$("#frmupdate").serialize(),function(res){
 
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
                     title: 'Registro Modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmupdate").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});
</script>
</body>
</html>