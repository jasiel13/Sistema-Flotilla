<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Agregar y Cargar Combustible</title>
    
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
    <link rel="stylesheet" type="text/css" href="css/boton.css">
  </head>

<body>
<div class="bg-info clearfix">
<h3 align="center">Agregar tipo de combustible
<i class="fa fa-tint fa-2x"></i></h3> 
</div>

<!--MODAL-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Agregar combustible</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form class="container" id="frmagregar" method="POST">
      <div class="form-row">
      <div class="form-group col-md-12">
      <label for="">Nombre</label>
    <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Combustible">
      <p id="ms" style="display:none" class="fallo">El campo combustible no puede estar vacío</p>
  
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

<!--formulario de registro-->
<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Registrar carga de combustible
    <img src="img/gas.png">
  </legend>

<form class="container" id="frmcarga" method="POST">
  <div class="form-row">

    <div class="form-group col-md-3 targetet" style="display:none">
    <label for="" >Id de carga</label>
      <select  name="id_carga" id="id_carga" class="form-control" onchange="mifuncion5(this.value)">
        <option value="">Seleccione...</option>
        <?php
// Realizamos la consulta para extraer los datos
            $query="SELECT  * FROM carga_combustible";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$row['id_carga'].'">'.$row['id_carga'].'</option>';
          }
        ?>
      </select>
     <p id="ms16" style="display:none" class="error">Seleccione un id para modificar</p>
   </div>


    <div class="form-group col-md-3">
      <label for="">Vehículo</label>
       <select  name="vehiculo1" id="vehiculo1" class="form-control target tar" onchange="mifuncion666(this.value)">
        <option value="">Seleccione...</option>
        <?php
// Realizamos la consulta para extraer los datos
            $query="SELECT  * FROM vehiculo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
// En esta sección estamos llenando el select con datos extraidos de una base de datos.
            echo '<option value="'.$row['no_unidad'].'">'.$row['vehiculo'].'</option>';
          }
        ?>
      </select>

  <div class="input-group mb-3 targetet targ" style="display:none">
  <div class="input-group-prepend">
 <button class="input-group-text" id="ver" type="button" style="color:#20c997;" disabled>Editar</button> 
  </div>
 <input type="text" class="form-control" name="vehiculo" id="vehiculo"> 
  </div>

  <p id="ms1" style="display:none" class="error">El campo vehículo no puede estar vacío</p> 
     </div> 

    <div class="form-group col-md-3">
      <label for="">Fecha carga combustible</label>
      <input type="date" class="form-control" name="fecha" id="fecha">
  <p id="ms2" style="display:none" class="error">El campo fecha no puede estar vacío</p> 
     </div>
     <div class="form-group col-md-3">
      <label for="">Hora carga combustible</label>
      <input type="time" class="form-control" name="hora" id="hora">
  <p id="ms3" style="display:none" class="error">El campo hora no puede estar vacío</p> 
     </div>            
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="">Ticket</label>
      <input type="text" class="form-control" name="ticket" id="ticket" placeholder="Ticket">
  <p id="ms4" style="display:none" class="error">El campo ticket no puede estar vacío</p> 
     </div> 

    <div class="form-group col-md-4">
    <label for="" >Factura</label>
    <input type="text" class="form-control" name="factura" id="factura" placeholder="Factura">
     <p id="ms5" style="display:none" class="error">El campo factura no puede ir vacío</p>
   </div>

     <div class="form-group col-md-4">
      <label for="">Tipo de combustible</label>
      <select  name="tipo1" id="tipo1" class="form-control">
        <option value="">Seleccione...</option>
        <?php
            $query1="SELECT  * FROM tipo_combustible";
            $result1=mysqli_query($con, $query1) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result1)){ 
            echo '<option value="'.$row['tipo'].'">'.$row['tipo'].'</option>';
          }
        ?>
      </select>
      <p id="ms6" style="display:none" class="error">El campo tipo no puede ir vacío</p>      
    </div>
</div>

<h6>Cantidad de litros</h6>
<hr style="border:1px dotted white;">

<div class="form-row">
 <div class="form-group col-md-3">
      <label for="">Monto Total</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
  <input type="text" class="form-control numerico" name="costo_total" id="costo_total" placeholder="Costo">
    </div>
  <p id="ms7" style="display:none" class="error">El campo monto total no puede estar vacío</p> 
     </div>

     <div class="form-group col-md-3">
      <label for="">Costo por litro</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">$</span>
    </div>
  <input type="text" class="form-control numerico" name="costo_litro" id="costo_litro" placeholder="Monto / litro">
    </div>
  <p id="ms8" style="display:none" class="error">El campo costo por litro no puede estar vacío</p>   </div>

  <div class="form-group col-md-3">
    <label for="">Litros</label>   
 <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text" id="enviartotallitros" type="button" style="color:#20c997;">+LT</button>  
  </div>
  <input type="text" class="form-control numerico" name="litros" id="litros" placeholder="Cantidad por litros">
</div>
<p id="ms9" style="display:none" class="error">El campo litros no puede estar vacío</p>
</div>

<div class="form-group col-md-3 target">
<br>
<label class="switch">
  <input type="hidden"  name="capacidad" id="capacidad" value="0">
  <input type="checkbox" name="capacidad" id="capacidad" value="1" checked>  
  <span class="slider round"></span>
</label>

 <label>¿Tanque lleno?
 <div class="ola badge badge-warning" >?
 <span class="ola2">Cambia a ROJO si el tanque no se llenó con esta carga.</span>
 </div>
 </label>
 </div>
</div>

<h6>Kilometraje</h6>
<hr style="border:1px dotted white;">

<div class="form-row">
      <div class="form-group col-md-3">
      <label for="">Km Inicial</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">KM</span>
    </div>
      <input type="text" class="form-control numerico" name="km_inicial" id="km_inicial">
    </div>
  <p id="ms10" style="display:none" class="error">El campo km inicial no puede estar vacío</p> 
     </div>

      <div class="form-group col-md-3">
      <label for="">Km Final</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">KM</span>
    </div>
      <input type="text" class="form-control numerico" name="km_final" id="km_final">
    </div>
  <p id="ms11" style="display:none" class="error">El campo km final no puede estar vacío</p> 
     </div>

      <div class="form-group col-md-3">
      <label for="">Rendimiento Real</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
    <button class="input-group-text" id="enviarrendimientoreal" type="button" style="color:#20c997;">+KM</button> 
    </div>
      <input type="text" class="form-control numerico" name="rendimiento_real" id="rendimiento_real">
    </div>
<p id="ms12" style="display:none" class="error">El campo rendimiento real no puede estar vacío</p>      </div>

 <div class="form-group col-md-3">
      <label for="">Rendimiento Nominal</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">KM</span>
    </div>
      <input type="text" class="form-control numerico" name="rendimiento_kilometro" id="rendimiento_kilometro" placeholder="Rendimiento Esperado">
    </div>
  <p id="ms13" style="display:none" class="error">El campo rendimiento por kilometro no puede estar vacío</p> 
     </div>
</div>

<hr style="border:1px dotted white;">

<div class="form-row">

      <div class="form-group col-md-3">
      <label for="">Diferencia Absoluta</label>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
    <button class="input-group-text" id="enviarfactor" type="button" style="color:#20c997;">RR-RN</button> 
    </div>
      <input type="text" class="form-control numerico" name="factor" id="factor" placeholder="Factor">
    </div>
<p id="ms14" style="display:none" class="error">El campo diferencia absoluta no puede estar vacío</p> 
  </div>


<div class="form-group col-md-3">
  <label for="">Porcentaje</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text" id="enviardif" type="button" style="color:#20c997;">%</button> 
  </div>
  <input type="text" class="form-control numerico" name="porcentaje" id="porcentaje">
  </div>
<p id="ms15" style="display:none" class="error">El campo porcentaje no puede estar vacío</p> 
  </div> 

 <div class="form-group col-md-3">
      <label for="">Empresa</label>
      <select name="empresa" id="empresa" class="form-control">
        <option value="">Seleccione...</option>
        <option value="csn">CSN</option>
        <option value="sea">SEA</option>
        <option value="cta">CTA</option>      
      </select>
      <p id="ms17" style="display:none" class="error">Seleccione una opción</p>
    </div>

    <div class="form-group col-md-3 target">
      <label for="">Fecha de Registro</label>
      <?php 
      date_default_timezone_set('America/Mexico_City');        
      $fecha = date("Y/m/d H:i:s"); //formato fecha y hora
      ?>
     <input type="text" class="form-control" name="fecha_reg" id="fecha_reg" 
      value="<?php echo $fecha; ?>">
     </div>     
   </div>  
<hr>
<div class="form-row">
<div class="form-group col-md-4">  
<button type="button" id="modificar" class="btn btn-info hvr-float targetet" style="display:none">Modificar</button>
<button type="button" id="btnguardar" class="btn btn-warning hvr-rotate">Enivar</button>
<button type="button" id="btnmod" class="btn btn-warning hvr-rotate reg" onclick="limpiar2()"> <i class="fa fa-edit" style="color:black;"></i>  Editar Registro</button> 
</div>
<div class="form-group col-md-4">
<!--BOTON DROPDOWN-->
 <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Tipos de combustible
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

    <a class="dropdown-item" onclick="muestradatos()" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye fa-fw"></i> Ver tipos</a>

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

<!--CODIGO PARA MOSTRAR LA TABLA-->

<div id="table"></div>


<script type="text/javascript">
    function validaForm18(){
    // Campos de texto
    if($("#tipo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms").delay(100).fadeIn("slow");
        $("#tipo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    }

     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnagregar").click( function() {
// Primero validará el formulario.
  if(validaForm18()){ 
  $.post("scripts/reg_tipocombustible.php",$("#frmagregar").serialize(),function(res){
 
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
                     title: 'Combustible agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmagregar").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function limpiar() {
document.getElementById("frmagregar").reset();//limpiar form
$("#ms").fadeOut();//limpiar mensaje de aviso
//location.reload(); 
};

function limpiar2() {
document.getElementById("frmcarga").reset();//limpiar form 
};


//MOSTRAR TABLA
 function muestradatos(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de combustible...</h5>"
    }
    else
    {
      Ajax=new XMLHttpRequest();
           Ajax.open("get","scripts/tabla_combustible.php?c="+cadena,true);
           Ajax.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax.responseText;
            };
           Ajax.send(null);
    }
  }
//Codigo del formulario principal//////////////////////////////////////////////////////////////

 function validaForm19(){
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
    // Campos de texto
    if($("#fecha").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms2").delay(100).fadeIn("slow");
        $("#fecha").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

    if($("#hora").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms3").delay(100).fadeIn("slow");
        $("#hora").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

if($("#ticket").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms4").delay(100).fadeIn("slow");
        $("#ticket").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

if($("#factura").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms5").delay(100).fadeIn("slow");
        $("#factura").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }


if($("#tipo1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms6").delay(100).fadeIn("slow");
        $("#tipo1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }


if($("#costo_total").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms7").delay(100).fadeIn("slow");
        $("#costo_total").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }

if($("#costo_litro").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms8").delay(100).fadeIn("slow");
        $("#costo_litro").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }

if($("#litros").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms9").delay(100).fadeIn("slow");
        $("#litros").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }


if($("#km_inicial").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms10").delay(100).fadeIn("slow");
        $("#km_inicial").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }

    if($("#km_final").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms11").delay(100).fadeIn("slow");
        $("#km_final").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms11").fadeOut();      
    }

    if($("#rendimiento_real").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms12").delay(100).fadeIn("slow");
        $("#rendimiento_real").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms12").fadeOut();      
    }

    if($("#rendimiento_kilometro").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms13").delay(100).fadeIn("slow");
        $("#rendimiento_kilometro").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms13").fadeOut();      
    }

    if($("#factor").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms14").delay(100).fadeIn("slow");
        $("#factor").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms14").fadeOut();      
    }

    if($("#porcentaje").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms15").delay(100).fadeIn("slow");
        $("#porcentaje").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms15").fadeOut();      
    }

    if($("#empresa").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms17").delay(100).fadeIn("slow");
        $("#empresa").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms17").fadeOut();      
    }

     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnguardar").click( function() {
// Primero validará el formulario.
  if(validaForm19()){ 
  $.post("scripts/reg_cargacombustible.php",$("#frmcarga").serialize(),function(res){
 
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
                     title: 'Recarga de combustible agregada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmcarga").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

//CODIGO PARA LLAMAR LA TABLA DE TABLA.COMBUSTIBLE.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_cargacombustible.php');
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


//este codigo es para bloquear el uso de letras en campos de solo numeros positivos
function numero(numero) {
  return document.getElementById(numero);
}
numero('ticket').addEventListener('input',function() {
  var val = this.value;
  this.value = val.replace(/\D|\-/,'');
});


function mifuncion5(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valorescombus.php',
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
        $("#vehiculo").val(json.vehiculo);
        $("#fecha").val(json.fecha);
        $("#hora").val(json.hora);
        $("#ticket").val(json.ticket);       
        $("#factura").val(json.factura);
        $("#tipo1").val(json.tipo1);
        $("#costo_total").val(json.costo_total);
        $("#litros").val(json.litros);
        $("#costo_litro").val(json.costo_litro);
        $("#empresa").val(json.empresa);
        $("#km_inicial").val(json.km_inicial);
        $("#km_final").val(json.km_final);
        $("#rendimiento_real").val(json.rendimiento_real);
        $("#rendimiento_kilometro").val(json.rendimiento_kilometro);
        $("#factor").val(json.factor);
        $("#porcentaje").val(json.porcentaje);
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

//Boton para ocultar elementos y mostrar otros
     $(document).on('click', '#btnmod', function(){     
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

     //codigo pa regresar el select vehiculo una vez que le damos al boton editar registro
    $(document).on('click', '#ver', function(){     
        if(!$('.tar').is(':visible') ) {
          $('.tar').show();

        }
        else
        { 
          $('.tar').hide();

        } 

        if(!$('.targ').is(':visible') ) {
          $('.targ').show();

        }
        else
        { 
          $('.targ').hide();

        }     
    }); 

//ocultar boton de editar registro una vez que se editen los datos
 $(document).on('click', '#ver', function(){     
        if(!$('.reg').is(':visible') ) {
          $('.reg').show();

        }
        else
        { 
          $('.reg').hide();

        }          
    }); 
  $(document).on('click', '#modificar', function(){     
        if(!$('.reg').is(':visible') ) {
          $('.reg').show();

        }
        else
        { 
          $('.reg').hide();

        }          
    }); 

  //habilitar el boton editar por medio del select id_carga
$( function() {
    $("#id_carga").change( function() {
        if ($(this).val() === "0") {
            $("#ver").prop("disabled", true);
        } else {
            $("#ver").prop("disabled", false);
        }       
    });
});

 //MODIFICAR TABLA DE CARGA_COMBUSTIBLE
  function validaForm20(){
 if($("#id_carga").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms16").delay(100).fadeIn("slow");
        $("#id_carga").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms16").fadeOut();      
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
    // Campos de texto
    if($("#fecha").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms2").delay(100).fadeIn("slow");
        $("#fecha").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms2").fadeOut();      
    }

    if($("#hora").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms3").delay(100).fadeIn("slow");
        $("#hora").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms3").fadeOut();      
    }

if($("#ticket").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms4").delay(100).fadeIn("slow");
        $("#ticket").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

if($("#factura").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms5").delay(100).fadeIn("slow");
        $("#factura").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms5").fadeOut();      
    }


if($("#tipo1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms6").delay(100).fadeIn("slow");
        $("#tipo1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms6").fadeOut();      
    }


if($("#costo_total").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms7").delay(100).fadeIn("slow");
        $("#costo_total").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms7").fadeOut();      
    }

if($("#costo_litro").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms8").delay(100).fadeIn("slow");
        $("#costo_litro").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms8").fadeOut();      
    }

if($("#litros").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms9").delay(100).fadeIn("slow");
        $("#litros").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms9").fadeOut();      
    }


if($("#km_inicial").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms10").delay(100).fadeIn("slow");
        $("#km_inicial").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms10").fadeOut();      
    }

    if($("#km_final").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms11").delay(100).fadeIn("slow");
        $("#km_final").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms11").fadeOut();      
    }

    if($("#rendimiento_real").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms12").delay(100).fadeIn("slow");
        $("#rendimiento_real").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms12").fadeOut();      
    }

    if($("#rendimiento_kilometro").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms13").delay(100).fadeIn("slow");
        $("#rendimiento_kilometro").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms13").fadeOut();      
    }

    if($("#factor").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms14").delay(100).fadeIn("slow");
        $("#factor").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms14").fadeOut();      
    }

    if($("#porcentaje").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms15").delay(100).fadeIn("slow");
        $("#porcentaje").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms15").fadeOut();      
    }

    if($("#empresa").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms17").delay(100).fadeIn("slow");
        $("#empresa").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms17").fadeOut();      
    }
     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#modificar").click( function() {
// Primero validará el formulario.
  if(validaForm20()){ 
  $.post("scripts/actualizar_carga_combus.php",$("#frmcarga").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al modificar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Recarga de combustible modificada con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmcarga").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Cargas de Combustible",
    fileext: ".xls",
    preserveColors: true
  }); 
});

//nuevos scripts despues de revison de modulo 22/77/2019////////////////////////////////////////

//funcion para el input rendimiento_kilometro
function mifuncion666(valor){
    $.ajax({      
      url : 'scripts/carga_valor_rendimientoesperado.php',        
      data : { valor : valor },
      type : 'POST',    
      dataType : 'json',
      success : function(json) {  
        $("#vehiculo").val(json.vehiculo);     
        $("#rendimiento_kilometro").val(json.rendimiento_kilometro);        
      },     
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

//funcion para el input litros
$(document).ready(function(){
    $("#enviartotallitros").click(function(){
        var costo_total = $("#costo_total").val();
        var costo_litro = $("#costo_litro").val();
        
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_combustible.php",
            data: {costo_total:costo_total,costo_litro:costo_litro},
            success: function(data){              
                $('#litros').val(data);
            }
        });
    });
});

//funcion para el input rendimiento_real
$(document).ready(function(){
    $("#enviarrendimientoreal").click(function(){
        var km_inicial = $("#km_inicial").val();
        var km_final = $("#km_final").val();
        var litros = $("#litros").val();
        
        $.ajax({
            type: "POST",
            url: "scripts/suma_rendimiento_combustible.php",
            data: {km_inicial:km_inicial,km_final:km_final,litros:litros},
            success: function(data){              
                $('#rendimiento_real').val(data);
            }
        });
    });
});

//funcion para el input factor
$(document).ready(function(){
    $("#enviarfactor").click(function(){
        var rendimiento_real = $("#rendimiento_real").val();
        var rendimiento_kilometro = $("#rendimiento_kilometro").val();       

        $.ajax({
            type: "POST",
            url: "scripts/suma_rendimientofactor.php",
            data: {rendimiento_real:rendimiento_real,rendimiento_kilometro:rendimiento_kilometro},
            success: function(data){              
                $('#factor').val(data);
            }
        });
    });
});

//funcion para el input porcentaje
$(document).ready(function(){
    $("#enviardif").click(function(){
        var factor = $("#factor").val();
        var rendimiento_kilometro = $("#rendimiento_kilometro").val();       

        $.ajax({
            type: "POST",
            url: "scripts/suma_rendimientoporcentaje.php",
            data: {factor:factor,rendimiento_kilometro:rendimiento_kilometro},
            success: function(data){              
                $('#porcentaje').val(data);
            }
        });
    });
});
</script>
</body>
</html>