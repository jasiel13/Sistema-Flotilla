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
    <script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="jquery/dataTables.bootstrap4.min.js"></script>

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
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_tables.css">
  </head>

<body>
<div class="bg-info clearfix">
<h3 align="center">Registro de Aditivos
<i class="fa fa-tint fa-2x"></i>
</h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información del Registro de Aditivos
    <img src="img/aceite.png">
  </legend>

<form class="container" id="frmaditivo" method="POST">
   <div class="form-row">

    <div class="form-group col-md-3">
    <label for="">Aditivo</label>
    <select  name="aditivo1" id="aditivo1" class="form-control" onchange="mifuncion22(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM aditivo_tipo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_aditivo'].'">'.$row['aditivo'].'</option>';
          }
        ?>
    </select>
    <p id="ms1" style="display:none" class="error">El campo aditivo no puede estar vacío</p>      
    </div>

    <input type="hidden" class="form-control" name="aditivo2" id="aditivo2"> 

    <div class="form-group col-md-3">
    <label for="">Fecha de Registro</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
    </div>
    <input type="date" class="form-control" name="fecha_registro" id="fecha_registro"> 
   </div>
    <p id="ms2" style="display:none" class="error">El campo fecha no puede estar vacío</p>
    </div>

    <div class="form-group col-md-3">
    <label for="">Marca</label>
    <input type="text" class="form-control" name="marca1" id="marca1"> 
    <p id="ms3" style="display:none" class="error">El campo marca no puede estar vacío</p>
    </div>
 
   <div class="form-group col-md-3">
      <label for="">Litros</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">LT</span>
    </div>
    <input type="text" class="form-control numerico" name="litros" id="litros">
    </div>
  <p id="ms4" style="display:none" class="error">El campo litros no puede estar vacío</p> 
     </div>
   </div>

  <div class="form-row">
    <div class="form-group col-md-4">
    <label for="">Costo por Litro</label>
    <input type="text" class="form-control numerico" name="costo_litro" id="costo_litro" placeholder="Costo por Litro">
<p id="ms5" style="display:none" class="error">El campo costo por litro no puede estar vacío</p>
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

    <div class="form-group col-md-4">
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
    <p id="ms7" style="display:none" class="error">Seleccione una opción</p>      
    </div> 
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
      Listado de Aditivos
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
        <h5 class="modal-title" id="exampleModalLabel">Agregar Aditivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form class="container" id="frmagregar" method="POST">
      <div class="form-row">
      <div class="form-group col-md-12">
      <label for="">Nombre</label>
  <input type="text" class="form-control" name="aditivo" id="aditivo" placeholder="Ej: Aceite">
    <p id="ns" style="display:none" class="fallo">El campo aditivo no puede estar vacío</p>
  
      </div>
      <div class="form-group col-md-12">
      <label for="">Marca</label>
  <input type="text" class="form-control" name="marca" id="marca" placeholder="Ej: Mobil">
    <p id="os" style="display:none" class="fallo">El campo marca no puede estar vacío</p>
  
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
        <h5 class="modal-title" id="exampleModalLabel">Modificar Aditivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<form class="container" id="updateaditivos" method="POST">
  <div class="form-row">  

   <div class="form-group col-md-6">
    <label for="" >Id Aditivos</label>
      <select  name="id_aditivos" id="id_aditivos" class="form-control" onchange="mifuncion2(this.value)">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM aditivos";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_aditivos'].'">'.$row['id_aditivos'].'</option>';
          }
        ?>
      </select>
     <p id="ns1" style="display:none" class="fallo">Coloque el id del aditivo que desea modificar</p>
   </div>

<div class="form-group col-md-6">
 <label for="">Aditivos</label>
  <div class="input-group mb-4">
  <div class="input-group-prepend">
  <button class="input-group-text" id="btnver" type="button" disabled>Editar</button>
  </div>
  <input type="text" class="form-control target" name="aditivo3" id="aditivo3">

  <select  name="aditivo4" id="aditivo4" class="form-control targetet" onchange="mifuncion1(this.value)" style="display:none;">
        <option value="">Seleccione...</option>
        <?php
            $query="SELECT  * FROM aditivo_tipo";
            $result=mysqli_query($con, $query) or die (mysqli_error());
            while ($row=mysqli_fetch_array($result)){ 
            echo '<option value="'.$row['id_aditivo'].'">'.$row['aditivo'].'</option>';
          }
        ?>
    </select>    
</div>
<p id="ns2" style="display:none" class="fallo">El campo aditivo no puede estar vacío</p>
</div>
</div>
<input type="hidden" class="form-control" name="aditivo5" id="aditivo5"> 

<div class="form-row">

<div class="form-group col-md-6">
<label for="">Fecha de Registro</label>
<div class="input-group mb-4">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
</div>
<input type="date" class="form-control" name="fecha_registro2" id="fecha_registro2"> 
</div>
<p id="ns3" style="display:none" class="fallo">El campo fecha no puede estar vacío</p>
</div>

<div class="form-group col-md-6">
<label for="">Marca</label>
<input type="text" class="form-control" name="marca2" id="marca2"> 
<p id="ns4" style="display:none" class="fallo">El campo marca no puede estar vacío</p>  
</div> 
</div>
 
<div class="form-row">
       <div class="form-group col-md-6">
      <label for="">Litros</label>
      <div class="input-group mb-4">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">LT</span>
    </div>
    <input type="text" class="form-control numerico" name="litros1" id="litros1">
    </div>
  <p id="ns5" style="display:none" class="fallo">El campo litros no puede estar vacío</p> 
     </div>


    <div class="form-group col-md-6">
    <label for="">Costo por Litro</label>
    <input type="text" class="form-control numerico" name="costo_litro1" id="costo_litro1" placeholder="Costo por Litro">
<p id="ns6" style="display:none" class="fallo">El campo costo por litro no puede estar vacío</p>
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
    <p id="ns8" style="display:none" class="fallo">Seleccione una opción</p>      
    </div>
    </div> 
</form> 
</div>
      <div class="modal-footer bg-info"> 
      <button type="button" id="btnmodificar" class="btn btn-dark">Modificar</button>
      <button type="button" class="btn btn-dark" onclick="delete1($('#id_aditivos').val())">Eliminar</button>          
    </div>
  </div>
</div>
</div>
<!-- Modal -->

<!--codigo para generar la tabla de data-table-->
<div class="container">
<div class="dataWrapper">
<table class="table table-hover table-sm table-bordered table-condensed" id="exportar"> 
<thead class="thead-dark text-center"> 
<tr>
<th>ID</th>  
<th>Aditivos</th>
<th>Fecha</th>
<th>Marca</th>
<th>Litros</th>
<th>Costo por Litros</th>
<th>Costo Total</th>
<th>Vehículo</th>
</tr>
</thead>
<tbody>
<?php
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
$query="select id_aditivos,aditivo,fecha_registro,marca,litros,costo_litro,costo_total,vehiculo from aditivos order by id_aditivos desc";
$result=mysqli_query($con, $query) or die (mysqli_error());

while ($row=mysqli_fetch_array($result)){ 

$datos=$row[0]."||".
$row[1]."||".
$row[2]."||".
$row[6]."||".
$row[4]."||".
$row[5]."||".
$row[6]."||".
$row[7];
?>
  <tr> 
    <td class="text-center"><?php echo$row[0]?></td>  
    <td class="text-center"><?php echo$row[1]?></td>
    <td class="text-center"><?php echo$row[2]?></td>
    <td class="text-center"><?php echo$row[3]?></td>
    <td class="text-center"><?php echo$row[4]?></td>
    <td class="text-center"><?php echo$row[5]?></td>
    <td class="text-center"><?php echo$row[6]?></td>
    <td class="text-center"><?php echo$row[7]?></td>
  </tr>  
<?php
 }
mysqli_query($con,$query) or die ("Problemas al llamar tabla".mysqli_error());
mysqli_close($con);
?>
</tbody>
</table>
</div>
</div>
<!--codigo para generar la tabla de data-table-->

<script type="text/javascript"> 
  function validaForm(){
    // Campos de texto
    if($("#aditivo1").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms1").delay(100).fadeIn("slow");
        $("#aditivo1").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    }

    if($("#fecha_registro").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ms2").delay(100).fadeIn("slow");
        $("#fecha_registro").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
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

   if($("#litros").val() == ""){        
        $("#ms4").delay(100).fadeIn("slow");
        $("#litros").focus();
        return false;
    }
    else
    {
      $("#ms4").fadeOut();      
    }

  if($("#costo_litro").val() == ""){        
        $("#ms5").delay(100).fadeIn("slow");
        $("#costo_litro").focus();
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
    if($("#vehiculo").val() == ""){        
        $("#ms7").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
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
  $.post("scripts/reg_aditivos2.php",$("#frmaditivo").serialize(),function(res){
 
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
                     title: 'Registro Aditivos agregado con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("frmaditivo").reset();//codigo para limpiar datos del form
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


//registrar datos del modal////////////////////////////////////////////////////////
function validaForm2(){
    // Campos de texto
    if($("#aditivo").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns").delay(100).fadeIn("slow");
        $("#aditivo").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns").fadeOut();      
    }

    if($("#marca").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#os").delay(100).fadeIn("slow");
        $("#marca").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#os").fadeOut();      
    }

     return true; // Si todo está correcto
}

// Esta parte del código se ejecutará automáticamente cuando la página esté lista.
$(document).ready( function() { 
// Con esto establecemos la acción por defecto de nuestro botón de enviar.  
 $("#btnagregar").click( function() {
// Primero validará el formulario.
  if(validaForm2()){ 
  $.post("scripts/reg_aditivos.php",$("#frmagregar").serialize(),function(res){
 
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
                     title: 'Aditivo agregado con éxito!!',
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
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de los aditivos...</h5>"
    }
    else
    {
      Ajax2=new XMLHttpRequest();
           Ajax2.open("get","scripts/tabla_aditivos.php?c="+cadena,true);
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
    if($("#id_aditivos").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns1").delay(100).fadeIn("slow");
        $("#id_aditivos").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns1").fadeOut();      
    }
    // Campos de texto
    if($("#aditivo3").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns2").delay(100).fadeIn("slow");
        $("#aditivo3").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
        return false;
    }
    else
    {
      $("#ns2").fadeOut();      
    }

     if($("#fecha_registro2").val() == ""){
        //alert("El campo Nombre no puede estar vacío.");
        $("#ns3").delay(100).fadeIn("slow");
        $("#fecha_registro2").focus();// Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
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

   if($("#litros1").val() == ""){        
        $("#ns5").delay(100).fadeIn("slow");
        $("#litros1").focus();
        return false;
    }
    else
    {
      $("#ns5").fadeOut();      
    }

  if($("#costo_litro1").val() == ""){        
        $("#ns6").delay(100).fadeIn("slow");
        $("#costo_litro1").focus();
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
     if($("#vehiculo1").val() == ""){        
        $("#ns8").delay(100).fadeIn("slow");
        $("#vehiculo1").focus();
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
  $.post("scripts/actualizar_aditivos.php",$("#updateaditivos").serialize(),function(res){
 
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
                     title: 'Aditivos modificados con éxito!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("updateaditivos").reset();//codigo para limpiar datos del form
                }
            });
        }
    });    
});

function mifuncion2(valor){
    $.ajax({ 
     // la URL para la petición    
      url : 'scripts/carga_valores_aditivos.php',
     // la información a enviar en este caso el valor de lo que seleccionaste en el select     
      data : { valor : valor },
     // especifica si será una petición POST o GET
      type : 'POST',
     // el tipo de información que se espera de respuesta
      dataType : 'json',
      success : function(json) {
        //aqui recibimos el "echo" del php(carga_valores.php)
        //y ahora solo colocas el valor en los campos    
        $("#aditivo3").val(json.aditivo3);
        $("#aditivo5").val(json.aditivo5);
        $("#fecha_registro2").val(json.fecha_registro2);
        $("#marca2").val(json.marca2);
        $("#litros1").val(json.litros1);
        $("#costo_litro1").val(json.costo_litro1);
        $("#costo_total1").val(json.costo_total1);
        $("#vehiculo1").val(json.vehiculo1);        
      },
      // código a ejecutar si la petición falla;
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }


 //CODIGO PARA BORRAR REGISTRO
function delete1(id){
  if(confirm("Esta seguro que desea eliminar este registro?")){
  $.ajax({
      url : 'scripts/borrar_aditivos.php',
      data : { id : id },
      type : 'POST',
      success : function(data) {
        alert(data);
        document.getElementById("updateaditivos").reset();        
      }
  });
  }  
}//se quita este corchete y el if confirm si no quieres confirmar el eliminar*/

function limpiar() {
//document.getElementById("frmupdate").reset();//limpiar form
//$("#ms1").fadeOut();//limpiar mensaje de aviso
location.reload(); 
};

//CODIGO PARA EJECUTAR LA TABLA CON EL PLUGIN DATA-TABLE  
  $(document).ready( function () {
    $('#exportar').DataTable();
} );

$( ()=> {
  $('#exportar').DataTable();
  $(document).on('click', '#btn', function(){

  if( !$('.dataWrapper').is(':visible') ) {
    $('.dataWrapper').show();
  } else {
    $('.dataWrapper').hide();
  }
  });
});

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Registro de Aditivos",
    fileext: ".xls",
    preserveColors: true
  }); 
});

/////////////////////////////////////////////////////////////////////////////////////
function mifuncion22(valor){
    $.ajax({     
      url : 'scripts/carga_valores_adi.php',         
      data : { valor : valor },   
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        $("#aditivo2").val(json.aditivo2);           
        $("#marca1").val(json.marca1);              
      },   
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }


//CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal").click(function(){
        var litros = $("#litros").val();      
        var costo_litro = $("#costo_litro").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_aditivos.php",
            data: {litros:litros,costo_litro:costo_litro},
            success: function(data){              
                $('#costo_total').val(data);              
            }
        });
    });
});

function mifuncion1(valor){
    $.ajax({     
      url : 'scripts/carga_valores_adi2.php',         
      data : { valor : valor },   
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        $("#aditivo5").val(json.aditivo5);           
        $("#marca2").val(json.marca2);              
      },   
        error : function(xhr, status) {
        alert('Disculpe, existió un problema');
      }
    });
  }

  //CODIGO PARA SUMAR LOS COSTOS
$(document).ready(function(){
    $("#enviartotal1").click(function(){
        var litros1 = $("#litros1").val();      
        var costo_litro1 = $("#costo_litro1").val();       
        $.ajax({
            type: "POST",
            url: "scripts/suma_costos_aditivos2.php",
            data: {litros1:litros1,costo_litro1:costo_litro1},
            success: function(data){              
                $('#costo_total1').val(data);              
            }
        });
    });
});


//codigo para modificar input aditivo//////////////////////////////////////////////////////
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
    $("#id_aditivos").change( function() {
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
</script>
</body>
</html>