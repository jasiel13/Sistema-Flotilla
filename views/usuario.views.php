<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Bienvenido Usuario</title>
    
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
    <link rel="stylesheet" type="text/css" href="css/estilos.css"> 

    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
    </style>  
    
</head>

<body class="fondo">
<div class="texto">
	<h1 id="titulo2" class="wow bounceInDown">Bienvenido Usuario</h1>
	
	<!--<a href="<?php echo RUTA.'close.php' ?>">Cerrar Sesion</a>-->
    <button type="button" onclick="location.href='<?php echo RUTA.'close.php' ?>'" class="btn btn-dark hvr-float bot3">
    Cerrar Sesion    
    </button>

	<button type="button" class="btn btn-dark hvr-float bot1" onclick="location.href='menu.php'">
	Menu
   </button>
</div>

</body>
</html>