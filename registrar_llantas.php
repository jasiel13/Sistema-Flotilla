<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de llantas</title>
    
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
<h3 align="center">Registro de Neumáticos
<i class="fa fa-wrench fa-2x"></i>
</h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Cambio de Llantas
    <img src="img/llanta.png">
  </legend>

<form class="container" id="frmllantas" method="POST">
   <div class="form-row">

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
    <p id="ms1" style="display:none" class="error">Seleccione una opción</p>      
    </div>

    <div class="form-group col-md-3">
    <label for="">Numero de Serie</label>
    <input type="text" class="form-control" name="num_serie" id="num_serie" placeholder="#123456">
    <p id="ms2" style="display:none" class="error">El campo num_serie no puede estar vacío</p>
    </div>

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
     <input type="text" class="form-control" name="fecha" id="fecha" 
      value="<?php echo $fecha; ?>">
    </div>
  </div>

    <div class="form-group col-md-3">
    <label for="">Marca</label>
    <select  name="marca1" id="marca1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM marca_llantas";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['marca'].'">'.$row['marca'].'</option>';
          }
        ?>
    </select>
    <p id="ms3" style="display:none" class="error">Seleccione una opción</p>      
    </div>   
   </div>
<h6>Desglose de Costos</h6>
<hr style="border:1px dotted white;"> 
   <div class="form-row">
     <div class="form-group col-md-4">
    <label for="">Cantidad</label>
    <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Por llantas">
      <p id="ms4" style="display:none" class="error">El campo cantidad no puede estar vacío</p>
    </div>

    <div class="form-group col-md-4">
    <label for="">Costo Unitario</label>
    <input type="text" class="form-control numerico" name="costo_unitario" id="costo_unitario" placeholder="Costo unitario">
<p id="ms5" style="display:none" class="error">El campo costo unitario no puede estar vacío</p>
    </div>

     <div class="form-group col-md-4">
      <label for="">Costo Total</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total" id="costo_total">
    </div>
  <p id="ms6" style="display:none" class="error">El campo costo total no puede estar vacío</p> 
     </div> 
   </div>

<h6>Kilometraje</h6>
<hr style="border:1px dotted white;"> 
   <div class="form-row">
    <div class="form-group col-md-4">
    <label for="">Kilometraje Inicial</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="kilometraje" id="kilometraje">
   </div>
  <p id="ms7" style="display:none" class="error">El campo kilometraje no puede estar vacío</p>
  </div>

  <div class="form-group col-md-4">
    <label for="">Próximo Kilometraje</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="proximo_kilometraje" id="proximo_kilometraje">
   </div>
  <p id="ms8" style="display:none" class="error">El campo próximo kilometraje no puede estar vacío</p>
  </div>

       <div class="form-group col-md-4">
      <label for="">Próximo Cambio</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>   
     <input type="date" class="form-control" name="proximo_cambio" id="proximo cambio">
    </div>
  <p id="ms9" style="display:none" class="error">El campo próximo cambio no puede estar vacío</p>
  </div>
</div>
  <hr>

 <div class="form-row">
 <div class="form-group col-md-2"></div> 
 <div class="form-group col-md-4">
<button type="button" id="btnguardar1" class="btn btn-info hvr-rotate">Enviar</button>

<!--BOTON DROPDOWN-->
 <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Marcas de Neumáticos
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

    <a class="dropdown-item" onclick="muestradatos()" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye fa-fw"></i> Ver Marcas</a>

      <a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-sm">
      <i class="fa fa-plus fa-fw"></i>Agregar</a>
    </div>
  </div>
</div>
</div>

<div class="form-group col-md-4">
<button type="button" onclick="location.href='alertas_llantas.php'" class="btn btn-warning hvr-sink"><i class="fa fa-bell fa-fw"></i>
Alerta de Neumáticos    
</button>
<button type="button" class="btn btn-warning hvr-sink" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
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

<!--MODAL-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Marcas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form class="container" id="frmagregar" method="POST">
      <div class="form-row">
      <div class="form-group col-md-12">
      <label for="">Nombre</label>
    <input type="text" class="form-control" name="marca" id="marca" placeholder="Ej: Firestone">
    <p id="ns" style="display:none" class="fallo">El campo marca no puede estar vacío</p>
  
      </div>        
      </div>   
    </form>
     
    </div>
    <div class="modal-footer bg-info"> 
    <button type="button" id="btnagregar" class="btn btn-dark">Enivar</button>    
     
    </div>
    </div>
  </div>
</div>
<!--modal-->

<!--modal para la tabla-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver <i class="fa fa-eye fa-fw"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Codigo para mostrar tabla de datos -->
      <div id="tabla_1" class="table-responsive-sm"></div>     
    </div>
  </div>
</div>
<!--modal para la tabla-->


<!--codigo de modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Cambio de Neumáticos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="updatellantas" method="POST">
  <div class="form-row">  

   <div class="form-group col-md-6">
    <label for="" >Número de Cambio</label>
      <select  name="id_llantas" id="id_llantas" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM llantas";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_llantas'].'">'.$row['id_llantas'].'</option>';
          }
        ?>
      </select>
     <p id="ns1" style="display:none" class="fallo">Coloque el numero de cambio que desea modificar</p>
   </div>

   <div class="form-group col-md-6">
    <label for="" >Vehículo</label>
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
     <p id="ns2" style="display:none" class="fallo">El campo vehículo no puede ir vacío</p>
   </div>
 </div>


 <div class="form-row">
 
 <div class="form-group col-md-6">
    <label for="">Num_serie</label>
    <input type="text" class="form-control" name="num_serie2" id="num_serie2" placeholder="#123">   
    <p id="ns3" style="display:none" class="fallo">El campo num_serie no puede estar vacío</p> 
</div> 

 <div class="form-group col-md-6">
   <label for="">Marca</label>
    <select  name="marca2" id="marca2" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM marca_llantas";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['marca'].'">'.$row['marca'].'</option>';
          }
        ?>
    </select> 
 <p id="ns4" style="display:none" class="fallo">Seleccione una opción</p>      
</div>   
</div>
 
<div class="form-row">

<div class="form-group col-md-6">
<label for="">Cantidad</label>
<input type="text" class="form-control" name="cantidad1" id="cantidad1" placeholder="Por llantas">   
<p id="ns5" style="display:none" class="fallo">El campo cantidad no puede estar vacío</p> 
</div>

 <div class="form-group col-md-6">
 <label for="">Costo Unitario</label>
<input type="text" class="form-control numerico" name="costo_unitario1" id="costo_unitario1" placeholder="Costo unitario">
<p id="ns6" style="display:none" class="fallo">El campo costo unitario no puede estar vacío</p>
</div>     
</div>  


<div class="form-row">
     <div class="form-group col-md-6">
    <label for="">Costo Total</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
      <button class="input-group-text" id="enviartotal1" type="button" style="color:#20c997;">+$</button>
    </div>
    <input type="text" class="form-control numerico" name="costo_total1" id="costo_total1">
    </div>
  <p id="ns7" style="display:none" class="fallo">El campo costo total no puede estar vacío</p> 
     </div>

   <div class="form-group col-md-6">
   <label for="">Kilometraje</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="kilometraje1" id="kilometraje1">
   </div>
  <p id="ns8" style="display:none" class="fallo">El campo kilometraje no puede estar vacío</p>
</div>  
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="">Próximo Kilometraje</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="proximo_kilometraje1" id="proximo_kilometraje1">
   </div>
  <p id="ns9" style="display:none" class="fallo">El campo próximo kilometraje no puede estar vacío</p>    
  </div> 
  </div>  
</form>
      </div>
      <div class="modal-footer bg-info"> 
      <button type="button" id="btnmodificar" class="btn btn-dark">Modificar</button>
      <button type="button" class="btn btn-dark" onclick="delete1($('#id_llantas').val())">Eliminar</button>          
    </div>
  </div>
</div>
</div>
<!-- Modal -->

<script type="text/javascript"> 
  function validaForm(){
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

     if($("#num_serie").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms2").delay(100).fadeIn("slow");
        $("#num_serie").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

    if($("#marca1").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#marca1").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

   if($("#cantidad").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#cantidad").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

  if($("#costo_unitario").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#costo_unitario").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }
  if($("#costo_total").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#costo_total").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }

  if($("#kilometraje").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#kiloemtraje").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }

    if($("#proximo_kilometraje").val() == ""){        
        $("#ms8").delay(100).fadeIn("slow");
        $("#proximo_kilometraje").focus();
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }

    if($("#proximo_cambio").val() == ""){        
        $("#ms9").delay(100).fadeIn("slow");
        $("#proximo_cambio").focus();
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar1").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_neumaticos.php",$("#frmllantas").serialize(),function(res){
 
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
                     title: 'Registro de Neumáticos agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmllantas").reset();//codigo para limpiar datos del form
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
        var costo_unitario = $("#costo_unitario").val();      
        var cantidad = $("#cantidad").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_llantas.php",
            data: {costo_unitario:costo_unitario,cantidad:cantidad},
            success: function(data){              
                $('#costo_total').val(data);              
            }
        });
    });
});

//registrar datos del modal////////////////////////////////////////////////////////
function validaForm2(){
    // Campos de texto
    if($("#marca").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns").delay(100).fadeIn("slow");
        $("#marca").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns").fadeOut();      
    }

     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnagregar").click( function() {
// Primero validará el formulario.
  if(validaForm2()){ 
  $.post("scripts/reg_marcallantas.php",$("#frmagregar").serialize(),function(res){
 
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
                     title: 'Marca agregada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmagregar").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//CODIGO PARA MANDAR LLAMAR LA TABLA DEL MODAL
   function muestradatos(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de las marcas...</h5>"
    }
    else
    {
      Ajax2=new XMLHttpRequest();
           Ajax2.open("get","scripts/tabla_marcallantas.php?c="+cadena,true);
           Ajax2.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax2.responseText;
            };
           Ajax2.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DEL MODAL

//funcion modificar////////////////////////////////////////////////////////////////////
 function validaForm5(){
    // Campos de texto
    if($("#id_llantas").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns1").delay(100).fadeIn("slow");
        $("#id_llantas").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns1").fadeOut();      
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

    if($("#num_serie2").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns3").delay(100).fadeIn("slow");
        $("#num_serie2").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns3").fadeOut();      
    }

    if($("#marca2").val() == ""){        
        $("#ns4").delay(100).fadeIn("slow");
        $("#marca2").focus();
        return false;
    }
    else
    {
      $("#ns4").fadeOut();      
    }

   if($("#cantidad1").val() == ""){        
        $("#ns5").delay(100).fadeIn("slow");
        $("#cantidad1").focus();
        return false;
    }
    else
    {
      $("#ns5").fadeOut();      
    }

  if($("#costo_unitario1").val() == ""){        
        $("#ns6").delay(100).fadeIn("slow");
        $("#costo_unitario1").focus();
        return false;
    }
    else
    {
      $("#ns6").fadeOut();      
    }
  if($("#costo_total1").val() == ""){        
        $("#ns7").delay(100).fadeIn("slow");
        $("#costo_total1").focus();
        return false;
    }
    else
    {
      $("#ns7").fadeOut();      
    }

  if($("#kilometraje1").val() == ""){        
        $("#ns8").delay(100).fadeIn("slow");
        $("#kiloemtraje1").focus();
        return false;
    }
    else
    {
      $("#ns8").fadeOut();      
    }

    if($("#proximo_kilometraje1").val() == ""){        
        $("#ns9").delay(100).fadeIn("slow");
        $("#proximo_kilometraje1").focus();
        return false;
    }
    else
    {
      $("#ns9").fadeOut();      
    }   
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar").click( function() {
// Primero validará el formulario.
  if(validaForm5()){ 
  $.post("scripts/actualizar_llantas.php",$("#updatellantas").serialize(),function(res){
 
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
                     title: 'Registro de Neumáticos modificado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("updatellantas").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function mifuncion2(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valores_llantas.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos  
        $("#num_serie2").val(json.num_serie2);  
        $("#vehiculo1").val(json.vehiculo1);
        $("#marca2").val(json.marca2);
        $("#cantidad1").val(json.cantidad1);
        $("#costo_unitario1").val(json.costo_unitario1);
        $("#costo_total1").val(json.costo_total1);      
        $("#kilometraje1").val(json.kilometraje1);
        $("#proximo_kilometraje1").val(json.proximo_kilometraje1);       
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

//CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal1").click(function(){
        var costo_unitario1 = $("#costo_unitario1").val();      
        var cantidad1 = $("#cantidad1").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_llantasupdate.php",
            data: {costo_unitario1:costo_unitario1,cantidad1:cantidad1},
            success: function(data){              
                $('#costo_total1').val(data);              
            }
        });
    });
});

 //CODIGO PARA BORRAR REGISTRO
function delete1(id){
  if(confirm("Esta seguro que desea eliminar este registro?")){
  $.ajax({
      url : 'scripts/borrar_llantas.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        alert(data);
        document.getElementById("updatellantas").reset();        
      }
  });
  }  
}//se quita este corchete y el if confirm si no quieres confirmar el eliminar

function limpiar() {
//document.getElementById("frmupdate").reset();//limpiar form
//$("#ms1").fadeOut();//limpiar mensaje de aviso
location.reload(); 
};
</script>
</body>
</html>