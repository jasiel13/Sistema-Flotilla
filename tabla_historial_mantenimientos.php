<?php
include 'menu.php'; 
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Historial de mantenimientos</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
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
<h3 align="center">Historial de Mantenimientos
<i class="fa fa-wrench fa-2x"></i></h3>  
</div>

<!--CODIGO PARA FORMULARIO DE ACTUALIZAR CONDUCTOR-->
<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información de Mantenimientos
  <img src="img/servicio.png">
   </legend>

  <div class="form-row">
  <div class="form-group col-md-2">
  </div>
  <div class="form-group col-md-4">  
  <button class="btn btn-primary hvr-pop" type="button" id="btn">Ocultar Tabla</button>
 <button type="button" class="btn btn-primary hvr-pop" id="excel"><i class="fa fa-cloud-download fa-fw"></i>  Exportar a excel</button>
 </div>
 <div class="form-group col-md-4">
 <button type="button" onclick="location.href='modificar_mtto.php'" class="btn btn-info hvr-sink">
 Registrar Mtto.    
</button>

<button type="button" onclick="location.href='notificaciones.php'" class="btn btn-info hvr-sink">
 Alerta de Mtto. Pendientes    
</button>
 </div>
</div> 
<hr>
<div class="text-left">
    </div>
   </div>
  </div> 

<!--CODIGO PARA MOSTRAR LA TABLA-->
<div id="table"></div>


<script type="text/javascript">
//CODIGO PARA LLAMAR LA TABLA 
$(document).ready(function(){
$('#table').load('scripts/tabla_historial_mantenimientos.php');
});
</script>
</body>
</html>