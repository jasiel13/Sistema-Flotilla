<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Registro de Seguros</title>
    
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
<h3 align="center">Registro de Seguros
<i class="fa fa-car fa-2x"></i>
</h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Registro de Seguros
    <img src="img/accidente.png">
  </legend>

<form class="container" id="frmseguros" method="POST">
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
    <p id="ms1" style="display:none" class="error">El campo vehículo no puede estar vacío</p>   
    </div> 

    <div class="form-group col-md-3">
    <label for="">Aseguradora</label>
    <select  name="aseguradora1" id="aseguradora1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM aseguradoras";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['aseguradora'].'">'.$row['aseguradora'].'</option>';
          }
        ?>
    </select>
    <p id="ms2" style="display:none" class="error">El campo aseguradora no puede estar vacío</p>   
    </div> 

    <div class="form-group col-md-3">
    <label for="">No. Póliza</label>
    <input type="text" class="form-control numerico" name="poliza" id="poliza" placeholder="Ej: 123">
    <p id="ms3" style="display:none" class="error">El campo número de póliza no puede estar vacío</p>  
    </div>  
 
   <div class="form-group col-md-3">
      <label for="">Fecha de Vencimiento</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
    </div>
    <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento">
    </div>
<p id="ms4" style="display:none" class="error">El campo fecha vencimiento no puede estar vacío</p> </div> 
   </div>

  <div class="form-row">
   <div class="form-group col-md-4">
      <label for="">Monto Total</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="monto_total" id="monto_total">
    </div>
<p id="ms5" style="display:none" class="error">El campo monto total no puede estar vacío</p>    </div>

  <div class="form-group col-md-4">
    <label for="">Accidentes</label>
    <select  name="accidente" id="accidente" class="form-control" onchange="mifuncion11(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM accidentes";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_accidentes'].'">'.$row['accidente'].'</option>';
          }
        ?>
    </select>
    <p id="ms6" style="display:none" class="error">El campo accidente no puede estar vacío</p> </div> 

    <input type="hidden" class="form-control" name="accidente1" id="accidente1">

    <div class="form-group col-md-4">
      <label for="">Costo Total del Accidente</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="costo_total_accidente" id="costo_total_accidente">
    </div>
<p id="ms7" style="display:none" class="error">El campo costo total no puede estar vacío</p>    </div>
</div>

<div class="form-row">
<div class="form-group col-md-4">
<button type="button" class="btn btn-warning hvr-sink" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
Modificar
</button>  
</div> 
<div class="form-group col-md-4">
<button type="button" id="btnguardar1" class="btn btn-info hvr-rotate">Enviar</button>
<!--BOTON DROPDOWN-->
 <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Listado de Aseguradoras
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

    <a class="dropdown-item" onclick="muestradatos()" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye fa-fw"></i> Ver Aseguradoras</a>

      <a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-sm">
      <i class="fa fa-plus fa-fw"></i>Agregar</a>
    </div>
  </div>
</div>
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

 <!--MODAL-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Aseguradoras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form class="container" id="frmagregar" method="POST">
      <div class="form-row">
      <div class="form-group col-md-12">
      <label for="">Nombre</label>
  <input type="text" class="form-control" name="aseguradora" id="aseguradora" placeholder="Ej: Axa">
    <p id="ps" style="display:none" class="fallo">El campo aseguradora no puede estar vacío</p>
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
        <h5 class="modal-title" id="exampleModalLabel">Modificar Seguros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="updateseguros" method="POST">
  <div class="form-row">  

   <div class="form-group col-md-6">
    <label for="" >Id Seguros</label>
      <select  name="id_seguro" id="id_seguro" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM seguros";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_seguro'].'">'.$row['id_seguro'].'</option>';
          }
        ?>
      </select>
     <p id="ns1" style="display:none" class="fallo">Coloque el id del seguro que desea modificar</p>
   </div>

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
   </div>  

  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="">Aseguradora</label>
    <select  name="aseguradora2" id="aseguradora2" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM aseguradoras";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['aseguradora'].'">'.$row['aseguradora'].'</option>';
          }
        ?>
    </select>
    <p id="ns3" style="display:none" class="fallo">El campo aseguradora no puede estar vacío</p></div> 

    <div class="form-group col-md-6">
    <label for="">No. Póliza</label>
    <input type="text" class="form-control numerico" name="poliza1" id="poliza1" placeholder="Ej: 123">
    <p id="ns4" style="display:none" class="fallo">El campo número de póliza no puede estar vacío</p>  
    </div>  
  </div>  
 
   <div class="form-row">
   <div class="form-group col-md-6">
      <label for="">Fecha de Vencimiento</label>
      <div class="input-group mb-6">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
    </div>
    <input type="date" class="form-control" name="fecha_vencimiento1" id="fecha_vencimiento1">
    </div>
<p id="ns5" style="display:none" class="fallo">El campo fecha vencimiento no puede estar vacío</p> </div> 
 
   <div class="form-group col-md-6">
      <label for="">Monto Total</label>
      <div class="input-group mb-6">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="monto_total1" id="monto_total1">
    </div>
<p id="ns6" style="display:none" class="fallo">El campo monto total no puede estar vacío</p>    </div>
</div>

<div class="form-row">

<div class="form-group col-md-6">
 <label for="">Accidentes</label>
  <div class="input-group mb-4">
  <div class="input-group-prepend">
  <button class="input-group-text" id="btnver" type="button" disabled>Editar</button>
  </div>
  <input type="text" class="form-control target" name="accidente2" id="accidente2">

  <select  name="accidente3" id="accidente3" class="form-control targetet" onchange="mifuncion1(this.value)" style="display:none;">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM accidentes";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_accidentes'].'">'.$row['accidente'].'</option>';
          }
        ?>
    </select>    
</div>
<p id="ns7" style="display:none" class="fallo">El campo accidente no puede estar vacío</p>
</div>

    <input type="hidden" class="form-control" name="accidente4" id="accidente4">

    <div class="form-group col-md-6">
      <label for="">Costo Total del Accidente</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="costo_total_accidente1" id="costo_total_accidente1">
    </div>
<p id="ns8" style="display:none" class="fallo">El campo costo total no puede estar vacío</p>    </div>
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
    // Campos de texto
    if($("#aseguradora1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms2").delay(100).fadeIn("slow");
        $("#aseguradora1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

    if($("#poliza").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#poliza").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

   if($("#fecha_vencimiento").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#fecha_vencimiento").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

  if($("#monto_total").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#monto_total").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }
  if($("#accidente").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#accidente").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    } 
    if($("#costo_total_accidente").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#costo_total_accidente").focus();
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
  $.post("scripts/reg_seguros.php",$("#frmseguros").serialize(),function(res){
 
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
                     title: 'Registro de Seguros agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmseguros").reset();//codigo para limpiar datos del form
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
    if($("#id_seguro").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns1").delay(100).fadeIn("slow");
        $("#id_seguro").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
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
    // Campos de texto
    if($("#aseguradora2").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns3").delay(100).fadeIn("slow");
        $("#aseguradora2").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns3").fadeOut();      
    }

    if($("#poliza1").val() == ""){        
        $("#ns4").delay(100).fadeIn("slow");
        $("#poliza1").focus();
        return false;
    }
    else
    {
      $("#ns4").fadeOut();      
    }

   if($("#fecha_vencimiento1").val() == ""){        
        $("#ns5").delay(100).fadeIn("slow");
        $("#fecha_vencimiento").focus();
        return false;
    }
    else
    {
      $("#ns5").fadeOut();      
    }

  if($("#monto_total1").val() == ""){        
        $("#ns6").delay(100).fadeIn("slow");
        $("#monto_total1").focus();
        return false;
    }
    else
    {
      $("#ns6").fadeOut();      
    }
  if($("#accidente2").val() == ""){        
        $("#ns7").delay(100).fadeIn("slow");
        $("#accidente2").focus();
        return false;
    }
    else
    {
      $("#ns7").fadeOut();      
    } 
     if($("#costo_total_accidente1").val() == ""){        
        $("#ns8").delay(100).fadeIn("slow");
        $("#costo_total_accidente1").focus();
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
  $.post("scripts/actualizar_seguros.php",$("#updateseguros").serialize(),function(res){
 
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
                     title: 'Seguros modificados con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("updateseguros").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function mifuncion2(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valores_seguros.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos 
        $("#vehiculo1").val(json.vehiculo1);   
        $("#aseguradora2").val(json.aseguradora2);
        $("#poliza1").val(json.poliza1);
        $("#fecha_vencimiento1").val(json.fecha_vencimiento1);
        $("#monto_total1").val(json.monto_total1);
        $("#accidente2").val(json.accidente2);
        $("#costo_total_accidente1").val(json.costo_total_accidente1);
        $("#accidente4").val(json.accidente4);             
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  } 

//CODIGO PARA LLAMAR LA TABLA DE TABLA.SOLICITUD.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_seguros.php');
});

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Seguros",
    fileext: ".xls",
    preserveColors: true
  }); 
});

//registrar datos del modal////////////////////////////////////////////////////////
function validaForm2(){
    // Campos de texto
    if($("#aseguradora").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ps").delay(100).fadeIn("slow");
        $("#aseguradora").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ps").fadeOut();      
    }   

     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnagregar").click( function() {
// Primero validará el formulario.
  if(validaForm2()){ 
  $.post("scripts/reg_aseguradoras.php",$("#frmagregar").serialize(),function(res){
 
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
                     title: 'Aseguradora agregada con éxito!!',
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
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de las aseguradoras...</h5>"
    }
    else
    {
      Ajax2=new XMLHttpRequest();
           Ajax2.open("get","scripts/tabla_aseguradoras.php?c="+cadena,true);
           Ajax2.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax2.responseText;
            };
           Ajax2.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DEL MODAL


function mifuncion11(valor){
    $.ajax({      
      url : 'scripts/carga_valor_seguroaccidente.php',        
      data : { valor : valor },   
      type : 'POST',    
      dataType : 'json',
      success : function(json) { 
        $("#accidente1").val(json.accidente1);       
        $("#costo_total_accidente").val(json.costo_total_accidente);   
                },      
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  } 

  ////////////////////////////////////////////////////////////////////////////////////////////
  //codigo para editar los accidentes
 $(document).on('click', '#btnver', function(){  
  if(!$('.targetet').is(':visible') ) {
          $('.targetet').show();

        }
        else
        { 
          $('.targetet').hide();

        }

         if(!$('.target').is(':visible') ) {
          $('.target').show();

        }
        else
        { 
          $('.target').hide();

        }
  }); 

   //habilitar el boton por medio del select
$( function() {
    $("#id_seguro").change( function() {
        if ($(this).val() === "0") {
            $("#btnver").prop("disabled", true);
        } else {
            $("#btnver").prop("disabled", false);
        }
    });
});

$( function() {
  $("#btnmodificar").on("click", function(){
        if ($(this).val() === "0") {
            $("#btnver").prop("disabled", false);
        } else {
            $("#btnver").prop("disabled", true);
        }
    });
});

function mifuncion1(valor){
    $.ajax({     
      url : 'scripts/carga_valores_seguros2.php',         
      data : { valor : valor },   
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        $("#accidente4").val(json.accidente4);           
        $("#costo_total_accidente1").val(json.costo_total_accidente1);              
      },   
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

  function limpiar() {
//document.getElementById("frmupdate").reset();//limpiar form
//$("#ms1").fadeOut();//limpiar mensaje de aviso
location.reload(); 
};
</script>
</body>
</html>