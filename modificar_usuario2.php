<?php 
   include 'menu.php';  
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Consultar Usuarios</title>
    
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
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
  </head>

<body>
<!--codigo para la cabecera debajo del menu-->  
<div class="bg-info clearfix">
<h3 align="center">Consultar Usuarios
<i class="fa fa-group fa-2x"></i></h3> 
</div>

<!--modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tabla de Usuarios</h5>
        <!--boton para exportar a excel-->
        <button type="button" class="btn btn-outline-dark btn-sm mx-auto" id="excel">Exportar a excel</button> 

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Codigo para mostrar tabla de datos -->
      <div id="tabla_1" class="table-responsive-sm"></div>       
    </div>
  </div>
</div>
<!--modal-->

<div style="margin: 20px;">
 <div class="text-center card-box text-white bg-dark">

<legend>Información del Usuario</legend>
  <div> 
<img src="img/img_avatar3.png" class="rounded-circle img-thumbnail" alt="imagen de perfil" style="margin:20px; width:150px;"> 
 </div>    

<hr>

<button class="btn btn-warning hvr-sink" type="button" onclick="muestradatos7()" data-toggle="modal" data-target=".bd-example-modal-lg">Ver tabla</button>             
 
<hr>
<div class="text-left">
    </div>
   </div>
  </div> <!-- end card-box -->

<script type="text/javascript">		
	
//CODIGO PARA MANDAR LLAMAR LA TABLA DE USUARIOS
   function muestradatos7(cadena){
    if (cadena=="")
    {
      document.getElementById("tabla").innerHTML="<h5>Muestra los datos de los usuarios...</h5>"
    }
    else
    {
      Ajax7=new XMLHttpRequest();
           Ajax7.open("get","scripts/tabla_usuarios2.php?c="+cadena,true);
           Ajax7.onreadystatechange=function(){
           var ca=document.getElementById("tabla_1");
           ca.innerHTML=Ajax7.responseText;
            };
           Ajax7.send(null);
    }
  }
//CODIGO PARA MANDAR LLAMAR LA TABLA DE USUARIOS

//exportar a excel
$("#excel").click(function(){
  $("#exportar").table2excel({
    name: "Hoja 1",
    filename: "Usuarios del Sistema",
    fileext: ".xls",
    preserveColors: true
  }); 
});
</script>
</body>
</html>