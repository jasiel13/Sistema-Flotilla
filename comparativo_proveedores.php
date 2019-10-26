<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Comparativo de Proveedores</title>
    
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
<h3 align="center">Comparativo de Proveedores
<i class="fa fa fa-balance-scale fa-2x"></i></h3>
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información de Proveedores
      <img src="img/comparar.png">
  </legend>

 <form class="container" id="comparativa" method="POST">
  <div class="form-row">   

    <div class="form-group col-md-3">
    <label for="">Orden de Servicio Externo</label>
    <select  name="numero_orden" id="numero_orden" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM orden_servicio_externo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['numero_orden'].'">'.$row['numero_orden'].'</option>';
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
    <p id="ms3" style="display:none" class="error">Seleccione una opción</p>      
    </div>

    <div class="form-group col-md-3">
    <label for="">Cantidad</label>
    <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Por Servicio">
      <p id="ms4" style="display:none" class="error">El campo cantidad no puede estar vacío</p>
    </div>
</div>

<h6>Desglose de Proveedores</h6>
<hr style="border:1px dotted white;"> 
<div class="form-row">
    <div class="form-group col-md-4">
    <label for="">Proveedor 1</label>
    <select  name="proveedor1" id="proveedor1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM proveedores";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['proveedor'].'">'.$row['proveedor'].'</option>';

          }
        ?>
    </select>
    <p id="ms5" style="display:none" class="error">Seleccione una opción</p>      
    </div> 

     <div class="form-group col-md-4">
    <label for="">Costo Unitario 1</label>
    <input type="text" class="form-control numerico" name="costo_unitario1" id="costo_unitario1" placeholder="Costo unitario">
  <p id="ms6" style="display:none" class="error">El campo costo unitario no puede estar vacío</p>
    </div>

     <div class="form-group col-md-4">
      <label for="">Costo Total 1</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total1" id="costo_total1">
    </div>
  <p id="ms7" style="display:none" class="error">El campo costo total no puede estar vacío</p> 
     </div> 
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
    <label for="">Proveedor 2</label>
    <select  name="proveedor2" id="proveedor2" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM proveedores";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['proveedor'].'">'.$row['proveedor'].'</option>';

          }
        ?>
    </select>
    <p id="ms8" style="display:none" class="error">Seleccione una opción</p>      
    </div> 

     <div class="form-group col-md-4">
    <label for="">Costo Unitario 2</label>
    <input type="text" class="form-control numerico" name="costo_unitario2" id="costo_unitario2" placeholder="Costo unitario">
  <p id="ms9" style="display:none" class="error">El campo costo unitario no puede estar vacío</p>
    </div>

 <div class="form-group col-md-4">
      <label for="">Costo Total 2</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal2" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total2" id="costo_total2">
    </div>
  <p id="ms10" style="display:none" class="error">El campo costo total no puede estar vacío</p> 
     </div> 
  </div> 

  <div class="form-row">
    <div class="form-group col-md-4">
    <label for="">Proveedor 3</label>
    <select  name="proveedor3" id="proveedor3" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM proveedores";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['proveedor'].'">'.$row['proveedor'].'</option>';

          }
        ?>
    </select>
    <p id="ms11" style="display:none" class="error">Seleccione una opción</p>      
    </div> 

     <div class="form-group col-md-4">
    <label for="">Costo Unitario 3</label>
    <input type="text" class="form-control numerico" name="costo_unitario3" id="costo_unitario3" placeholder="Costo unitario">
  <p id="ms12" style="display:none" class="error">El campo costo unitario no puede estar vacío</p>
    </div>

  <div class="form-group col-md-4">
      <label for="">Costo Total 3</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal3" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total3" id="costo_total3">
    </div>
  <p id="ms13" style="display:none" class="error">El campo costo total no puede estar vacío</p> 
     </div> 
  </div>   
<hr>
<div class="form-row">
<div class="form-group col-md-3"></div>  
<div class="form-group col-md-4">      
<button type="button" id="btnguardar" class="btn btn-warning hvr-rotate">Enviar</button>
<button type="button" onclick="location.href='orden_servicio_externa.php'" class="btn btn-info hvr-sink">
Orden de Servicio Externa
</button>
</div>
<div class="form-group col-md-2">
<button type="button" onclick="location.href='tabla_historial_ordenes_servicioex.php'" class="btn btn-info hvr-sink">
Historial de Ordenes
</button>  
</div>
    </div>   
  </div>
</form>   

<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<script type="text/javascript">

//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero(numero) {
  return document.getElementById(numero);
}
numero('cantidad').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});
//este codigo es para bloquear el uso de letras en campos de solo numeros positivos  

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
        var costo_unitario1 = $("#costo_unitario1").val();      
        var cantidad = $("#cantidad").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_comparativapro.php",
            data: {costo_unitario1:costo_unitario1,cantidad:cantidad},
            success: function(data){              
                $('#costo_total1').val(data);              
            }
        });
    });
});

$(document).ready(function(){
    $("#enviartotal2").click(function(){
        var costo_unitario2 = $("#costo_unitario2").val();      
        var cantidad = $("#cantidad").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_comparativapro2.php",
            data: {costo_unitario2:costo_unitario2,cantidad:cantidad},
            success: function(data){              
                $('#costo_total2').val(data);              
            }
        });
    });
});

$(document).ready(function(){
    $("#enviartotal3").click(function(){
        var costo_unitario3 = $("#costo_unitario3").val();      
        var cantidad = $("#cantidad").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_comparativapro3.php",
            data: {costo_unitario3:costo_unitario3,cantidad:cantidad},
            success: function(data){              
                $('#costo_total3').val(data);              
            }
        });
    });
});


  function validaForm(){
    // Campos de texto
    if($("#numero_orden").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms1").delay(100).fadeIn("slow");
        $("#numero_orden").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#m1").fadeOut();      
    }

    if($("#vehiculo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms2").delay(100).fadeIn("slow");
        $("#vehiculo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#m2").fadeOut();      
    }

    if($("#servicio").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#servicio").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

   if($("#cantidad").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#responsable").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }
 
  if($("#proveedor1").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#proveedor1").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }

  if($("#costo_unitario1").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#costo_unitario1").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }

     if($("#costo_total1").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#costo_total1").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }

     if($("#proveedor2").val() == ""){        
        $("#ms8").delay(100).fadeIn("slow");
        $("#proveedor2").focus();
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }

     if($("#costo_unitario2").val() == ""){        
        $("#ms9").delay(100).fadeIn("slow");
        $("#costo_unitario2").focus();
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }   

     if($("#costo_total2").val() == ""){        
        $("#ms10").delay(100).fadeIn("slow");
        $("#costo_total2").focus();
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }

     if($("#proveedor3").val() == ""){        
        $("#ms11").delay(100).fadeIn("slow");
        $("#proveedor3").focus();
        return false;
    }
    else
    {
      $("#ms11").fadeOut();      
    }   

     if($("#costo_unitario3").val() == ""){        
        $("#ms12").delay(100).fadeIn("slow");
        $("#costo_unitario3").focus();
        return false;
    }
    else
    {
      $("#ms12").fadeOut();      
    } 

    if($("#costo_total3").val() == ""){        
        $("#ms13").delay(100).fadeIn("slow");
        $("#costo_total3").focus();
        return false;
    }
    else
    {
      $("#ms13").fadeOut();      
    }     
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_comparativapro.php",$("#comparativa").serialize(),function(res){
 
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
                     title: 'Comparativa de Proveedores agregada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("comparativa").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});


function mifuncion2(valor){
    $.ajax({     
      url : 'scripts/carga_valores_orden_paracomparativa.php',       
      data : { valor : valor }, 
      type : 'POST',
      dataType : 'json',
      success : function(json) {  
        
        $("#vehiculo").val(json.vehiculo);  
        $("#servicio").val(json.servicio);      
      },   
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

</script>
</body>
</html>

