<?php
include 'menu.php'; 
$con=mysqli_connect("localhost","root","","controldeflotilla") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Historial de Incidentes</title>
    
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

<div class="bg-info clearfix">
<h3 align="center">Historial de Incidentes
<i class="fa fa fa-exclamation-circle fa-2x"></i></h3>
</div>

<!--CODIGO PARA FORMULARIO DE ACTUALIZAR CONDUCTOR-->
<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">
  <legend>Información de los Incidentes
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
 <button type="button" onclick="location.href='incidentes.php'" class="btn btn-info hvr-sink">
 Reporte de Incidente    
</button>

<button type="button" onclick="location.href='reg_mantenimiento.php'" class="btn btn-info hvr-sink">
Aplicar Mantenimiento   
</button>
 </div>
</div> 
<hr>
<div class="text-left">
    </div>
   </div>
  </div>

<div id="table"></div>

<script type="text/javascript">
//CODIGO PARA LLAMAR LA TABLA DE tabla_alertas_mtto_ven.php
$(document).ready(function(){
$('#table').load('scripts/tabla_historial_incidentes.php');
});
</script>
</body>
</html>