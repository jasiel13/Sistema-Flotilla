<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Orden de Servicio Externa</title>
    
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
<h3 align="center">Orden de Servicio Externa
<i class="fa fa fa-clipboard fa-2x"></i></h3>
</div> 

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información de la Orden de servicio
      <img src="img/servicio.png">
  </legend>

 <form class="container" id="frmorden" method="POST">
  <div class="form-row">

      <div class="form-group col-md-3">
      <label for="">Fecha de Registro(OS)</label>
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
    <label for="">Responsable</label>
    <select  name="responsable" id="responsable" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';

          }
        ?>
    </select>
    <p id="ms2" style="display:none" class="error">Seleccione una opción</p>      
    </div>
</div>
 
<div class="form-row">
      <div class="form-group col-md-3">
      <label for="">Fecha de Inicio</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>     
     <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
    </div>
     <p id="ms3" style="display:none" class="error">El campo fecha inicio no puede estar vacío</p>
    </div>

    <div class="form-group col-md-3">
    <label for="">Proveedor</label>
    <select  name="proveedor" id="proveedor" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM proveedores";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['proveedor'].'">'.$row['proveedor'].'</option>';

          }
        ?>
    </select>
    <p id="ms4" style="display:none" class="error">Seleccione una opción</p>      
    </div> 

     <div class="form-group col-md-3">
      <label for="">Estado</label>
      <select class="form-control" name="estado" id="estado">
            <option value="">Seleccionar</option>
            <option value="en curso">En curso</option>
            <option value="pendiente">Pendiente</option>
            <option value="cerrada">Cerrada</option>
        </select>
      <p id="ms5" style="display:none" class="error">Seleccione una opción</p>
    </div>

     <div class="form-group col-md-3">
      <label for="">Costo</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="costo" id="costo">
    </div>
  <p id="ms6" style="display:none" class="error">El campo costo no puede estar vacío</p> 
     </div>  
  </div>

<div class="form-row">
<div class="form-group col-md-3">
    <label for="">Kilometraje</label>
    <div class="input-group mb-4">
    <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">KM</span>
    </div>   
    <input type="text" class="form-control numerico" name="kilometraje" id="kilometraje">
   </div>
  <p id="ms7" style="display:none" class="error">El campo kilometraje no puede estar vacío</p>
  </div> 

    <div class="form-group col-md-3">
    <label for="">Autorizado por:</label>
    <select  name="autorizacion" id="autorizacion" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';

          }
        ?>
    </select>
    <p id="ms8" style="display:none" class="error">Seleccione una opción</p>      
    </div>

    <div class="form-group col-md-3">
      <label for="">Fecha de Entrega</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>     
     <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega">
    </div>
    <p id="ms9" style="display:none" class="error">El campo fecha entrega no puede estar vacío</p>
    </div>

<div class="form-group col-md-3">
<label for="">Comentarios del Servicio</label>
<textarea name="comentarios" id="comentarios"></textarea>
<p id="ms10" style="display:none" class="error">El campo comentarios no puede estar vacío</p> 
</div>
</div>

<hr>
<div class="form-row">
<div class="form-group col-md-2"></div>  
<div class="form-group col-md-4">      
<button type="button" id="btnguardar" class="btn btn-warning hvr-rotate">Enviar</button>
<button type="button" class="btn btn-warning hvr-rotate" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" style="color:black;"></i>
Modificar
</button>
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
</div>
<div class="form-group col-md-6"> 
<button type="button" onclick="location.href='comparativo_proveedores.php'" class="btn btn-info hvr-sink">
Comparativo de Proveedores
</button>
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

<!--CODIGO PARA MOSTRAR LA TABLA-->
<div id="table"></div>



<!--codigo de modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Orden de Servicio Externa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="frmupdate" method="POST">
  <div class="form-row">  

   <div class="form-group col-md-6">
    <label for="" >Número de orden</label>
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
     <p id="ns1" style="display:none" class="fallo">Coloque el numero de orden que desea modificar</p>
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
    <label for="">Servicio</label>
    <select  name="servicio1" id="servicio1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM tipos_servicios";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['tipo_servicio'].'">'.$row['tipo_servicio'].'</option>';

          }
        ?>
    </select>
    <p id="ns3" style="display:none" class="fallo">Seleccione una opción</p>      
    </div>

    <div class="form-group col-md-6">
    <label for="">Responsable</label>
    <select  name="responsable1" id="responsable1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';
          }
        ?>
    </select>
    <p id="ns4" style="display:none" class="fallo">Seleccione una opción</p>      
    </div>
</div>
 
<div class="form-row">

 <div class="form-group col-md-6">
      <label for="">Fecha de Inicio</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>     
     <input type="date" class="form-control" name="fecha_inicio1" id="fecha_inicio1">
    </div>
     <p id="ns5" style="display:none" class="fallo">El campo fecha inicio no puede estar vacío</p>
    </div>

    <div class="form-group col-md-6">
    <label for="">Proveedor</label>
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
    <p id="ns6" style="display:none" class="fallo">Seleccione una opción</p>      
    </div>  
  </div> 

<div class="form-row">
     <div class="form-group col-md-6">
      <label for="">Costo</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
    <input type="text" class="form-control numerico" name="costo1" id="costo1">
    </div>
  <p id="ns7" style="display:none" class="fallo">El campo costo no puede estar vacío</p> 
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
    <label for="">Autorizado por:</label>
    <select  name="autorizacion1" id="autorizacion1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM conductor";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';

          }
        ?>
    </select>
    <p id="ns9" style="display:none" class="fallo">Seleccione una opción</p>      
    </div>

     <div class="form-group col-md-6">
      <label for="">Fecha de Entrega</label>
       <div class="input-group mb-3">
      <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
     </div>     
     <input type="date" class="form-control" name="fecha_entrega1" id="fecha_entrega1">
    </div>
    <p id="ns10" style="display:none" class="fallo">El campo fecha entrega no puede estar vacío</p>
    </div>
  </div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="">Comentarios del Servicio</label>
<textarea name="comentarios1" id="comentarios1"></textarea>
<p id="ns11" style="display:none" class="fallo">El campo comentarios no puede estar vacío</p> 
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
    // Campos de texto
    if($("#vehiculo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#vehiculo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
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

   if($("#responsable").val() == ""){        
        $("#ms2").delay(100).fadeIn("slow");
        $("#responsable").focus();
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }
 
  if($("#fecha_inicio").val() == ""){        
        $("#ms3").delay(100).fadeIn("slow");
        $("#fecha_inicio").focus();
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

  if($("#proveedor").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#proveedor").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

     if($("#estado").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#estado").focus();
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }

     if($("#costo").val() == ""){        
        $("#ms6").delay(100).fadeIn("slow");
        $("#costo").focus();
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }

     if($("#kilometraje").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#kilometraje").focus();
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }   

     if($("#autorizacion").val() == ""){        
        $("#ms8").delay(100).fadeIn("slow");
        $("#autorizacion").focus();
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }

     if($("#fecha_entrega").val() == ""){        
        $("#ms9").delay(100).fadeIn("slow");
        $("#fecha_entrega").focus();
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }   

     if($("#comentarios").val() == ""){        
        $("#ms10").delay(100).fadeIn("slow");
        $("#comentarios").focus();
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }   
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm()){ 
  $.post("scripts/reg_ordenservicio_externa.php",$("#frmorden").serialize(),function(res){
 
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
                     title: 'Orden de Servicio agregada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmorden").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//CODIGO PARA LLAMAR LA TABLA DE TABLA.SOLICITUD.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_orden_servicio_externa.php');
});

 function validaForm1(){
 	 // Campos de texto
    if($("#numero_orden").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns1").delay(100).fadeIn("slow");
        $("#numero_orden").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
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

    if($("#servicio1").val() == ""){        
        $("#ns3").delay(100).fadeIn("slow");
        $("#servicio1").focus();
        return false;
    }
    else
    {
      $("#ns3").fadeOut();      
    }

   if($("#responsable1").val() == ""){        
        $("#ns4").delay(100).fadeIn("slow");
        $("#responsable1").focus();
        return false;
    }
    else
    {
      $("#ns4").fadeOut();      
    }
 
  if($("#fecha_inicio1").val() == ""){        
        $("#ns5").delay(100).fadeIn("slow");
        $("#fecha_inicio1").focus();
        return false;
    }
    else
    {
      $("#ns5").fadeOut();      
    }

  if($("#proveedor1").val() == ""){        
        $("#ns6").delay(100).fadeIn("slow");
        $("#proveedor1").focus();
        return false;
    }
    else
    {
      $("#ns6").fadeOut();      
    }
    

     if($("#costo1").val() == ""){        
        $("#ns7").delay(100).fadeIn("slow");
        $("#costo1").focus();
        return false;
    }
    else
    {
      $("#ns7").fadeOut();      
    }

     if($("#kilometraje1").val() == ""){        
        $("#ns8").delay(100).fadeIn("slow");
        $("#kilometraje1").focus();
        return false;
    }
    else
    {
      $("#ns8").fadeOut();      
    }   

     if($("#autorizacion1").val() == ""){        
        $("#ns9").delay(100).fadeIn("slow");
        $("#autorizacion1").focus();
        return false;
    }
    else
    {
      $("#ns9").fadeOut();      
    }

     if($("#fecha_entrega1").val() == ""){        
        $("#ns10").delay(100).fadeIn("slow");
        $("#fecha_entrega1").focus();
        return false;
    }
    else
    {
      $("#ns10").fadeOut();      
    }   

     if($("#comentarios1").val() == ""){        
        $("#ns11").delay(100).fadeIn("slow");
        $("#comentarios1").focus();
        return false;
    }
    else
    {
      $("#ns11").fadeOut();      
    }   
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnmodificar").click( function() {
// Primero validará el formulario.
  if(validaForm1()){ 
  $.post("scripts/actualizar_ordenservicioex.php",$("#frmupdate").serialize(),function(res){
 
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
                     title: 'Orden de Servicio modificada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmupdate").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function mifuncion2(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valores_ordenservicioex.php',
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
        $("#servicio1").val(json.servicio1);
        $("#responsable1").val(json.responsable1);
        $("#fecha_inicio1").val(json.fecha_inicio1);
        $("#proveedor1").val(json.proveedor1);
        $("#costo1").val(json.costo1);
        $("#kilometraje1").val(json.kilometraje1);
        $("#autorizacion1").val(json.autorizacion1);
        $("#fecha_entrega1").val(json.fecha_entrega1);
        $("#comentarios1").val(json.comentarios1);
      },
      // código a ejecutar si la petición falla;
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

