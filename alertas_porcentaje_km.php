<?php include 'menu.php';
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Alerta de Factor</title>
	
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="jquery/sweetalert2.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.table2excel.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="jquery/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="jquery/push.min.js"></script>

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
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap_tables.css">
  </head>
  <body>

<div class="bg-info clearfix">
<h3 align="center">Alertas de Diferencia en Kilometraje
<i class="fa fa-bell fa-2x"></i></h3> 
</div>

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Alertas de Diferencia Absoluta
  <img src="img/tablero.png">
  </legend>


<form class="container" id="alertafactor" method="POST">
 <div class="form-row">

 <div class="form-group col-md-2"></div> 

  <div class="form-group col-md-4"> 
  <label for="">Número de Ticket</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
  <button class="input-group-text btn btn-outline-success" type="button" onclick="muestradatos()"><i class="fa fa-search" style="color: #20c997;" id="btnguardar"></i></button>
  </div>
  <input type="text" class="form-control" name="ticket" id="ticket" placeholder="Búsqueda: #123">
  </div>
  <p id="ms" style="display:none" class="error">Seleccione el Ticket</p> 
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
      <p id="ms1" style="display:none" class="error">Seleccione el Vehículo</p>      
     </div> 
   <div class="form-group col-md-3">
  </div>
 </div>

 <div class="form-row">
 <div class="form-group col-md-2"></div> 
 <div class="form-group col-md-4">
 <button type="button" id="btngenerar" class="btn btn-warning hvr-sink targetet" style="display:none">
<i class="fa fa-bell"></i>
 Generar Alerta</button> 
 <button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i> Exportar a excel</button>
</div>
<div class="form-group col-md-4">
<button type="button" onclick="location.href='reg_mantenimiento.php'" class="btn btn-info hvr-sink">
Registrar Mantenimiento  
</button>
<button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
 </div>
</div>
</form>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<div class="container">
<div id="resultado" class="table-responsive"></div>
</div>
<br>

<div id="table"></div>

<script type="text/javascript">
 //funcion para generar la tabla de alertas 
 function muestradatos(){

    var ticket = document.getElementById("ticket").value; 
    var vehiculo = document.getElementById("vehiculo").value;

    ObjetoAjax = new XMLHttpRequest();

    ObjetoAjax.open("POST", "scripts/alerta_factor.php", true);
    ObjetoAjax.onreadystatechange = procesaPeticion;

    ObjetoAjax.setRequestHeader("content-Type","application/x-www-form-urlencoded");

    parametro = "ticket=" + ticket +  "&vehiculo=" + vehiculo;

    ObjetoAjax.send(parametro);

    function procesaPeticion(){
      if (ObjetoAjax.readyState == 4 && ObjetoAjax.status==200) {

        var div = document.getElementById("resultado");
        div.innerHTML = ObjetoAjax.responseText;

      } 
    }
  }

 $(document).ready( function(){ 
  $("#btngenerar").click(function(){
   $.post("enviar-correo-factor.php",$("#alertafactor").serialize(),function(res){
 
                if(res == 1){
                     //alert("Fallo al agregar");
                  Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: 'Fallo al generar',                  
                   });
                } else {
                    //alert("Vehículo agregado con éxito!!");
                    Swal.fire({
                     position:'center',
                     type: 'success',
                     title: 'Alerta generada y enviada al correo!!',
                     showConfirmButton: false,
                     timer: 1500
                     });
                    document.getElementById("alertafactor").reset();//codigo para limpiar datos del form
                }
            });  
          });   
       });

//Boton para ocultar elementos y mostrar otros
function validaForm2(){
 if($("#ticket").val() == ""){

        $("#ms").delay(100).fadeIn("slow");
        $("#ticket").focus();
        return false;
    }
    else
    {
      $("#ms").fadeOut();      
    } 

    if($("#vehiculo").val() == ""){

        $("#ms1").delay(100).fadeIn("slow");
        $("#vehiculo").focus();
        return false;
    }
    else
    {
      $("#ms1").fadeOut();      
    } 
   return true; 
}
 
     $(document).on('click', '#btnguardar', function(){ 
     if(validaForm2()){    
        if(!$('.targetet').is(':visible') ) {
          $('.targetet').show();

        }
        else
        { 
          $('.targetet').show();

        }
      }       
   });  

 $(document).on('click', '#btngenerar', function(){  
  if(!$('.targetet').is(':visible') ) {
          $('.targetet').show();

        }
        else
        { 
          $('.targetet').hide();

        }
  }); 

 //CODIGO PARA LLAMAR LA TABLA DE TABLA.COMBUSTIBLE.PHP
$(document).ready(function(){
  $('#table').load('scripts/tabla_cargacombustible.php');
});

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Carga de Combustible",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>