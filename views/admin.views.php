<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Bienvenido Administrador</title>
    
    <!--jquery librerias-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>  

    <!--boostrap librerias-->
    <link rel="stylesheet" type="text/css" href="bootstrap_4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap_4.3.1/js/popper.min.js"></script>
    <script type="text/javascript" src="bootstrap_4.3.1/js/bootstrap.min.js"></script>   

    <!--librerias para crear animaciones-->
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <script type="text/javascript" src="wowjs/wow.min.js"></script>
    <script type="text/javascript">new WOW().init();</script> 

    <!--librerias para crear efecto hover-->
    <link rel="stylesheet" type="text/css" href="Hover/css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css"> 

    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
    </style>  
    
</head>
<body class="fondo">
<div style="margin: 20px;">
 <div class="text-center card-box text-white">
 
 <br>
 <br>
 <br>
 <br>
 <br>
 
 <h1 class="wow bounceInDown" style="font-family:sans-serif;font-size:60px;">Bienvenido Administrador</h1>
 <br>
 <br>
<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle hvr-float" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-right"></i>
    Opciones
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

    <a class="dropdown-item" onclick="location.href='<?php echo RUTA.'registro.php' ?>'">            <i class="fa fa-address-book"></i>  Registrar usuarios</a>

    <a class="dropdown-item" onclick="location.href='menu.php'">
    <i class="fa fa-bars"></i> Menu</a>

    <a class="dropdown-item" onclick="location.href='<?php echo RUTA.'close.php' ?>'" >
    <i class="fa fa-sign-out"></i>  Cerrar Sesion</a>
    </div>
  </div>
</div>
   </div>
  </div>
</body>
</html>